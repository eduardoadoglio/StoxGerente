<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'trait_lote.php';
require_once 'trait_produto.php';
require_once 'trait_atividade.php';
require_once 'trait_prateleira.php';
require_once '../php/constantes.php';

class Estocador
{
	use Lote;
	use Produto;
	use Atividade;
	use Prateleira;
	
	public $conn;

	function __construct()
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
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ativa os erros de SQL
	}

	// ---------- Essas são funções de rotina, executadas sem interação direta do usuário ----------

	public function getIdFornecedor($name) // Função retorna o id do fornecedor
	{
		try
		{
			$query = $this->conn->prepare("SELECT cd_fornecedor FROM tb_fornecedor WHERE nm_fornecedor = :name");
			$query->bindValue(":name", $name);
			$query->execute();

			if($query->rowCount() >= 1)
			{
				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					return $row['cd_fornecedor'];
				}
			}
			else
			{
				return ERR_SUPPLIER_ID_NOT_FOUND;
			}
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function getFornecedor($cd)
	{
		try
		{
			$query = $this->conn->prepare("SELECT nm_fornecedor FROM tb_fornecedor WHERE cd_fornecedor = :cd");
			$query->bindValue(":cd", $cd);
			$query->execute();

			if($query->rowCount() >= 1)
			{
				$result = $query->fetch(PDO::FETCH_ASSOC);
				return $result['nm_fornecedor'];
			}
			else
			{
				return ERR_SUPPLIER_NOT_FOUND;
			}
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function formatarData($date)
	{
		$date = date_format($date, 'd-m-Y'); // Formata o objeto date criado
		return "33";
	}

	public function getSetor($idSetor)
	{
		try
		{
			$query = $this->conn->prepare("SELECT nm_secao_produto FROM tb_secao_produto WHERE cd_secao_produto = :cd");
			$query->bindValue(":cd", $idSetor);
			$query->execute();

			return $query->fetch()[0];
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}
	// ---------- Fim das funções de rotina ----------
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////

	public function listarMovimentacoes()
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_log_movimentacao");
			$query->execute();

			$movimentacoes = array();
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				array_push($movimentacoes, $row);
			}
			
			return $movimentacoes;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function logarMovimentacao($org, $dst, $qtd, $lote, $func)
	{
		try
		{
			$query = $this->conn->prepare("INSERT INTO tb_log_movimentacao VALUES(NULL, :org, :dst, :qtd, :lote, :func, DEFAULT)");
			$query->bindValue(':org', $org);
			$query->bindValue(':dst', $dst);
			$query->bindValue(':qtd', $qtd);
			$query->bindValue(':lote', $lote);
			$query->bindValue(':func', $func);
			$query->execute();
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function movimentarLote($qtd, $lote)
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_lote WHERE cd_lote = :cd");
			$query->bindValue(':cd', $lote);
			$query->execute();

			$result = $query->fetch(PDO::FETCH_ASSOC);
			$batchQtd = $result['int_qtd'];
			$codbarra = $result['id_cod_barras'];
			$newBatchQtd = $batchQtd - $qtd;

			if( $newBatchQtd < 1 )
				return ERR_INVALID_QUANTITY;

			$query= $this->conn->prepare("UPDATE tb_lote SET int_qtd = :qtd WHERE cd_lote = :cd");
			$query->bindValue(":cd", $lote);
			$query->bindValue(":qtd", $newBatchQtd);
			$query->execute();

			$query= $this->conn->prepare("SELECT int_qtd FROM tb_prateleira WHERE id_cod_barras = :codbarras");
			$query->bindValue(":codbarras", $codbarra);
			$query->execute();

			$pratQtd = $query->fetch(PDO::FETCH_ASSOC)['int_qtd'];
			$newQtd = $qtd + $pratQtd;
			$query= $this->conn->prepare("UPDATE tb_prateleira SET int_qtd = :qtd WHERE id_cod_barras = :codbarras");
			$query->bindValue(":codbarras", $codbarra);
			$query->bindValue(":qtd", $newQtd);
			$query->execute();

			return $newBatchQtd;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	/////////////////////////////////////////////////
	/////////////////////////////////////////////////
	// ---------- Essas são funções do produto ------
	
}
