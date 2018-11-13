<?php
include('../classes/class_estocador.php');
$estocador = new Estocador();
$movimentacoes = $estocador->listarMovimentacoes();
if( $movimentacoes == ERR_SQL )
{
    echo "erro";
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" media="screen and (min-width: 1px) and (max-width: 539px)" href="../css/estocador-movimentacao.css">
        <link rel="stylesheet" media="screen and (min-width: 540px) and (max-width: 799px)" href="../css/estocador-movimentacao-md.css">
        <link rel="stylesheet" media="screen and (min-width: 800px)" href="../css/estocador-movimentacao-lg.css">
        <script type="text/javascript" src="../js/repositor/mover_input.js"></script>
        <script type="text/javascript" src="../js/repositor/sort.js"></script>
        <script type="text/javascript" src="../js/repositor/menu_checkbox.js"></script>
        <script type="text/javascript" src="../js/repositor/seletor_ordem_menu.js"></script>
        <script type="text/javascript">$(document).ready(function(){addSeeListeners();})</script>
    </head>
    <body>
        <?php include('menu.php'); ?>
        <div id="black-layer">

        </div>

        <main class="content">
            <?php include('left_menu.php'); ?>

            <div class="lg-layout">
            <?php include('menu_filtro.php'); ?>
            <div class="batches-wrapper">
            <?php
                foreach($movimentacoes as $movimentacao)
                {
                    $codbarras = $estocador->getLote($movimentacao['id_lote'])['id_cod_barras'];
                    $produto = $estocador->getProduto($codbarras);
                    $setor = $estocador->getSetor($produto['id_secao_produto']);

                    $data = explode(" ", $movimentacao['dt_movimentacao'])[0];
                    $hora = explode(" ", $movimentacao['dt_movimentacao'])[1];
                    $dataMembers = explode("-", $data);
                    $dataMembers = array_reverse($dataMembers);
                    $data = join('/', $dataMembers);

                    echo '
                        <div class="move-wrapper" id="trigger-highlight" data-id-lote="">
                            <section class="move-wrapper-header">
                                Feito por João em '.$data.' às '.$hora.'
                            </section>

                            <div class="move-wrapper-content">
                                <section class="move-part origin">
                                    <div class="origin-card">
                                        <div class="origin-header">
                                            '.$produto['nm_tipo_produto'].'
                                            <div class="origin-quantity">- '.$movimentacao['vl_qtd'].'</div>
                                        </div>
                                        <img src="../img/warehouse.png">
                                        <span class="img-desc">'.$movimentacao['ds_origem'].'</span>
                                    </div>
                                </section>

                                <section class="move-part arrows">
                                    <i class="fas fa-long-arrow-alt-right active"></i>
                                </section>

                                <section class="move-part destination">
                                    <div class="move-part-header">
                                        '.$setor.'
                                    </div>
                                    <img src="../img/shelves2.png">
                                    <span class="img-desc">'.$movimentacao['ds_destino'].'</span>
                                </section>
                            </div>
                        </div>
                ';
                }
            ?>

            </div>
            </div>
        </main>
    </body>
</html>
