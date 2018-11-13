<?php

include('../classes/class_estocador.php');
$repositor = new Estocador();
$response = array("status"=>"", "response"=>"");

$res = $repositor->alterarLote($_POST);
if($res == ERR_SQL)
{
	$response['status'] = "ERR_SQL";
	echo json_encode($response);
	die();
}
else if($res == ERR_BARCODE_NOT_FOUND)
{
	$response['status'] = "INVALID_BARCODE";
	echo json_encode($response);
	die();
}
else if($res == ERR_SUPPLIER_ID_NOT_FOUND)
{
	$response['status'] = "INVALID_SUPPLIER";
	echo json_encode($response);
	die();
}
else if($res == ERR_BATCH_SPOILED)
{
	$response['status'] = "INVALID_DATE";
	echo json_encode($response);
	die();
}
else if($res == ERR_INVALID_QUANTITY)
{
	$response['status'] = "INVALID_QUANTITY";
	echo json_encode($response);
	die();
}
else
{
	$response['status'] = 'OK';
	echo json_encode($response);
}