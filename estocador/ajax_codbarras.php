<?php

include('../classes/class_estocador.php');
$response = array("status"=>"", "content"=>"");

if(isset($_POST['codbarra']))
{
	if(!empty($_POST['codbarra']))
	{
		$repositor = new Estocador();
		$produto = $repositor->getProduto($_POST['codbarra']);

		if( $produto == ERR_PRODUCT_NOT_FOUND )
		{
			$response['status'] = 'PRODUCT_NOT_FOUND';
			echo json_encode($response);
		}
		else if( $produto == ERR_SQL )
		{
			$response['status'] = 'ERR_SQL';
			echo json_encode($response);
		}
		else
		{
			$response['status'] = 'OK';
			$response['content'] = $produto['nm_tipo_produto'];
			echo json_encode($response);
		}
	}
	else
	{
		$response['status'] = "EMPTY_FIELD";
		echo json_encode($response);
	}
}
else
{
	$response['status'] = "EMPTY_FIELD";
	echo json_encode($response);
}