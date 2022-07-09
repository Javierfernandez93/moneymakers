<?php

namespace GranCapital;

use HCStudio\Orm;
use HCStudio\Session;
use HCStudio\Token;
use HCStudio\Util;
use HCStudio\Connection;

use GranCapital\UserPlan;
use GranCapital\TransactionRequirementPerUser;

class UserLogin extends Orm
{
  const DELETED = -1;

  protected $tblName  = 'user_login';
  public $save_class = false;

  public $_data = [];
  public $_parent = [];
  public $_parent_id = false;
  public $logged  = false;

  /* control data */
  private $field_control = 'password';
  private $field_session = 'email';
  private $field_type = 'email';
  private $field_salt = 'securitySalt';

  /* Objects  */
  private $PermissionPerUserSupport = false;
  private $Session = false;
  private $Token = false;

  public function __construct(bool $save_class = false, bool $autoLoad = true)
  {
    parent::__construct();

    $this->save_class = $save_class;

    $this->PermissionPerUserSupport = new PermissionPerUserSupport;
    $this->Session = new Session($this->tblName);
    $this->Token = new Token;

    if ($autoLoad === true) 
    {
      if ($this->logoutRequest()) return false;

      if ($this->checkCS() && !$this->loginRequest()) {
        if ($this->isValidPid()) {
          $this->login($this->Token->params[$this->field_session], $this->Token->params[$this->field_control]);
        }
      } else if ($this->loginRequest()) {
        $this->login();
      }
    }
  }

  public function hasPermission(string $permission = null): bool
  {
    if ($this->logged === true) {
      if (isset($permission) === true) {
        return $this->PermissionPerUserSupport->_hasPermission($this->getId(), $permission);
      }
    }
  }

  public function checkCS()
  {
    return $this->Session->get('pid');
  }

  public function setFieldSession(string $field_session = null)
  {
    $this->_setFieldSession($field_session);
  }

  public function _setFieldSession(string $field_session = null)
  {
    if ($field_session) $this->field_session = $field_session;
  }

  public function getFieldSession()
  {
    return [
      'field_session' => $this->field_session, 
      'field_type' => $this->field_type
    ];
  }

  public function logoutRequest()
  {
    if (Util::getVarFromPGS('logout')) {
      return $this->logout();
    }
  }

  public function deleteSession()
  {
    $this->Session->destroy();
  }

  public function isAbiableToSingUp()
  {
    if (!$this->logged)
      if ($this->getId() === 0)
        if (!$this->_data && !$this->_parent)
          return true;

    return false;
  }

  public function logout(bool $reload = true)
  {
    $this->deleteSession();

    if ($reload === true) header("Refresh: 0;url=./index.php");
  }

  public function getPassForUser()
  {
    return $this->isAbiableSalt((new Token())->randomKey(10));
  }

  private function getUniqueSalt()
  {
    if ($salt = $this->isAbiableSalt((new Token())->randomKey(5))) return $salt;

    $this->getUniqueSalt();
  }

  private function isAbiableSalt(string $salt = null)
  {
    if(isset($salt) == true) 
    {
      $sql = "SELECT {$this->tblName}.salt FROM {$this->tblName} WHERE {$this->tblName}.salt = '{$salt}'";

      if ($this->connection()->field($sql)) return false;
    }

    return $salt;
  }

  private function needChangeControlData()
  {
    if (!$this->last_login_date) return true;

    if (strtotime('+ ' . $this->expiration_salt_date . ' minutes', $this->last_login_date) < time()) return true;

    return false;
  }

  public function renewSalt()
  {
    $this->setSalt(true);
  }

  private function setSalt(bool $force_to_set_salt = false)
  {
    if ($this->needChangeControlData() || $force_to_set_salt) {
      $this->salt = $this->getUniqueSalt();
      $this->save();
    }
  }

  private function saveControlData()
  {
    if ($this->needChangeControlData() === true) {
      $this->ip_user_address = $_SERVER['REMOTE_ADDR'];
      $this->last_login_date = time();
      $this->save();
    }
  }

  private function doLogin() : bool
  {
    if ($this->getId()) 
    {
      $this->setSalt();
      $this->setPid();
      $this->saveControlData();
      $this->loadProfile();
      $this->logged = true;
    }

    return $this->logged;
  }

  public function login(string $field_session = null,string $field_control = null) : bool
  {
    $field_session = ($field_session) ? $field_session : Util::getVarFromPGS($this->field_session, false);
    $field_control = ($field_control) ? $field_control : sha1(Util::getVarFromPGS($this->field_control, false));
    
    if ($this->cargarDonde("{$this->field_session}=? AND {$this->field_control}=?", [$field_session, $field_control])) {
      return $this->doLogin();
    }

    return false;
  }

