<?php

trait Desconto
{
    public function createDesconto($produto, $desconto, $termino)
    {
        try
        {
            $query = $this->conn->prepare("INSERT INTO `tb_desconto` VALUES (null,:produto, :desconto, DEFAULT, :termino)");
            $query->bindValue(":total",$produto);
            $query->bindValue(":desconto",$desconto);
            $query->bindValue(":termino",$termino);
            $query->execute();
        }
        catch( PDOException $e )
		{
			return ERR_SQL;
		}
    }

    public function verifyDesconto($codbarra)
    {
        try
        {
            $query = $this->conn->prepare("SELECT `int_desconto` FROM `tb_desconto` WHERE `id_tipo_produto` = :codbarra");
            $query->bindValue(":codbarra",$codbarra);
            $query->execute();

            if($query->rowCount() >= 1)
			{
				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					return $row['int_desconto'];
				}
			}
			else
			{
				return false;
			}
        }
        catch( PDOException $e )
		{
			return ERR_SQL;
		}
    }
}


?>
