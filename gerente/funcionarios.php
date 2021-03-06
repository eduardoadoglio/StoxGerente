<!DOCTYPE html>
<html>
<head>
	<title>Funcionários</title>
    <meta charset="utf-8">
		<link rel="shortcut icon" href="images/favicon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php
			session_start();
			if( !isset($_SESSION['id']) )
    		header("Location: ../login.php");
			if(isset($_COOKIE['nightmode'])){
				if($_COOKIE['nightmode'] == "true"){
					echo '<link rel="stylesheet" id="checkstyle" href="css/night_mode.css">';
				}
				else{
					echo
					'<link rel="stylesheet" media="screen and (min-width:801px)" id="checkstyle" href="css/home_content.css">
					<link rel="stylesheet" media="screen and (max-width:800px)" href="css/mobile.css" />';
				}
			}
			else{
				echo
				'<link rel="stylesheet" media="screen and (min-width:801px)" id="checkstyle" href="css/home_content.css">
				<link rel="stylesheet" media="screen and (max-width:800px)" href="css/mobile.css" />';
			};
		?>
    <link rel="stylesheet" href="css/upper_menu.css">
    <link rel="stylesheet" href="css/side_menu.css">

    <script type="text/javascript" src="js/Chart.min.js"></script>
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
			<div class="func-wrapper">
				<span class="func-title">Funcionários </span><br>
				<span class="func-caption">Lista de todos os funcionários</span>
				<hr class="func-divider">
				<div class="func-header-wrapper">
					<button class="add-func"><i class="fas fa-plus"></i><span>Adicionar Funcionários</span></button>
					<div class="search-container">
						<input type="text" class="search-input" name="func-search" placeholder="Pesquisar funcionários">
						<button class="search-btn"><i class="fas fa-search search-icon"></i></button>
					</div>
				</div>
				<table class="table-func" cellspacing="0">
					<tr>
						<th> Nome do Funcionário </th>
						<th> Cargo </th>
						<th> Data de Admissão </th>
						<th> Ações </th>
					</tr>
					<tr>
						<td> João </td>
						<td> Dono </td>
						<td> 20/07/2009 </td>
						<td><button class="func-view"> <i class="fas fa-eye view-icon"></i><span>Visualizar</span></button>
								<button class="func-edit"> <i class="fas fa-edit edit-icon"></i><span>Editar</span></button>
								<button class="func-delete"> <i class="fas fa-trash-alt delete-icon"></i><span>Excluir</span></button></td>
					</tr>
					<tr>
						<td> Maria </td>
						<td> Repositor </td>
						<td> 17/03/2012 </td>
						<td><button class="func-view"> <i class="fas fa-eye view-icon"></i><span>Visualizar</span></button>
								<button class="func-edit"> <i class="fas fa-edit edit-icon"></i><span>Editar</span></button>
								<button class="func-delete"> <i class="fas fa-trash-alt delete-icon"></i><span>Excluir</span></button></td>
					</tr>
					<tr>
						<td> João Júnior </td>
						<td> Filho do Dono </td>
						<td> 13/15/2026 </td>
						<td><button class="func-view"> <i class="fas fa-eye view-icon"></i><span>Visualizar</span></button>
								<button class="func-edit"> <i class="fas fa-edit edit-icon"></i><span>Editar</span></button>
								<button class="func-delete"> <i class="fas fa-trash-alt delete-icon"></i><span>Excluir</span></button></td>
					</tr>
				</table>
			</div>
    </main>

	</section>
</body>
</html>
