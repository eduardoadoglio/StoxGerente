<?php

require_once 'trait_desconto.php';


class Caixa
{

    use Desconto;

    private $conn;

	function __construct()
	{
        try{
            $this->conn = new PDO("mysql:server=localhost;dbname=db_stox;port=3307", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
		catch(PDOException $e){
            $this->conn = new PDO("mysql:server=localhost;dbname=db_stox;port=3306", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ativa os erros de SQL

		define("ERR_BARCODE_NOT_FOUND", 001);
		define("ERR_SUPPLIER_ID_NOT_FOUND", 002);
		define("ERR_SQL", 003);
		define("ERR_NO_FIELDS", 004);

	}

    public function getProduto($cod)
	{
		$query = $this->conn->prepare("SELECT  `nm_tipo_produto`, `nm_marca_produto`,  `int_preco_venda` FROM `tb_tipo_produto`,`tb_marca_produto` WHERE cod_barras = :cod AND id_marca_produto = cd_marca_produto;");
		$query->bindValue(":cod", $cod);
		$query->execute();

		if($query->rowCount() >= 1)
		{
			$result = $query->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		else
			return false;
	}

    public function createVenda($total, $troco, $funcionario, $pagamento)
    {
        $query = $this->conn->prepare("INSERT INTO `tb_log_venda` VALUES (null,:total,:troco,:funcionario,:pagamento, default)");
        $query->bindValue(":total",$total);
        $query->bindValue(":troco",$troco);
        $query->bindValue(":funcionario",$funcionario);
        $query->bindValue(":pagamento",$pagamento);
        $query->execute();
        $last_id = $this->conn->lastInsertId();
        return $last_id;

    }

    public function pushVenda($id_venda, $id_tipo_produto, $qtd)
    {
        $query = $this->conn->prepare("INSERT INTO `tb_venda_itens` VALUES (null, :id_venda, :id_tipo_produto, :qtd)");
        $query->bindValue(":id_venda",$id_venda);
        $query->bindValue(":id_tipo_produto",$id_tipo_produto);
        $query->bindValue(":qtd",$qtd);
        $query->execute();
    }

    public function verificarPin($pin)
    {
        $query = $this->conn->prepare("SELECT `pin_sangria` FROM tb_config_loja WHERE cd_config_loja = 1");
        $query->execute();

        if($query->rowCount() >= 1)
		{
			$result = $query->fetch(PDO::FETCH_ASSOC);

            if( $pin == $result['pin_sangria'])
            {
                return true;
            }
            else
            {
                return false;
            }

		}
		else
			return false;
    }

    public function logarCaixa($acao, $dinheiro, $id_caixa, $id_funcionario) {
        $query = $this->conn->prepare("INSERT INTO `tb_log_caixa` VALUES(null, :acao, :dinheiro, :id_caixa, :id_funcionario, default)");
        $query->bindValue(":acao",$acao);
        $query->bindValue(":dinheiro",$dinheiro);
        $query->bindValue(":id_caixa",$id_caixa);
        $query->bindValue(":id_funcionario",$id_funcionario);
        $query->execute();
    }
}
