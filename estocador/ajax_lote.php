<?php
include('../classes/class_estocador.php');
$estocador = new Estocador();
$response = array("status"=>"", "content"=>"");

$lote = $estocador->getLote($_POST['cd']);
$produto = $estocador->getProduto($lote['id_cod_barras']);

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
	$response['status'] = "OK";
	$response['product'] = $produto;
	$response['batch'] = $lote;
	$response['batch']['id_fornecedor'] = $estocador->getFornecedor($response['batch']['id_fornecedor']);
	echo json_encode($response);
	die();
}