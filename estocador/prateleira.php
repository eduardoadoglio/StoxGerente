<?php
include('../classes/class_estocador.php');
$estocador = new Estocador();
$prateleira = $estocador->verPrateleira();

if( $prateleira == ERR_SQL)
    die("erro");
else if( !$prateleira )
{
    echo "Nenhum item na prateleira!";
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
        <script type="text/javascript" src="../js/repositor/sort.js"></script>
        <script type="text/javascript" src="../js/repositor/menu_checkbox.js"></script>
        <script type="text/javascript" src="../js/repositor/seletor_ordem_menu.js"></script>
    </head>
    <body>
        <?php include('menu.php'); ?>

        <main class="content">
            <?php include('left_menu.php'); ?>
            <?php /*include('menu_filtro.php');*/ ?>

            <div class="lg-layout">
            <?php include('menu_filtro.php'); ?>

            <div class="batches-wrapper">
            <?php
                $counter = 0;
                foreach($prateleira as $produto => $qtd)
                {
                    if( $qtd == ERR_INVALID_QUANTITY )
                    {
                        echo'
                        <div class="batch">
                            <img src="../img/shelves.png" class="batch-icon">
                            <wrapper>
                                <div class="item-qtd">
                                <div class="batch-product">'.$produto.'</div>
                                <div class="batch-date qtd"><i class="fas fa-exclamation-triangle "></i></div>
                                </div>
                                <div class="batch-error">ERRO NA QUANTIDADE!</div>
                            </wrapper>
                        </div>';
                    }
                    /*else if( $qtd < $estocador->getQtdRecomendada($produto['cd_produto']) )
                    {
                        ao invés de azul, amarelo;
                    }*/
                    else
                    {
                        echo'
                            <div class="batch">
                                <img src="../img/shelves.png" class="batch-icon">
                                <wrapper>
                                    <div class="item-qtd">
                                    <div class="batch-product" id="product-'.$counter.'"">'.$produto.'</div>
                                    <div class="batch-date qtd" id="qtd-'.$counter.'">'.$qtd.'</div>
                                    </div>
                                </wrapper>
                            </div>';
                    }
                    $counter++;
                }
            ?>
            </div>
          </div>
        </main>
    </body>
</html>
