<?php
    include('../classes/class_caixa.php');
    $caixa = new Caixa();


    $action = $_POST['action'];

    if ($action == 1) {
        $produto = $caixa->getProduto($_POST['cod']);
        echo json_encode($produto);
    }

    if($action == 2) {
        $total = $_POST['total'];
        $troco = $_POST['troco'];
        $funcionario = $_POST['funcionario'];
        $metodo = $_POST['moneycc'];
        $json = $_POST['venda'];
        $venda_itens = json_decode($json, true);
        $lastid = $caixa->createVenda($total, $troco, $funcionario, $metodo);
        foreach ($venda_itens as $item ) {
            $caixa->pushVenda($lastid, $item["codbarra"],$item["qtd"]);
        }
        // var_dump($venda_itens);
        // echo $venda_itens[0][1];
    }

    if($action == 3) {
        $id_caixa = $_POST['id_caixa'];
        $dinheiro_caixa = $_POST['dinheiro_caixa'];
        $id_funcionario = $_POST['id_funcionario'];
        $pin = $caixa->verificarPin($_POST['pin']);

        if ($pin == true){
            $query = $caixa->logarCaixa("Abrir Caixa",$dinheiro_caixa, $id_caixa, $id_funcionario);
            echo true;
        } else {
            return false;
        }
    }

    if($action == 4){
        $desconto = $caixa->verifyDesconto($_POST['cod']);

        echo $desconto;
    }



?>
