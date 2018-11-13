<?php
	class Gerente
	{
		private $mysqli;

		function __construct(){
			$this->mysqli =new mysqli("localhost", "root","usbw","db_stox");
			if (mysqli_connect_errno()){
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			define("ERR_SQL", 0.03);
		}


		////////////////////////////////////// FORNECEDOR //////////////////////////////////////////////////////////////////////////////
		public function cadFornecedor($nm_fornecedor, $nm_fornecedor, $cnpj_fornecedor){
			$sql =("INSERT INTO tb_fornecedor  (`cd_fornecedor`, `nm_fornecedor`, `cnpj_fornecedor`, st_fornecedor) VALUES (null, `$nm_fornecedor`, `$nm_fornecedor`, `$cnpj_fornecedor`, 1 ");
	        if (!$this->mysqli->query($sql)){
	        	return ERR_SQL;
	       	}
	        else{
	        	echo true;
	       	}
		}

		public function verFornecedores(){
			$sql = ("SELECT nm_fornecedor FROM tb_fornecedor order by nm_fornecedor"); //Lista todos os fornecedores
            if (!$result = $this->mysqli->query($sql)){
					return ERR_SQL;
            }
            else{
				$fornecedores = array();
            	while ($obj = $result->fetch_object()) {
					array_push($fornecedores, $obj->nm_fornecedor);
				}
				return $fornecedores;
			}
		}

		public function verFornecedor($cd){ //Exibe os dados do fornecedor especificado
			$sql = ("SELECT * FROM tb_fornecedor WHERE cd_fornecedor = $cd");
            if (!$result = $this->mysqli->query($sql)) {
				return ERR_SQL;
            }
            else{
				$fornecedor = array();
            	while ($obj = $result->fetch_object()) {
					array_push($fornecedor, $obj->nm_fornecedor, $obj->cnpj_fornecedor, $obj->st_fornecedor );
				}
				return $fornecedor; //retorna o array
			}
		}

        public function countLotes($cd_fornecedor, $codbarra){ //Exibe quantidade de lotes de determinado produto do fornecedor selecionado
        	$sql = "SELECT count(cd_lote) as `qtd_lotes`, id_fornecedor FROM tb_lote WHERE id_fornecedor = $cd_fornecedor and id_cod_barras = '$codbarra'";
			$result = $this->mysqli->query($sql);
			while ($obj = $result->fetch_object() ){
        		return $obj->qtd_lotes;
			}
	   	}

        public function prodFornecedor($cd){//Exibe produtos comprados de determinado fornecedor
			$sql = ("SELECT l.id_cod_barras, l.id_fornecedor FROM tb_lote l WHERE l.id_fornecedor = $cd");
            if (!$result = $this->mysqli->query($sql)) {
            	return ERR_SQL;
            }
            else{
            	$produtos = array();
            	while ($obj = $result->fetch_object()) {
					array_push($produtos, $obj->id_cod_barras);
              	}
            	return $produtos;
            }
        }

        public function fornecedorInativo($cd){
			$sql = ("UPDATE `tb_fornecedor` SET `st_fornecedor`= 0 WHERE cd_fornecedor = $cd");
	        if (!$result = $this->mysqli->query($sql)) {
	            return ERR_SQL;
	        }
       	}

       	public function fornecedorAtivo($cd){
			$sql = ("UPDATE `tb_fornecedor` SET `st_fornecedor`= 1 WHERE cd_fornecedor = $cd");
	        if (!$result = $this->mysqli->query($sql)) {
	            return ERR_SQL;
	        }
       	}

       	public function alteraFornecedor($cd, $nm_email, $nr_telefone, $ds_fornecedor, $nm_dono, $ds_endereco){
       		$sql = "UPDATE tb_fornecedor SET nm_email = '$nm_email', nr_telefone = '$nr_telefone', ds_fornecedor = '$ds_fornecedor', nm_dono = '$nm_dono', ds_endereco = '$ds_endereco' WHERE cd_fornecedor = '$cd'";
       		if (!$result = $this->mysqli->query($sql)) {
	            return ERR_SQL;
	        }
	        else{
	        	echo true;
	        }
       	}




		//////////////////////////////////////////////////// FUNCIONARIO ///////////////////////////////////////////////////////////////////////

		public function cadFuncionario($nm_funcionario, $nm_login, $nm_senha, $nr_cpf, $dt_admissao, $dt_nascimento, $id_cargo){
			if (isset($_POST['nm_funcionario']) && isset($_POST['nm_login']) && isset($_POST['nm_senha']) && isset($_POST['conf_senha'])  && isset($_POST['nr_cpf']) && isset($_POST['dt_admissao']) && isset($_POST['dt_nascimento']) && isset($_POST['id_cargo']) && $_POST['nm_senha'] = $_POST['conf_senha']) {
				$_POST['nm_funcionario'] = $nm_funcionario;
				$_POST['nm_login'] = $nm_login;
				$_POST['nm_senha'] = $nm_senha;
				$_POST['conf_senha'] = $conf_senha;
				$_POST['nr_cpf'] = $nr_cpf;
				$_POST['dt_admissao'] = $dt_admissao;
				$_POST['dt_nascimento'] = $dt_nascimento;
				$_POST['id_cargo'] = $id_cargo;
				$sql = ("INSERT INTO tb_funcionario  (`cd_funcionario`, `nm_funcionario`, `nm_login`, `nm_senha`, `nr_cpf`, `dt_admissao`, `dt_nascimento`, `id_cargo`) VALUES (null, `$nm_funcionario`, `$nm_login`, `$nm_senha`, `$nr_cpf`, `$dt_admissao`, `$dt_nascimento`, `$id_cargo`");
		        if (!$this->mysqli->query($sql)){
		            return ERR_SQL;
		       	}
			}
		}

		public function verFuncionarios(){
			$sql = ("SELECT f.nm_funcionario, c.nm_cargo FROM tb_cargo c,tb_funcionario f WHERE f.id_cargo = c.cd_cargo order by f.nm_funcionario");//Lista todos os funcionários
            if ($result = $this->mysqli->query($sql)) {
				$funcionarios = array(); //cria o array
            	while ($obj = $result->fetch_object()) {
					array_push($funcionarios, $obj->nm_funcionario, $obj->nm_cargo);
	            }
	          	return $funcionarios; //retorna o array
	        }
      		$result->close();
        }


		public function verFuncionario($cd){
			$sql = ("SELECT  * FROM tb_funcionario f, tb_cargo c WHERE id_cargo = cd_cargo and cd_funcionario= $cd"); //Exibe dados de um funcionário específico
            if (!$result = $this->mysqli->query($sql)) {
            	return ERR_SQL;
            }
           	else{
				$funcionario = array(); //cria o array
				while ($obj = $result->fetch_object()) {
					array_push($funcionario, $obj->nm_funcionario, $obj->nm_email, $obj->nm_login, $obj->nr_cpf, $obj->dt_nascimento, $obj->ds_endereco, $obj->nr_casa, $obj->nr_telefone, $obj->img_funcionario, $obj->dt_admissao, $obj->nm_cargo);
				}
				return $funcionario; //retorna o array
			}
			$result->close();
		}

		public function funcInativo($cd){
			$sql = ("UPDATE `tb_funcionario` SET `st_funcionario`= 0 WHERE cd_funcionario = $cd");
			if (!$result = $this->mysqli->query($sql)) {
				return ERR_SQL;
			}
		}

		public function funcAtivo($cd){
			$sql = ("UPDATE `tb_funcionario` SET `st_funcionario`= 1 WHERE cd_funcionario = $cd");
				if (!$result = $this->mysqli->query($sql)) {
					return ERR_SQL;
			}
		}
		public function alteraFuncionario($cd, $nm_funcionario, $nm_email, $nr_telefone, $nr_casa, $ds_endereco){
       		$sql = "UPDATE tb_funcionario SET nm_funcionario = '$nm_funcionario', nm_email = '$nm_email', nr_telefone = '$nr_telefone', nr_casa = '$nr_casa', ds_endereco = '$ds_endereco' WHERE cd_funcionario = '$cd'";
       		if (!$result = $this->mysqli->query($sql)) {
	            return ERR_SQL;
	        }
	        else{
	        	echo true;
	        }
       	}

		////////////////////////////////////////////////////// PRODUTO /////////////////////////////////////////////////
		public function cadProduto($nm_funcionario, $nm_login, $nm_senha, $nr_cpf, $dt_admissao, $dt_nascimento, $id_cargo){
			$sql = ("INSERT INTO tb_funcionario  (`cd_funcionario`, `nm_funcionario`, `nm_login`, `nm_senha`, `nr_cpf`, `dt_admissao`, `dt_nascimento`, `id_cargo`) VALUES (null, `$nm_funcionario`, `$nm_login`, `$nm_senha`, `$nr_cpf`, `$dt_admissao`, `$dt_nascimento`, `$id_cargo`, 1");
	        if (!$this->mysqli->query($sql)){
	            return ERR_SQL;
	        }
	       	else{
	        	echo true;
	       	}
		}

		public function verMovimentacoes(){
			$sql = ("SELECT * from tb_log_movimentacao");
            if ($result = $this->mysqli->query($sql)) {
				$movimentacao = array(); //cria o array
            	while ($obj = $result->fetch_object()) {
					array_push($movimentacao, $obj->id_lote, $obj->vl_qtd, $obj->ds_origem, $obj->ds_destino);
	            }
	            return $movimentacao; //retorna o array
            	$result->close();
			}
		}

		public function defineSangria($vl_sangria, $senha_sangria){
			$sql = "INSERT INTO tb_configuracoes VALUES (null, '$vl_sangria', '$senha_sangria')";
			if (!$this->mysqli->query($sql)){
	        	return ERR_SQL;
	       	}
	        else{
	        	echo true;
	       	}
		}

		public function alteraProduto($cod_barras, $nm_tipo_produto, $int_preco_compra, $int_preco_venda, $desc_tipo_produto){
       		$sql = "UPDATE tb_tipo_produto SET nm_tipo_produto = '$nm_tipo_produto', int_preco_compra = '$int_preco_compra', int_preco_venda = '$int_preco_venda', desc_tipo_produto = '$desc_tipo_produto' WHERE cod_barras = '$cod_barras'";
       		if (!$result = $this->mysqli->query($sql)) {
	            return ERR_SQL;
	        }
	        else{
	        	echo true;
	        }
       	}

       	public function maisVendidos($id_tipo_produto){
			$sql = ("SELECT id_tipo_produto, sum(nr_qtd) as 'soma' from tb_venda_itens where id_tipo_produto = '$id_tipo_produto' ");//Lista todos os funcionários
	        if ($result = $this->mysqli->query($sql)) {
				$vendas = array(); //cria o array
            	while ($obj = $result->fetch_object()) {
					array_push($vendas, $obj->id_tipo_produto, $obj->soma);
	            }
	            return $vendas; //retorna o array
            	$result->close();
			}
		}

       	//////////////////////////////////////////////// CONFIGURAÇÕES ////////////////////////////////////////////////

       	public function alteraComercio($nr_cnpj, $nm_loja, $img_logo_loja, $vl_lim_sangria, $vl_min_sangria, $pin_sangria){
       		$sql =  "UPDATE tb_config_loja SET nr_cnpj = '$nr_cnpj', nm_loja = '$nm_loja', img_logo_loja = '$img_logo_loja', vl_lim_sangria = '$vl_lim_sangria', pin_sangria = '$pin_sangria'";
       		if (!$result = $this->mysqli->query($sql)) {
	            return ERR_SQL;
	        }
	        else{
	        	echo true;
	        }
       	}


	}
?>
