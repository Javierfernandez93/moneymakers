<?php define("TO_ROOT", "../../");

require_once TO_ROOT. "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserSupport = new GranCapital\UserSupport;

if($UserSupport->_loaded === true)
{
    
} else {
	$data["s"] = 0;
	$data["r"] = "NOT_FIELD_SESSION_DATA";
}

echo json_encode($data);