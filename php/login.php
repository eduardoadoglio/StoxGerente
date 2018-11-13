<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

function login($login, $pass)
{
	try
	{
		$conn = new PDO("mysql:server=localhost;dbname=db_stox;port=3307", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	catch(Exception $e)
	{
		$conn = new PDO("mysql:server=localhost;dbname=db_stox;", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	$query = $conn->prepare("SELECT * FROM tb_funcionario WHERE nm_login = :login AND nm_senha = :senha");
	$query->bindValue(":login", $login);
	$query->bindValue(":senha", $pass);
	$query->execute();

	if( $query->rowCount() == 1 )
	{
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	else
		return false;
}
