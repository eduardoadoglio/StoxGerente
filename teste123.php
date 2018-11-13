<?php
	include("classes/class_gerente.php");
	$Gerente = new Gerente();

	//$produtos = $Gerente->prodFornecedor(1);

	//foreach($produtos as $produto) {
		//echo $produto."<br>";
	//}

	//$qtd_lotes = $Gerente->countLotes(1, '132F23E1');
	//echo $qtd_lotes;

//	$funcionario = $Gerente->verFuncionario(2);
	//foreach($funcionario as $dados) {
//		echo $dados." ";
//	}
	//$movimentacao = $Gerente->verMovimentacoes();
	//foreach ($movimentacao as $movimentos) {
		//echo $movimentos;
	//}

	//$sangria = $Gerente->defineSangria(30000, "34242423");

	//$alterar = $Gerente->alteraFornecedor(1, 'friboi2@faaaaaaaa', '9999-999', 'carne', 'Tony Ramos', 'endereco');

	//$alterar = $Gerente->alteraFuncionario(1, 'Fulano', 'email@fulano', '5550125', '667', 'pipipipopopo');
	//$alterar = $Gerente->alteraProduto('132F23E1','Fulano', '20', '33', 'aaaaaaaa');

	//$lotes = $Gerente->orderByName();
	//foreach ($lotes as $ordem) {
	//	echo $ordem."foo" ;
	//}

	$vendas = $Gerente->maisVendidos('132F23E1');
	foreach ($vendas as $qtdvenda) {
		echo $qtdvenda;
	}



?>
