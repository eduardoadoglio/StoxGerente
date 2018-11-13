<?php

trait Lote
{
	public function vrfValidade($date)
	{
		date_default_timezone_set('America/Sao_Paulo');
		$now = date('Y-m-d');
		$diff = strtotime($date) - strtotime($now);

		if($diff <= 0)
			return ERR_BATCH_SPOILED;
		else if( ($diff/60/60/24) <= 30)
		{
			return $diff/60/60/24;
		}
		else
			return 'gibblebish-wishlist';
	}

	public function receberLote($codbarras, $nr_lote, $qt, $val, $supp) // Usa o nome do produto e do fornecedor pra encontrar os ids
	{
		// Caso não encontre o código de barras, retorna um erro
		$barcode = $this->vrfCodbarrasProduto($codbarras);
		if( $barcode == false)
			return ERR_BARCODE_NOT_FOUND;
		else if ( $barcode == ERR_SQL )
			return ERR_SQL;

		// Caso não encontre o ID do fornecedor, retorna um erro
		$idSupp = $this->getIdFornecedor($supp);
		if( !$idSupp )
			return ERR_SUPPLIER_ID_NOT_FOUND;
		else if ( $idSupp == ERR_SQL )
			return ERR_SQL;

		// Caso o lote esteja vencido, retorna um erro, se faltar menos que um mês, retorna os dias que faltam
		$stVal = $this->vrfValidade($val);
		if( $stVal == ERR_BATCH_SPOILED )
			return ERR_BATCH_SPOILED;
		else
			$days = $stVal;

		// Caso a quantidade seja 0 ou negativa, retorna um erro
		if($qt <= 0)
			return ERR_INVALID_QUANTITY;

		try
		{
			$query = $this->conn->prepare("INSERT INTO tb_lote(`nr_lote`, `id_cod_barras`, `int_qtd`, `dt_validade`, `id_fornecedor`) VALUES (:nr_lote, :cod, :qtd, :validade, :fornecedor)");
			$query->bindValue(':nr_lote', $nr_lote);
			$query->bindValue(':cod', $barcode);
			$query->bindValue(':qtd', $qt);
			$query->bindValue(':validade', $val);
			$query->bindValue(':fornecedor', $idSupp);
			$query->execute();
			$id = $this->conn->lastInsertId();
			
			$this->logarMovimentacao('fornecedor', 'estoque', $qt, $this->conn->lastInsertId(), $_SESSION['id']);
			return $id;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function listarLotes()
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_lote");
			$query->execute();

			$lotes = array();
			$lote = array();
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$row['produto']	=	$this->getProduto($row['id_cod_barras'])['nm_tipo_produto'];
				$row['fornecedor']	=	$this->getFornecedor($row['id_fornecedor']);
				array_push($lotes, $row);
			}

			return $lotes;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function getLote($id)
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_lote WHERE cd_lote = :id");
			$query->bindValue(":id", $id);
			$query->execute();

			if($query->rowCount() >= 1)
			{
				$result = $query->fetch(PDO::FETCH_ASSOC);
				return $result;
			}
			else
				return ERR_BATCH_NOT_FOUND;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function alterarLote($post)
	{
		// Caso não encontre o código de barras, retorna um erro
		$barcode = $this->vrfCodbarrasProduto($post['codbarras']);
		if( $barcode == ERR_BARCODE_NOT_FOUND)
			return ERR_BARCODE_NOT_FOUND;
		else if ( $barcode == ERR_SQL )
			return ERR_SQL;

		// Caso não encontre o ID do fornecedor, retorna um erro
		$idSupp = $this->getIdFornecedor($post['fornecedor']);
		if($idSupp == ERR_SUPPLIER_ID_NOT_FOUND)
			return ERR_SUPPLIER_ID_NOT_FOUND;
		else if($idSupp == ERR_SQL)
			return ERR_SQL;

		// Caso o lote esteja vencido, retorna um erro, se faltar menos que um mês, retorna os dias que faltam
		$stVal = $this->vrfValidade($post['validade']);
		if($stVal == ERR_BATCH_SPOILED)
			return ERR_BATCH_SPOILED;
		else if(gettype($stVal) == "integer")
			$days = $stVal;

		// Caso a quantidade seja 0 ou negativa, retorna um erro
		if($post['qtd'] <= 0)
			return ERR_INVALID_QUANTITY;

		try
		{
			$query = $this->conn->prepare("UPDATE tb_lote SET id_cod_barras = :cod,
											int_qtd = :qtd,
											dt_validade = :val,
											id_fornecedor = :id_f
											WHERE cd_lote = :id");
			$query->bindValue(":id", $post['id']);
			$query->bindValue(":cod", $post['codbarras']);
			$query->bindValue(":qtd", $post['qtd']);
			$query->bindValue(":val", $post['validade']);
			$query->bindValue(":id_f", $this->getIdFornecedor($post['fornecedor']));
			$query->execute();
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function deletarLote($cd)
	{
		try
		{
			$query = $this->conn->prepare("DELETE FROM tb_lote WHERE cd_lote = :cd");
			$query>bindValue(':cd', $cd);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}
}