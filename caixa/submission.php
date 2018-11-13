<?php
    include('../classes/class_caixa.php');
    $caixa = new Caixa();
    $produto = $caixa->getProduto($_POST['cod']);
    echo json_encode($produto);
?>
