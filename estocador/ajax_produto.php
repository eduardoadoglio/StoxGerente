<?php
include('../classes/class_estocador.php');
$estocador = new Estocador();
$response = array("status"=>"", "content"=>"");

$produto = $estocador->getProduto($_POST['codbarras']);
$setor = $estocador->getSetor($produto['id_secao_produto']);

if($produto == ERR_PRODUCT_NOT_FOUND)
{
	$response['status'] = "INVALID_PRODUCT";
	echo json_encode($response);
	die();
}

else if($produto == ERR_SQL)
{
	$response['status'] = "ERR_SQL";
	echo json_encode($response);
	die();
}

else
{
	$response['status'] 	= "OK";
	$response['product'] 	= $produto;
	$response['section'] 	= $setor;
	echo json_encode($response);
	die();
}