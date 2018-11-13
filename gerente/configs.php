<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <meta charset="utf-8">
		<link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="../css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600" rel="stylesheet">
		<?php
      session_start();
      if( !isset($_SESSION['id']) )
      header("Location: ../login.php");
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
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/side_menu_hover.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
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

	<section id="content">
	<?php
		include("include/side-menu.php");
	?>

  <main id="content-body">
    <div class="config-wrapper">
      <span class="config-title">Configurações </span><br>
      <span class="config-caption">Ajuste o sistema para atender à suas necessidades</span>
      <hr class="config-divider">
      <div class="config-content">
        <div class="first-section">
          <button class="accordion"><i class="fas fa-cogs"></i> &nbsp Configurações do Sistema </button>
          <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
          <button class="accordion"><i class="fas fa-user"></i> &nbsp Configurações do Usuário </button>
          <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
					<button class="accordion"><i class="fas fa-home"></i> &nbsp Configurações da Loja </button>
          <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
          <button class="accordion"><i class="fas fa-flag"></i> &nbsp Configurações de Privacidade </button>
          <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>

        </div>

        <div class="second-section">
          <img class="config-img" src="images/max.jpg">
          <button class="alterar-info">ALTERAR</button>
          <span class="info-name"> Leonardo Cardoso</span><br>
					<span class="info-job"> Gerente </span><br>
          <span class="info-location"> Itanhaém - SP </span><br>
          <span class="info-email"> leonardocardoso@gmail.com </span> <br>
        </div>
      </div>
    </div>
  </main>

	</section>
</body>
    <script type="text/javascript" src="js/accordion.js"></script>
</html>