  public function createPid()
  {
    return $this->Token->getToken([
      $this->field_session => $this->{$this->field_session},
      $this->field_control => $this->{$this->field_control},
      $this->field_salt => sha1($this->last_login . $this->ip_user_address . $this->salt),
    ], true, true);
  }

  public function loadProfileClass(string $ClassName = null, string $storage_name = null)
  {
    if (isset($ClassName,$storage_name) === true)
    {
      if (!isset($this->_data[$storage_name])) 
      {
        $_parent_id = ($this->_parent_id) ? $this->_parent_id : $this->getId();

        $Class = new $ClassName();
        $Class->cargarDonde('user_login_id = ?', $_parent_id);

        if (!$Class->getId()) $Class->user_login_id = $_parent_id;

        $this->_data[$storage_name] = $Class->attr();

        if ($this->save_class === true) {
          if (!$Class->getId()) $Class->user_login_id = $this->getId();

          $this->_parent[$storage_name] = $Class;
        }
      }
    }
  }

  public function loadProfile()
  {
    $this->loadProfileClass(__NAMESPACE__ . '\UserData', 'user_data');
    $this->loadProfileClass(__NAMESPACE__ . '\UserAddress', 'user_address');
    $this->loadProfileClass(__NAMESPACE__ . '\UserContact', 'user_contact');
    $this->loadProfileClass(__NAMESPACE__ . '\UserAccount', 'user_account');
  }

  public function getUniqueToken(int $lenght = 5, string $field = 'secret', string $table = 'user_login', string $field_as = 'total')
  {
    if ($token = $this->Token->randomKey($lenght)) {
      $sql = "SELECT count({$table}.{$field}) as {$field_as} FROM {$table} WHERE {$table}.{$field} = '{$token}'";

      if ($this->connection()->field($sql)) $this->getUniqueToken();
      else return $token;
    }

    return false;
  }

  public function setPid()
  {
    $this->Session->set('pid', $this->createPid());
  }

  public function hasLogged() : bool
  {
    return $this->logged;
  }

  public function loginFacebookRequest()
  {
    if (isset($_GET['user_key']) || isset($_POST['user_key']))
      return true;

    return false;
  }

  public function loginRequest() : bool
  {
    return Util::getVarFromPGS($this->field_session,false) && Util::getVarFromPGS($this->field_control,false);
  }

  public function isValidPid() : bool
  {
    return ($this->Token->checkToken($this->Session->get('pid'))) ? true : false;
  }

  public function isValidMail(string $email = null)
  {
    $sql = "
            SELECT 
              {$this->tblName}.email
            FROM 
              {$this->tblName}
            WHERE
              {$this->tblName}.email = '{$email}'
            ";

    return $this->connection()->field($sql) ? false : true;
  }

  public function hasData($data) : bool
  {
    if (is_array($data)) {
      foreach ($data as $field)
        if (!isset($field) || empty($field)) return false;
    } else if (!$data || $data == "") return false;

    return true;
  }

  public function isUniqueMail(string $email = null) : bool
  {
    if(isset($email) === true)
    {
      return ($this->connection()->field("SELECT email FROM user_login WHERE user_login.email = '{$email}' LIMIT 1")) ? false : true;
    }

    return false;
  }

  public function doSignup(array $data = null)
  {
    $UserLogin = new UserLogin;
    $UserLogin->email = $data['email'];
    $UserLogin->password = sha1($data['password']);
    $UserLogin->signup_date = time();
    $UserLogin->catalog_campaing_id = (new CatalogCampaign)->getCatalogCampaing($data['utm']);

    if ($UserLogin->save()) {
      $UserLogin->company_id = $UserLogin->getId();

      if ($UserLogin->save()) {
        $UserData = new UserData;
        $UserData->user_login_id = $UserLogin->company_id;
        $UserData->names = $data['names'];

        if ($UserData->save()) {
          $UserContact = new UserContact;
          $UserContact->user_login_id = $UserLogin->company_id;
          $UserContact->phone = $data['phone'];

          if ($UserContact->save()) {
            $UserAddress = new UserAddress;
            $UserAddress->user_login_id = $UserLogin->company_id;
            $UserAddress->address = '';
            $UserAddress->colony = '';
            $UserAddress->city = '';
            $UserAddress->state = '';
            $UserAddress->country = '';
            $UserAddress->country_id = $data['country_id'];

            if ($UserAddress->save()) {
              $UserAccount = new UserAccount;
              $UserAccount->user_login_id = $UserLogin->company_id;
              $UserAccount->image = UserAccount::DEFAULT_IMAGE;

              if ($data['referral']) {
                $UserReferral = new UserReferral;
                $UserReferral->referral_id = $data['referral']['user_login_id'];
                $UserReferral->user_login_id = $UserLogin->company_id;
                $UserReferral->create_date = time();
                $UserReferral->save();
              }

              if ($UserAccount->save()) {
                return $UserLogin->company_id;
              }
            }
          }
        }
      }
    }

    return false;
  }

