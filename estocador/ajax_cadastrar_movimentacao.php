<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../classes/class_estocador.php');
include('../classes/class_notificacao.php');
$response = array('status'=>'', 'content'=>'');
$repositor = new Estocador();

if( isset($_POST['qtd']) && isset($_POST['id']) )
{
	if( empty($_POST['qtd']) )
	{
		$response['status'] = 'INVALID_QUANTITY';
		echo json_encode($response);
		die();
	}
	
	else if( $_POST['qtd'] <= 0 )
	{
		$response['status'] = 'INVALID_QUANTITY';
		echo json_encode($response);
		die();	
	}

	$result = $repositor->movimentarLote($_POST['qtd'], $_POST['id']);

	if( $result == ERR_INVALID_QUANTITY )
	{
		$response['status'] = 'INVALID_QUANTITY';
		echo json_encode($response);
		die();
	}
	if( $result == ERR_SQL )
	{
		$response['status'] = 'ERR_SQL';
		echo json_encode($response);
		die();
	}

	$st = $repositor->logarMovimentacao('estoque', 'prateleira', $_POST['qtd'], $_POST['id'], 1);
	$response['status'] = 'OK';
	$response['content'] = $result;
	echo json_encode($response);
}
else
{
	die();
}