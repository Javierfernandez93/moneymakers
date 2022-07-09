<?php define("TO_ROOT", "../..");

require_once TO_ROOT . "/system/core.php";

$UserLogin = new GranCapital\UserLogin;


if($UserLogin->logged === false) {
	HCStudio\Util::redirectTo(TO_ROOT."/apps/login/");
}

$UserLogin->checkRedirection();

$Academy = new GranCapital\Academy;
$Academy->loadConfigs(1);

$Layout = JFStudio\Layout::getInstance();

$route = JFStudio\Router::Backoffice;
$Layout->init(JFStudio\Router::getName($route),'index',"backoffice",'',TO_ROOT.'/');

$Layout->setScriptPath(TO_ROOT . '/src/');
$Layout->setScript([
	'backoffice.vue.js'
]);

$Layout->setVar([
	'route' =>  $route,
	'Academy' =>  $Academy,
	'UserLogin' => $UserLogin
]);
$Layout();