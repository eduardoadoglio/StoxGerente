<?php
include('../classes/class_estocador.php');
$estocador = new Estocador();
$lotes = $estocador->listarLotes();
if( $lotes == ERR_SQL )
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
        <script type="text/javascript" src="../js/repositor/mover_input.js"></script>
        <script type="text/javascript" src="../js/repositor/destacar_lote.js"></script>
        <script type="text/javascript" src="../js/repositor/lotes-sort.js"></script>
        <script type="text/javascript" src="../js/repositor/lotes-menu_checkbox.js"></script>
        <script type="text/javascript" src="../js/repositor/lotes-seletor_ordem_menu.js"></script>
        <script type="text/javascript">$(document).ready(function(){addMoveListeners();addSeeListeners();})</script>
        <script type="text/javascript">
        $(document).ready(function(){
            $(".batch-info").each(function(){
                $(this).css('width', (($(this).attr('value').length + 2) * 8)+"px");
            });

            let viewheight = $(window).height();
            let viewwidth = $(window).width();
            $("input").on('focus', function(){
                let viewport = document.querySelector("meta[name=viewport]");
                viewport.setAttribute("content", "height=" + viewheight + "px, width=" + viewwidth + "px, initial-scale=1.0");
                $(this).parent().css("border-color", '#1473E4');
            });
            $("input").blur(function(){
                $(this).parent().css('border-color', 'rgba(0, 0, 0, 0.07)');
            });

            $('.left-add-btn').on('click', function(){
                
            });
        });
        </script>
    </head>
    <body>
        <?php include('menu.php'); ?>
        <div id="black-layer"></div>

        <div id="modal" class="">
            <div id="modal-header">
                <span id="modal-title">Leite Qualitá</span>
                <span id="modal-close">&times</span>
            </div>
            <div id="modal-content">
                <div class="modal-row">
                    <div class="modal-input-wrapper">
                        <i class="fas fa-barcode"></i>
                        <input type="text" class="modal-input" name="codbarras">
                    </div>
                    &nbsp&nbsp
                    <div class="modal-input-wrapper">
                        <i class="fas fa-list-ol"></i>
                        <input type="text" class="modal-input" name="qtd">
                    </div>
                </div>
                
                <div class="modal-row">
                    <div class="modal-input-wrapper">
                        <i class="fas fa-box"></i>
                        <input type="text" class="modal-input" name="nr_lote">
                    </div>
                    &nbsp&nbsp
                    <div class="modal-input-wrapper">
                        <i class="fas fa-truck"></i>
                        <input type="text" class="modal-input" name="fornecedor">
                    </div>
                </div>

                <div class="modal-input-wrapper date">
                    <i class="fas fa-hourglass-half"></i>
                    <input type="date" class="modal-input" name="validade">
                </div>
            </div>

            <div id="modal-footer">
                <div class="modal-btn-wrapper submit">
                    <i class="fas fa-edit"></i>
                    <div class="modal-btn">Confirmar</div>
                </div>

                <div class="modal-btn-wrapper restore">
                    <i class="fas fa-redo"></i>
                    <div class="modal-btn">Cancelar</div>
                </div>
            </div>
        </div>

        <div id="modal-aviso">
            <i class="far fa-thumbs-up"></i>
            <span id="modal-text"></span>
        </div>
        <main class="content">
            <?php include('left_menu.php'); ?>

            <div class="lg-layout">
            <?php include('menu_filtro.php'); ?>

            <a href="receber.php" class="add-btn">
                <i class="fas fa-plus"></i>
                <span>Adicionar</span>
            </a>
            <div class="batches-wrapper">
            <?php
                date_default_timezone_set("America/Sao_Paulo");
                $counter = 0;
                $loteNovo = (isset($_GET['aviso'])) ? $_GET['lote'] : "";

                foreach($lotes as $lote)
                {
                    $dateStr = str_replace('-', '/', $lote['dt_validade']);
                    $date = strtotime($dateStr);
                    $date = date('d/m/Y', $date);

                    if( $lote['cd_lote'] == $loteNovo )
                    {
                        echo '
                            <div class="batch" id="trigger-highlight">
                                <img src="../img/box.png" class="batch-icon">
                                <wrapper>
                                    <div class="item-qtd">
                                        <div class="batch-product" id="product-'.$counter.'">'.$lote['produto'].'</div>
                                        <div class="batch-date qtd" id="qtd-'.$counter.'">'.$lote['int_qtd'].'</div>
                                    </div>
                                    <div class="batch-date">Validade:<span class="date-content" id="date-'.$counter.'"> '.$date.'</span></div>

                                    <div class="batch-btn-wrapper" data-id="'.$lote['cd_lote'].'">
                                        <a href="javascript:void(0);" class="batch-btn see"><i class="fas fa-info"></i><span>Ver</span></a>
                                        <a href="javascript:void(0);" onclick="return false" class="batch-btn move"><i class="fas fa-dolly"></i><span>Mover</span></a>
                                    </div>
                                </wrapper>
                            </div>
                        ';
                    }
                    else
                    {
                        $px = "'px'";
                        echo '
                            <div class="batch">
                                <div class="batch-id-wrapper">
                                    <input type="text" class="batch-info batch-id" value="'.$lote['nr_lote'].'" onkeypress="this.style.width = ((this.value.length + 1) * 8) + '.$px.';">
                                    <img src="../img/box.png" class="batch-icon">
                                    <input type="text" class="batch-info batch-supplier" value="'.$lote['fornecedor'].'" onkeypress="this.style.width = ((this.value.length + 1) * 8) + '.$px.';">
                                </div>
                                <wrapper>
                                    <div class="item-qtd">
                                        <input type="text" class="batch-info batch-product" id="product-'.$counter.'" value="'.$lote['produto'].'" onkeypress="this.style.width = ((this.value.length + 1) * 8) + '.$px.';">
                                        <input type="text" class="batch-info batch-date qtd" id="qtd-'.$counter.'" value="'.$lote['int_qtd'].'" onkeypress="this.style.width = ((this.value.length + 1) * 8) + '.$px.';">
                                    </div>
                                    <div><input type="text" class="batch-date batch-info date-content" id="date-'.$counter.'" value="'.$date.'" onkeypress="this.style.width = ((this.value.length + 1) * 8) + '.$px.';"></div>

                                    <div class="batch-btn-wrapper" data-id="'.$lote['cd_lote'].'">
                                        <a href="javascript:void(0);" onclick="return false" class="batch-btn see"><i class="fas fa-edit"></i><span>Alterar</span></a>
                                        <a href="javascript:void(0);" onclick="return false" class="batch-btn move"><i class="fas fa-dolly"></i><span>Mover</span></a>
                                    </div>
                                </wrapper>
                            </div>
                        ';
                    }
                    $counter++;
                }
            ?>
            </div>
            </div>
        </main>
    </body>
</html>
