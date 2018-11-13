<?php
	session_start();
	include('php/login.php');

	if(isset($_SESSION['id_cargo'])){
		if($_SESSION['id_cargo'] == 1)
			header("Location: estocador/lotes.php");
		if($_SESSION['id_cargo'] == 2)
			header("Location: gerente/index.php");
		if($_SESSION['id_cargo'] == 3)
			header("Location: caixa/caixa.php");
	}

	if( isset($_POST['login']) && isset($_POST['senha']) )
	{
		$result = login($_POST['login'], $_POST['senha']);

		if($result['id_cargo'] == 1){		//Repositor
			$_SESSION['id_cargo'] = $result['id_cargo'];
			$_SESSION['nome'] = $result['nm_funcionario'];
			$_SESSION['id'] = $result['cd_funcionario'];
			header("Location: estocador/lotes.php");
		}
		else if($result['id_cargo'] == 2){		//Gerente
			$_SESSION['id_cargo'] = $result['id_cargo'];
			$_SESSION['nome'] = $result['nm_funcionario'];
			$_SESSION['id'] = $result['cd_funcionario'];
			header("Location: gerente/index.php");
		}
		else if($result['id_cargo'] == 3){ 		//Operador de caixa
			$_SESSION['id_cargo'] = $result['id_cargo'];
			$_SESSION['nome'] = $result['nm_funcionario'];
			$_SESSION['id'] = $result['cd_funcionario'];
			header("Location: caixa/caixa.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" media="screen and (min-width:1px) and (max-width:540px)" href="css/login-sm.css">
	<link rel="stylesheet" media="screen and (min-width:541px) and (max-width:799px)" href="css/login-md.css">
	<link rel="stylesheet" media="screen and (min-width:800px)" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet">
    <link rel="stylesheet"  href="css/fontawesome-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
	    	$(".form-input").on('focus', function(){
	    		$(this).parent().css('border-color', '#1473E4');
	    	});

	    	$(".form-input").on('blur', function(){
	    		$(this).parent().css('border-color', '#C1C1C1');
	    	});

	    	$(".submit-wrapper i").on('click', function(){
	    		$("form").submit();
	    	})
	    });
    </script>
</head>
</head>
<body>
	<div class="half first">
		<div class="logo-wrapper">
			<img class="logo" src="img/logoStox.svg">
			<img class="logo-text" src="img/stox.png">
			<hr>
			<span class="logo-title"><span>Faça login para acessar</span><span>o sistema</span></span>
		</div>
	</div>
	<div class="half">
		<div class="form-box">
			<form method="post" action="">
            <div class="input-wrapper">
                <i class="fas fa-user"></i>
			     <input type="text" name="login" placeholder="Login" class="form-input">
            </div>

            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha" placeholder="Senha" class="form-input" newpl="cuu">
            </div>
            <div class="submit-wrapper">
            	<i class="fas fa-sign-in-alt"></i>
				<input type="submit" value="Entrar">
			</div>
			</form>
		</div>
	</div>
</body>
</html>
