CREATE DATABASE IF NOT EXISTS db_stox;

USE db_stox;

CREATE TABLE IF NOT EXISTS tb_secao_produto(
	cd_secao_produto INT AUTO_INCREMENT PRIMARY KEY,
	nm_secao_produto VARCHAR(25) NOT NULL UNIQUE,
	ds_secao_produto VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS tb_marca_produto(
	cd_marca_produto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nm_marca_produto VARCHAR(20) NOT NULL UNIQUE,
	ds_marca_produto VARCHAR(255) DEFAULT 'Ltda.',
	int_contato_marca_produto INT DEFAULT 99999999
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_tipo_produto(
	cod_barras VARCHAR(45) NOT NULL PRIMARY KEY,
    nm_tipo_produto VARCHAR(45) NOT NULL,
    ds_tipo_produto varchar(45) NOT NULL,
    id_marca_produto INT NOT NULL,
	id_secao_produto INT NOT NULL,
    int_preco_compra DECIMAL(5,2) NOT NULL,
    int_preco_venda DECIMAL(5,2) NOT NULL,
    nr_min_prateleira INT NOT NULL DEFAULT 100,
    nr_min_estoque INT NOT NULL DEFAULT 500,
	FOREIGN KEY(id_marca_produto) REFERENCES tb_marca_produto(cd_marca_produto) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(id_secao_produto) REFERENCES tb_secao_produto(cd_secao_produto) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_desconto(
	cd_desconto INT AUTO_INCREMENT PRIMARY KEY,
	id_tipo_produto VARCHAR(50) NOT NULL,
	int_desconto INT NOT NULL,
	dt_inicio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	dt_termino TIMESTAMP NOT NULL,
	FOREIGN KEY(id_tipo_produto) REFERENCES tb_tipo_produto(cod_barras) ON DELETE CASCADE ON UPDATE CASCADE

) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_fornecedor(
	cd_fornecedor int PRIMARY KEY auto_increment,
    nm_fornecedor VARCHAR(45) NOT NULL,
    cnpj_fornecedor VARCHAR(35) NOT NULL unique,
    nm_email VARCHAR(100),
    ds_forneceddor VARCHAR(300),
    nm_dono VARCHAR(100),
    nr_telefone VARCHAR(50),
    ds_endereco VARCHAR(300),
    st_fornecedor bit DEFAULT 1 NOT NULL
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_lote(
	cd_lote int auto_increment PRIMARY KEY,
    nr_lote VARCHAR(20) NOT NULL,
    id_cod_barras VARCHAR(45) NOT NULL,
    int_qtd INT NOT NULL,
    dt_validade date NOT NULL,
    id_fornecedor INT NOT NULL,
    foreign key(id_cod_barras) references tb_tipo_produto(cod_barras) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(id_fornecedor) references tb_fornecedor(cd_fornecedor) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_prateleira(
	cd_prateleira int auto_increment PRIMARY KEY,
    id_cod_barras VARCHAR(45) NOT NULL,
    int_qtd INT NOT NULL,
    foreign key(id_cod_barras) references tb_tipo_produto(cod_barras) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_produto(
	cd_produto int auto_increment PRIMARY KEY,
    nr_qtd INT NOT NULL,
    id_lote INT NOT NULL,
    foreign key(id_lote) references tb_lote(cd_lote) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_cargo(
	cd_cargo INT AUTO_INCREMENT PRIMARY KEY,
    nm_cargo VARCHAR(30) NOT NULL UNIQUE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_funcionario(
	cd_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nm_funcionario VARCHAR(50) NOT NULL,
    nm_login VARCHAR(45) NOT NULL UNIQUE,
    nm_senha VARCHAR(35) NOT NULL,
    nm_email VARCHAR(50) NOT NULL UNIQUE,
    nr_cpf INT NOT NULL UNIQUE,
    dt_nascimento DATE NOT NULL,
    ds_endereco VARCHAR(50) NOT NULL,
	nr_casa INT NOT NULL,
    nr_telefone INT NOT NULL,
    img_funcionario VARCHAR(40),
    dt_admissao DATE NOT NULL,
    id_cargo INT NOT NULL,
    st_funcionario BIT DEFAULT 1 NOT NULL,
	FOREIGN KEY(id_cargo) REFERENCES tb_cargo(cd_cargo) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_log_movimentacao(
	cd_movimentacao int auto_increment PRIMARY KEY,
    ds_origem VARCHAR(20),
    ds_destino VARCHAR(20),
    vl_qtd INT NOT NULL,
    id_lote INT NOT NULL,
    id_funcionario INT NOT NULL,
	dt_movimentacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(id_lote) REFERENCES tb_lote(cd_lote) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_funcionario) REFERENCES tb_funcionario(cd_funcionario) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_log_local(
	cd_log_local INT AUTO_INCREMENT PRIMARY KEY,
	nm_log_local VARCHAR(255) NOT NULL UNIQUE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_metodo_pagamento(
    cd_metodo_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    nm_metodo_pagamento VARCHAR(25) NOT NULL
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_log_venda(
	cd_log_venda INT AUTO_INCREMENT PRIMARY KEY,
    vl_total DECIMAL(5,2) NOT NULL,
    vl_troco DECIMAL(5,2) NOT NULL,
    id_funcionario INT NOT NULL,
    id_metodo_pagamento INT NOT NULL,
	dt_venda TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(id_funcionario) REFERENCES tb_funcionario(cd_funcionario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_metodo_pagamento) REFERENCES tb_metodo_pagamento(cd_metodo_pagamento) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_log_caixa(
	cd_log_caixa int auto_increment PRIMARY KEY,
	ds_log_acao VARCHAR(100) NOT NULL,
	vl_dinheiro double(8,2) NOT NULL,
	nr_caixa INT NOT NULL,
	id_funcionario INT NOT NULL,
	dt_log_caixa timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	foreign key(id_funcionario) references tb_funcionario(cd_funcionario) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

-- Create table tb_log_comentarios()

CREATE TABLE IF NOT EXISTS tb_venda_itens(
	cd_venda_item int auto_increment PRIMARY KEY,
    id_log_venda INT NOT NULL,
    id_tipo_produto VARCHAR(45) NOT NULL,
    nr_qtd INT NOT NULL,
    FOREIGN KEY(id_log_venda) REFERENCES tb_log_venda(cd_log_venda) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_tipo_produto) REFERENCES tb_tipo_produto(cod_barras) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_config_loja(
	cd_config_loja INT PRIMARY KEY AUTO_INCREMENT,
    nr_cnpj INT NOT NULL,
	nm_loja VARCHAR(20) NOT NULL,
	img_logo_loja VARCHAR(255),
	vl_lim_sangria DOUBLE(8,2) NOT NULL,
	vl_min_sangria DOUBLE(8,2) NOT NULL,
	pin_sangria INT NOT NULL
) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_sangria(
	cd_sangria INT AUTO_INCREMENT PRIMARY KEY,
	vl_sangria double(8,2) NOT NULL,
	vl_restande double(8,2) NOT NULL,
	nr_caixa INT NOT NULL,
	id_funcionario INT NOT NULL,
	id_gerente INT NOT NULL,
	dt_sangria TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	foreign key(id_funcionario) references tb_funcionario(cd_funcionario) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign key(id_gerente) references tb_funcionario(cd_funcionario) ON DELETE CASCADE ON UPDATE CASCADE

) DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS tb_notificacoes(
    cd_notificacao INT PRIMARY KEY AUTO_INCREMENT,
    dt_notificacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    msg_notificacao VARCHAR(300) NOT NULL,
    id_cargo INT NOT NULL,
    
    FOREIGN KEY(id_cargo) REFERENCES tb_cargo(cd_cargo) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARACTER SET = utf8;