  public function getEmail(int $user_login_id = null)
  {
    if (isset($user_login_id) === true) {
      $sql = "SELECT 
                {$this->tblName}.email
              FROM 
                {$this->tblName}
              WHERE 
                {$this->tblName}.user_login_id = '{$user_login_id}'
              ";
      return $this->connection()->field($sql);
    }

    return false;
  }

  public function getNames($user_support_id = false)
  {
    if (isset($user_support_id) === true) {
      $sql = "SELECT 
                LOWER(CONCAT_WS(' ',{$this->tblName}.names,{$this->tblName}.last_name,{$this->tblName}.sur_name)) as names
              FROM 
                {$this->tblName}
              WHERE 
                {$this->tblName}.user_support_id = '{$user_support_id}'
              ";
      return $this->connection()->field($sql);
    }
  }

  function checkRedirection()
  {
    // @todo
  }

  /* profile fun */
  public function getPlan()
  {
    return (new UserPlan)->getPlan($this->company_id);
  }

  public function hasPlan(): bool
  {
    return (new UserPlan)->hasPlan($this->company_id);
  }

  public function hasCard(): bool
  {
    return (new UserCard)->hasCard($this->company_id);
  }

  public function getLanding(): string
  {
    if ($this->getId()) {
      $utm = (new CatalogCampaign)->getUtm($this->catalog_campaing_id);

      return Connection::getMainPath() . '/apps/' . $utm . '/?uid=' . $this->company_id;
    }
  }

  /* profile fun */
  public function getProfile(int $user_login_id = null, int $catalog_campaing_id = null)
  {
    if (isset($user_login_id) === true) {
      $sql = "SELECT 
                {$this->tblName}.email,
                {$this->tblName}.user_login_id,
                user_data.names,
                user_account.image
              FROM 
                {$this->tblName}
              LEFT JOIN
                user_data 
              ON 
                user_data.user_login_id = {$this->tblName}.user_login_id
              LEFT JOIN
                user_account 
              ON 
                user_account.user_login_id = {$this->tblName}.user_login_id
              WHERE 
                {$this->tblName}.user_login_id = '{$user_login_id}'
              AND  
                {$this->tblName}.catalog_campaing_id = '{$catalog_campaing_id}'
              ";

      return $this->connection()->row($sql);
    }
  }

  /* profile fun */
  public function getReferralCount()
  {
    if ($this->getId()) {
      return (new UserReferral)->getReferralCount($this->company_id);
    }

    return 0;
  }

  public function getReferral()
  {
    if ($this->getId()) {
      return (new UserReferral)->getReferral($this->company_id);
    }

    return 0;
  }

  public function getLastTransactions()
  {
    if ($this->getId()) {
      return (new TransactionRequirementPerUser)->getLastTransactions($this->company_id, "LIMIT 5");
    }
  }
  public function getSignupDate(int $company_id = null)
  {
    if (isset($company_id)) {
      $sql = "SELECT
                {$this->tblName}.signup_date
              FROM
                {$this->tblName}
              WHERE 
                {$this->tblName}.user_login_id = '{$company_id}'";

      return $this->connection()->field($sql);
    }

    return 0;
  }

  public function isUserOnline(int $company_id = null)
  {
    if (isset($company_id) === true) {
      $sql = "SELECT {$this->tblName}.last_login_date FROM {$this->tblName} WHERE {$this->tblName}.company_id = '{$company_id}'";
      return $this->isOnline($this->connection()->field($sql));
    }

    return false;
  }

  public function isOnline($last_login_date = false)
  {
    if ($last_login_date >= strtotime("-5 minutes")) return true;

    return false;
  }

  public function getData($company_id = false, $filter = '')
  {
    if ($company_id) {
      $sql = "SELECT
                {$this->tblName}.company_id,
                {$this->tblName}.names,
                {$this->tblName}.last_login_date,
                user_settings.background,
                user_settings.personal_message,
                user_settings.gender,
                user_settings.country_id,
                user_settings.image
              FROM
                {$this->tblName}
              LEFT JOIN
                user_settings
              ON
                user_settings.user_login_id = {$this->tblName}.company_id
              WHERE
                {$this->tblName}.company_id = {$company_id}
              AND
                {$this->tblName}.status = '1'
                {$filter}";

      return $this->connection()->row($sql);
    }
    return false;
  }

  public function getCompanyIdByMail($email = false)
  {
    if ($email) {
      $sql = "SELECT
                {$this->tblName}.company_id
              FROM
                {$this->tblName}
              WHERE
                {$this->tblName}.email = '{$email}'";

      return $this->connection()->field($sql);
    }
    return false;
  }
}

