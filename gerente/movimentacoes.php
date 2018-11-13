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
	<title>Dashboard</title>
  <?php include("include/head.php"); ?>
    <meta charset="utf-8">
		<link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="../css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600" rel="stylesheet">
		<?php
			if(isset($_COOKIE['nightmode'])){
				if($_COOKIE['nightmode'] == "true"){
					echo '<link rel="stylesheet" id="checkstyle" href="css/night_mode.css">';
				}
				else{
					echo '<link rel="stylesheet" id="checkstyle" href="css/home_content.css">';
				}
			}
			else{
				echo '<link rel="stylesheet" id="checkstyle" href="css/home_content.css">';
			};
		?>
    <link rel="stylesheet" href="css/upper_menu.css">
    <link rel="stylesheet" href="css/side_menu.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script type="text/javascript" src="../js/repositor/mover_input.js"></script>
    <script type="text/javascript" src="../js/repositor/sort.js"></script>
    <script type="text/javascript" src="../js/repositor/menu_checkbox.js"></script>
    <script type="text/javascript" src="../js/repositor/seletor_ordem_menu.js"></script>
    <script type="text/javascript">$(document).ready(function(){addSeeListeners();})</script>
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/side_menu_hover.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/mobile-menu.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.menu-item-mask').on('mouseover', function(){
            $(this).find('i').css('color', '#188DA1');
            $(this).find('.menu-item-desc').css('left', "40px");
        });

        $('.menu-item-mask').on('mouseout', function(){
            var leftPush = $(this).find('.menu-item-desc').attr("leftPush");
            $(this).find('.menu-item-desc').css('left', leftPush+'px');
            $(this).find('i').css('color', 'white');
        });
    });
    </script>
</head>

    <!-- AQUI NA INDEX HAVERÃO LOGS DE ATIVIDADES, ORÇAMENTOS, ETC. !-->
<body>
	<?php
		include("include/menu.php");
	?>
  <div id="black-layer"></div>

	<section id="content">
	<?php
		include("include/side-menu.php");
	?>

  <main class="content">
		<div class="lg-layout">
            <?php include('include/menu_filtro.php'); ?>
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

	</section>
</body>
</html>
