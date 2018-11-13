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
        <link href="../css/estocador-notificacoes.css" media="screen and (min-width: 1px) and (max-width: 539px)" " rel="stylesheet">
        <link href="../css/estocador-notificacoes-lg.css" media="screen and (min-width: 800px)" rel="stylesheet">
        <script type="text/javascript" src="../js/repositor/sort.js"></script>
        <script type="text/javascript" src="../js/repositor/menu_checkbox.js"></script>
        <script type="text/javascript" src="../js/repositor/seletor_ordem_menu.js"></script>
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

        });
        </script>
    </head>
    <body>
        <?php include('menu.php'); ?>

        <div id="modal-aviso">
            <i class="far fa-thumbs-up"></i>
            <span id="modal-text"></span>
        </div>

        <main class="content">
            <?php include('left_menu.php'); ?>

            <div class="lg-layout">
            <?php include('menu_filtro.php'); ?>


            <div class="notifications-wrapper">
                <div class="notification">
                    <img src="../img/box.png" class="notification-icon">
                    
                    <div class="notification-content">
                        <div class="notification-message">Faltam <b>7 dias</b> para o lote <b>NB35</b> vencer</div>
                        <div class="notification-date"><i class="far fa-calendar-alt"></i>&nbsp&nbsp04/07/2018</div>
                    </div>
                </div>

                <div class="notification">
                    <img src="../img/shelves.png" class="notification-icon">
                    
                    <div class="notification-content">
                        <div class="notification-message"><b>Leite Qualitá</b> está <b>em falta</b> nas prateleiras</div>
                        <div class="notification-date"><i class="far fa-calendar-alt"></i>&nbsp&nbsp04/07/2018</div>
                    </div>
                </div>
            </div>
            </div>
        </main>
    </body>
</html>
