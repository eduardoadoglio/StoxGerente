<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <meta charset="utf-8">
		<link rel="shortcut icon" href="images/favicon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php
			if(isset($_COOKIE['nightmode'])){
				if($_COOKIE['nightmode'] == "true"){
					echo '<link rel="stylesheet" id="checkstyle" href="css/night_mode.css">';
				}
				else{
					echo
					'<link rel="stylesheet" media="screen and (min-width:481px)" id="checkstyle" href="css/home_content.css">
					<link rel="stylesheet" media="screen and (max-width:480px)" href="css/mobile.css" />';
				}
			}
			else{
				echo
				'<link rel="stylesheet" media="screen and (min-width:481px)" id="checkstyle" href="css/home_content.css">
				<link rel="stylesheet" media="screen and (max-width:480px)" href="css/mobile.css" />';
			};
		?>
    <link rel="stylesheet" href="css/upper_menu.css">
    <link rel="stylesheet" href="css/side_menu.css">
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/side_menu_hover.js"></script>
		<script type="text/javascript" src="js/mobile-menu.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/jquery.mobile-1.4.5.js"></script>
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
	<div id="layer"></div>
	<?php
		include("include/menu.php");
	?>

	<section id="content">
	<?php
		include("include/side-menu.php");
		include("include/mobile-menu.php")
	?>


        <main id="content-body">
						<div class="row">
            <div class="log-card">
								<div class="log-card-image sellings"><i class="fas fa-chart-line"></i></div>
								<div class="log-content">
									<span class="log-title">VENDAS</span>
									<span class="log-number">1032</span>
								</div>
            </div>

						<div class="log-card">
								<div class="log-card-image profit"><i class="fas fa-dollar-sign"></i></div>
								<div class="log-content">
									<span class="log-title">LUCRO</span>
									<span class="log-number">277</span>
								</div>
            </div>

						<div class="log-card">
								<div class="log-card-image shelves"><i class="fas fa-cart-plus"></i></div>
								<div class="log-content">
									<span class="log-title">COMPRAS</span>
									<span class="log-number">214</span>
								</div>
            </div>

						<div class="log-card">
								<div class="log-card-image mov"><i class="far fa-money-bill-alt"></i></div>
								<div class="log-content">
									<span class="log-title">VALOR DO ESTOQUE</span>
									<span class="log-number">R$ 3.000</span>
								</div>
            </div>
						</div>

						<div class="row">
							<div class="graph-container">
	                <canvas id="graficoBarra" width="600" height="400"></canvas>
	            </div>
	            <div class="graph-container">
	                <canvas id="graficoLine" width="600" height="400"></canvas>
	            </div>
						</div>

						<div class="row">
						<div class="log-card mov-full">
								<div class="log-card-image mov"><i class="fas fa-dolly"></i></div>
								<div class="log-content">
									<span class="log-title">MOVIMENTAÇÕES</span>
									<span class="log-number">1992</span>
								</div>
            </div>
						<div class="log-card stock-full">
								<div class="log-card-image stock"><i class="fas fa-boxes"></i></div>
								<div class="log-content">
									<span class="log-title">ESTOQUE</span>
									<span class="log-number">242</span>
								</div>
            </div>
						<div class="log-card pnap-full">
								<div class="log-card-image pnap"><i class="fas fa-shopping-basket"></i></div>
								<div class="log-content">
									<span class="log-title">PNAP</span>
									<span class="log-number">67</span>
								</div>
            </div>
						<div class="log-card plhd-full">
								<div class="log-card-image plhd"><i class="fas fa-clock"></i></div>
								<div class="log-content">
									<span class="log-title">VENDAS POR HORA</span>
									<span class="log-number">999.999</span>
								</div>
            </div>
						</div>
        </main>

	</section>
</body>
    <script type="text/javascript" src="js/graphs.js"></script>
</html>
