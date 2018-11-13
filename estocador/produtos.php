<?php
include('../classes/class_estocador.php');
$estocador = new Estocador();
$produtos = $estocador->listarProdutos();
if( $produtos == ERR_SQL)
{
    echo "Errinho no sistema";
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" type="text/css" href="../css/modal-produto.css">
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 1px) and (max-width: 539px)" href="../css/estocador-produtos.css">
        <link rel="stylesheet" media="screen and (min-width: 540px) and (max-width: 799px)" href="../css/estocador-produtos-md.css">
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 800px)" href="../css/estocador-produtos-lg.css">
        <script type="text/javascript" src="../js/repositor/sort.js"></script>
        <script type="text/javascript" src="../js/repositor/menu_checkbox.js"></script>
        <script type="text/javascript" src="../js/repositor/seletor_ordem_menu.js"></script>
        <!--
            TODO: AJEITAR ESSES JAVASCRIPTS AÍ EM CIMA PRA LER DIVS, NÃO INPUTS
        !-->
    </head>
    <body>
        <?php include('menu.php'); ?>

        <div id="black-layer"></div>

        <div id="modal" class="">
            <div id="modal-header">
                <span id="modal-title">Produto</span>
                <span id="modal-close">&times</span>
            </div>
            <div id="modal-content">
                <div class="modal-row">
                    <div class="modal-info-wrapper">
                        <div class="modal-info-header"><i class="fas fa-dollar-sign icon"></i>Preço de compra</div>
                        <div class="wrapper">
                            <span class="modal-info">R$3,30</span>
                        </div>
                    </div>
                    &nbsp&nbsp
                    <div class="modal-info-wrapper">
                        <div class="modal-info-header"><i class="fas fa-dollar-sign icon"></i>Preço de venda</div>
                        <div class="wrapper">
                            <span class="modal-info">R$5,30</span>
                        </div>
                    </div>
                </div>

                <div class="modal-row">
                    <div class="modal-info-wrapper">
                        <div class="modal-info-header"><i class="fas fa-boxes icon"></i>Qtde. em estoque</div>
                        <div class="wrapper">
                            <span class="modal-info">134 unidades</span>
                        </div>
                    </div>
                    &nbsp&nbsp
                    <div class="modal-info-wrapper">
                        <div class="modal-info-header"><img src="../img/one.svg" class="icon">Qtde. mínima</div>
                        <div class="wrapper">
                            <span class="modal-info">165 unidades</span>
                        </div>
                    </div>
                </div>

                <div class="modal-row">
                    <div class="modal-info-wrapper">
                        <div class="modal-info-header"><i class="fas fa-shopping-cart icon"></i>Qtde. nas prateleiras</div>
                        <div class="wrapper">
                            <span class="modal-info">43 unidades</span>
                        </div>
                    </div>
                    &nbsp&nbsp
                    <div class="modal-info-wrapper">
                        <div class="modal-info-header"><img src="../img/one.svg" class="icon">Qtde. mínima</div>
                        <div class="wrapper">
                            <span class="modal-info">50 unidades</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="content">
            <?php include('left_menu.php'); ?>

            <div class="lg-layout">
            <?php include('menu_filtro.php'); ?>

            <div class="product-wrapper">
            <?php
                $counter = 0;
                foreach($produtos as $produto)
                {
                    $img = $estocador->getImgProduto($produto['cod_barras']);
                    echo'
                        <div class="product">
                            <img src="../img/'.$img.'" class="product-icon">
                            <wrapper>
                                <div class="item-qtd">
                                    <div class="product-product" id="product-'.$counter.'">'.$produto['nm_tipo_produto'].'</div>
                                    <div class="product-date qtd" id="qtd-'.$counter.'">R$'.$produto['int_preco_venda'].'</div>
                                </div>

                                <div class="infos-wrapper">
                                    <div class="product-info"><div class="info-title">Min. nas prateleiras</div><span>'.$produto['nr_min_prateleira'].' un.</span></div>
                                    <div class="product-info"><div class="info-title">Qtd. atual</div><span>'.$produto['qtd_prateleira'].' un.</span></div>
                                </div>
                            </wrapper>
                        </div>';
                        $counter++;
                }
            ?>
            </div>
        </div> <!-- fecha o lg-layout!-->
        </main>
    </body>
</html>