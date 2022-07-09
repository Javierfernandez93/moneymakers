<?php define("TO_ROOT", "../../");

require_once TO_ROOT. "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new GranCapital\UserLogin;

if($UserLogin->logged === true)
{
    $Academy = new GranCapital\Academy;

    $data['academy_id'] = 1;
    
    if($Academy->cargarDonde("academy_id = ?",$data['academy_id']))
    {
        $data["academy"] = [
            'name' => $Academy->name,
            'configs' => $Academy->loadConfigs($Academy->getId())
        ];
        $data["s"] = 1;
        $data["r"] = "DATA_OK";
    } else {
        $data["s"] = 0;
        $data["r"] = "NOT_ACADEMY";
    }
} else {
	$data["s"] = 0;
	$data["r"] = "NOT_FIELD_SESSION_DATA";
}

echo json_encode($data);