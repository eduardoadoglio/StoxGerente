<!DOCTYPE html>
<html>
<?php include ('../classes/class_estocador.php');?>
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" media="screen and (min-width: 1px) and (max-width: 539px)" href="../css/estocador-recebe.css">
        <link rel="stylesheet" media="screen and (min-width: 540px) and (max-width: 799px)" href="../css/estocador-recebe-md.css">
        <link rel="stylesheet" media="screen and (min-width: 800px)" href="../css/estocador-recebe-lg.css">
        <script type="text/javascript" src="../js/repositor/modal.js"></script>
        <script type="text/javascript" src="../js/repositor/receber_ajax.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("i.fa-pencil-alt").on('click', function(){
                    $(this).siblings().focus();
                });

                $("[name='qtd']").keydown(function (e){
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                        (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                             return;
                    }
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="modal-aviso">
            <i class="far fa-thumbs-up"></i>
            <span id="modal-text"></span>
        </div>
        <?php include('menu.php'); ?>

        <main class="content">
            <?php include('left_menu.php'); ?>
            <section class="main-wrapper">
                <div class="batch">
                    <span class="batch-title"> Nome do produto </span>
                    <div id="barcode-input-wrapper">
                        <input type="text" class="batch-barcode" placeholder="Código de barras" name="codbarras">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <img src="../img/box.png" class="batch-icon">
                </div>
                <div class="infos-wrapper">
                    <div class="info-wrapper">
                        <i class="fas fa-box"></i>
                        <input type="text" class="input-change" placeholder="Número do lote" name="nr_lote">
                        
                    </div>

                    <div class="info-wrapper">
                        <i class="fas fa-truck"></i>
                        <input type="text" class="input-change" placeholder="Fornecedor" name="fornecedor">
                        
                    </div>

                    <div class="info-wrapper">
                        <i class="far fa-calendar-alt"></i>
                        <input id="date" type="date" class="input-change" name="data">
                        
                    </div>

                    <div class="info-wrapper">
                        <i class="fas fa-pencil-alt"></i>
                        <input type="number" min="1" step="1" class="input-change" placeholder="Quantidade" name="qtd">
                        
                    </div>
                </div>
                <div class="btns-wrapper">
                  <a href="#" class="btn add" id="submit-btn">
                      <i class="fas fa-check-square"></i>
                      <span>Confirmar</span>
                  </a>
                  <a href="lotes.php" class="btn cancel">
                      <i class="fas fa-ban"></i>
                      <span>Cancelar</span>
                  </a>
                </div>
            </section>

            <section class="main-wrapper-lg">
                <div class="page-title">Cadastrar novo lote</div>

                <div class="infos-wrapper">
                    <div class="info-wrapper">
                        <i class="fas fa-barcode"></i>
                        <input type="text" class="input-change" placeholder="Código de barras" name="codbarras">
                    </div>

                    <div class="info-wrapper">
                        <i class="fas fa-box"></i>
                        <input type="text" class="input-change" placeholder="Número do lote" name="nr_lote">
                    </div>

                    <div class="info-wrapper">
                        <i class="fas fa-truck"></i>
                        <input type="text" class="input-change" placeholder="Fornecedor" name="fornecedor">
                    </div>

                    <div class="info-wrapper">
                        <i class="far fa-calendar-alt"></i>
                        <input id="date" type="date" class="input-change" name="data">
                        
                    </div>

                    <div class="info-wrapper">
                        <i class="fas fa-pencil-alt"></i>
                        <input type="number" min="1" step="1" class="input-change" placeholder="Quantidade" name="qtd">
                        
                    </div>
                </div>
                <div class="btns-wrapper">
                  <a href="#" class="btn add" id="submit-btn">
                      <i class="fas fa-check-square"></i>
                      <span>Confirmar</span>
                  </a>
                  <a href="lotes.php" class="btn cancel">
                      <i class="fas fa-ban"></i>
                      <span>Cancelar</span>
                  </a>
                </div>
            </section>
        </main>
    </body><!--
    <script type="text/javascript">
        document.getElementById("date").valueAsDate = new Date();
    </script>!-->
</html>
