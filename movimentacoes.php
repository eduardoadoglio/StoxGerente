<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <meta charset="utf-8">
		<link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
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
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
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
    <div class="row">
      <table class="table-mov" cellspacing="0">
        <tr>
          <th> FUNCIONÁRIO </th>
          <th> AÇÃO </th>
          <th> DATA </th>
          <th> HORA </th>
        </tr>
        <tr>
          <td> joao </td>
          <td> moveu $produto para $lugar </td>
          <td> 14/10 </td>
          <td> 21:39 </td>
        </tr>
        <tr>
          <td> joao </td>
          <td> moveu $produto para $lugar </td>
          <td> 14/10 </td>
          <td> 21:39 </td>
        </tr>
      </table>
    </div>
  </main>

	</section>
</body>
    <script type="text/javascript" src="js/graphs.js"></script>
</html>
