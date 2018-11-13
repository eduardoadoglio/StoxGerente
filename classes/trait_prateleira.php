<?php

trait Prateleira
{	
	public function verPrateleira()
	{
		try
		{
			$query = $this->conn->prepare("SELECT id_cod_barras FROM tb_prateleira");
			$query->execute();

			$codbarras = array();
			if($query->rowCount() >= 1)
			{
				while( $row = $query->fetch(PDO::FETCH_ASSOC) )
				{
					array_push($codbarras, $row['id_cod_barras']);
				}

				$result = array();
				foreach($codbarras as $codbarra)
				{
					$produto = $this->getProduto($codbarra);
					$result[$produto['nm_tipo_produto']] = $this->getQuantidade($codbarra);
				}
				return $result;
			}
			else
				return false;
		}
		catch( PDOException $e )
		{
			return ERR_SQL;
		}
	}

	public function getQuantidade($id)
	{
		try
		{
			$query = $this->conn->prepare("SELECT int_qtd FROM tb_prateleira WHERE id_cod_barras = :id");
			$query->bindValue(':id', $id);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);

			if( $result['int_qtd'] < 0 )
				return ERR_INVALID_QUANTITY;
			else
				return $result['int_qtd'];
		}
		catch( PDOException $e )
		{
			return ERR_SQL;
		}
	}

	public function vrfQuantidadePrateleira($codbarras)
	{
		try
		{
			$query = $this->conn->prepare("SELECT nr_min_prateleira FROM tb_produto WHERE cod_barras = :codbarras");
			$query->bindValue(':codbarras', $codbarras);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$quantidade = $this->getQuantidade($codbarras);
			if( $quantidade <= $result['nr_min_prateleira'] )
				return WAR_LOW_QUANTITY;

			else if(($quantidade > $result['nr_min_prateleira']) && (($quantidade - $result['nr_min_prateleira']) < 10))
			{
				return WAR_NEAR_LOW_QUANTITY;
			}

			else
				return UNKOWN_BEHAVIOR;
			
			return true;
		}
		catch( PDOException $e )
		{
			return ERR_SQL;
		}
	}
}