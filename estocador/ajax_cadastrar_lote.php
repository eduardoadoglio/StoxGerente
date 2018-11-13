<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include('../classes/class_estocador.php');
$repositor = new Estocador();

if( empty($_POST['codbarras']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$response['status'] = 'EMPTY_FIELD';
	$response['content'] = 'codbarras';
	echo json_encode($response);
	die();
}

if( empty($_POST['nr_lote']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$response['status'] = 'EMPTY_FIELD';
	$response['content'] = 'nr_lote';
	echo json_encode($response);
	die();
}

if( empty($_POST['fornecedor']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$response['status'] = 'EMPTY_FIELD';
	$response['content'] = 'fornecedor';
	echo json_encode($response);
	die();
}

if( empty($_POST['data']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$response['status'] = 'EMPTY_FIELD';
	$response['content'] = 'data';
	echo json_encode($response);
	die();
}

if( empty($_POST['qtd']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$response['status'] = 'EMPTY_FIELD';
	$response['content'] = 'qtd';
	echo json_encode($response);
	die();
}

if( $repositor->getProduto($_POST['codbarras']) == ERR_PRODUCT_NOT_FOUND )
{
	$response['status'] = 'INVALID_BARCODE';
	$response['content'] = '';
	echo json_encode($response);
	die();
}

if( $_POST['qtd'] < 0)
{
	$response['status'] = 'INVALID_QUANTITY';
	$response['content'] = '';
	echo json_encode($response);
	die();
}

if( $repositor->getIdFornecedor($_POST['fornecedor']) == ERR_SUPPLIER_ID_NOT_FOUND )
{
	$response['status'] = 'INVALID_SUPPLIER';
	$response['content'] = '';
	echo json_encode($response);
	die();
}

$vrfData = $repositor->vrfValidade($_POST['data']);
if( $vrfData == ERR_BATCH_SPOILED )
{
	$response['status'] = 'INVALID_DATE';
	$response['content'] = '';
	echo json_encode($response);
	die();
}
else if( $vrfData <= 10)
{
	$repositor->receberLote($_POST['codbarras'], $_POST['nr_lote'], $_POST['qtd'], $_POST['data'], $_POST['fornecedor']);
	$response['status'] = 'NEAR_DATE';
	$response['content'] = $repositor->conn->lastInsertId();
	echo json_encode($response);
	die();
}

$cd = $repositor->receberLote($_POST['codbarras'], $_POST['nr_lote'], $_POST['qtd'], $_POST['data'], $_POST['fornecedor']);
$response['status'] = 'OK';
$response['content'] = $cd;
echo json_encode($response);