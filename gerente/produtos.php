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
  <?php include('include/menu.php'); ?>

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
      <?php include('include/side-menu.php'); ?>

      <div class="lg-layout">
      <?php include('include/menu_filtro.php'); ?>

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

	</section>
</body>
</html>
