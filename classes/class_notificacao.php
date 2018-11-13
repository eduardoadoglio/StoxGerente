<?php

require_once '../php/constantes.php';
class Notificacao
{
	public 	$alvo 	= NULL; // Id do cargo
	public 	$data 	= NULL; 
	public 	$local	= NULL;
	public 	$msg	= NULL;	
	private $conn;

	function __construct($msg)
	{
		try
		{
			$this->conn = new PDO("mysql:server=localhost;dbname=db_stox;port=3307", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch(Exception $e)
		{
			try
			{
				$this->conn = new PDO("mysql:server=localhost;dbname=db_stox;", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
			catch(Exception $e)
			{
				$this->conn = new PDO("mysql:server=localhost;dbname=db_stox;port=3305", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
		}
		$this->msg = $msg;
	}
	
	public function setAlvo($alvo)
	{
		$this->alvo = $alvo;
	}

	public function cadastrarNotificacao()
	{
		if( $this->tipo == WAR_NEAR_SPOIL_DATE && $this->local == 'estoque' )
		{
			$query = $this->conn->prepare("INSERT INTO tb_notificacoes(nm_tipo, nm_local, id_lote, id_cargo_alvo) VALUES(:tipo, :local, :lote, :cargo)");
			$query->bindValue(':tipo', $this->tipo);
			$query->bindValue(':local', $this->local);
			$query->bindValue(':lote', $this->lote);
			$query->bindValue(':cargo', $this->alvo);
			$query->execute();
		}

		else if( $this->tipo == WAR_LOW_QUANTITY && $this->local == 'prateleira' )
		{
			$query = $this->conn->prepare("INSERT INTO tb_notificacoes(nm_tipo, nm_local, id_tipo_produto, id_cargo_alvo) VALUES(:tipo, :local, :produto, :cargo)");
			$query->bindValue(':tipo', $this->tipo);
			$query->bindValue(':local', $this->local);
			$query->bindValue(':produto', $this->produto);
			$query->bindValue(':cargo', $this->alvo);
			$query->execute();
		}

		else if( $this->tipo == WAR_LOW_QUANTITY && $this->local == 'estoque' )
		{
			$query = $this->conn->prepare("INSERT INTO tb_notificacoes(nm_tipo, nm_local, id_tipo_produto, id_cargo_alvo) VALUES(:tipo, :local, :produto, :cargo)");
			$query->bindValue(':tipo', $this->tipo);
			$query->bindValue(':local', $this->local);
			$query->bindValue(':produto', $this->produto);
			$query->bindValue(':cargo', $this->alvo);
			$query->execute();
		}
	}
}