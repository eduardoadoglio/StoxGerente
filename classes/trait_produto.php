<?php
trait Produto
{
	public function listarProdutos()
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_tipo_produto");
			$query->execute();

			$produtos = array();
			$produto = array();
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$row['qtd_prateleira'] = $this->getQtdProduto($row['cod_barras']);
				array_push($produtos, $row);
			}

			return $produtos;
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function getProduto($cod)
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_tipo_produto WHERE cod_barras = :cod");
			$query->bindValue(":cod", $cod);
			$query->execute();

			if($query->rowCount() >= 1)
			{
				$result = $query->fetch(PDO::FETCH_ASSOC);
				return $result;
			}
			else
				return ERR_PRODUCT_NOT_FOUND;
		}
		catch(PDOException $E)
		{
			return ERR_SQL;
		}
	}

	public function getQtdProduto($codbarras)
	{
		try
		{
			$query = $this->conn->prepare("SELECT int_qtd FROM tb_prateleira WHERE id_cod_barras = :codbarra");
			$query->bindValue(':codbarra', $codbarras);
			$query->execute();
			
			$produto = $query->fetch();
			return $produto['int_qtd'];
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}

	public function getImgProduto($codbarra)
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM tb_tipo_produto WHERE cod_barras = :codbarra");
			$query->bindValue(':codbarra', $codbarra);
			$query->execute();
			
			$produto = $query->fetch();
			$setor = $this->getSetor($produto['id_secao_produto']);
			
			if($setor == 'Laticínios')
				return "milk.png";

			else if( $setor == 'Açougue' )
				return "meat.png";

			else if( $setor == 'Perfumaria' )
				return "perfume.png";

			else if( $setor == 'Padaria' )
				return "bakery.png";

			else if( $setor == 'Grãos' )
				return "cereal.png";

			else if( $setor == 'Limpeza' )
				return "cleaning-tools.png";

			else if( $setor == 'Bebidas' )
				return "glass.png";

			else if( $setor == 'Frios' )
				return "cheese.png";

			else if( $setor == 'Papelaria' )
				return "school-material.png";

			else if( $setor == 'Hortifruti' )
				return "hortifruti.png";

			else if( $setor == 'Construção' )
				return "";

			else if( $setor == 'Roupas' )
				return "shirt.png";

			else if( $setor == 'Informática' )
				return "";
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}
	
	private function vrfCodbarrasProduto($cod)
	{
		try
		{
			$query = $this->conn->prepare("SELECT cod_barras FROM tb_tipo_produto WHERE cod_barras = :cod");
			$query->bindValue(":cod", $cod);
			$query->execute();

			if($query->rowCount() == 0)
			{
				return ERR_BARCODE_NOT_FOUND;
			}
			else
			{
				return $cod;
			}
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}
	}
}