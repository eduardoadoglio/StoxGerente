USE db_stox;

INSERT INTO `tb_cargo` (`cd_cargo`, `nm_cargo`) VALUES
(1, 'Repositor'),
(2, 'Gerente'),
(3, 'Caixa');

INSERT INTO `tb_funcionario` (`cd_funcionario`, `nm_funcionario`, `nm_login`, `nm_senha`, `nr_cpf`, `dt_admissao`, `dt_nascimento`, `id_cargo`, `nm_email`, `ds_endereco`, `nr_telefone`, `nr_casa`) VALUES
(1, 'João', 'repositor', '123', '1738219231', '2012-02-02', '2012-02-02', 1, 'uol@uol.com', 'c', 23, 231),
(2, 'Cleber', 'gerente', '123', '1738219232', '2012-02-02', '2012-02-02', 2, '123@gc.com', 'b', 43, 244),
(3, 'Silvio', 'caixa', '123', '1738219233', '2012-02-02', '2012-02-02', 3, 'ttuu@tutucom', 'a', 11, 099);

INSERT INTO `tb_secao_produto` VALUES
(NULL, 'Açougue', 'Carnes e derivados.'),
(NULL, 'Perfumaria', 'Perfume e derivados.'),
(NULL, 'Padaria', 'Pão e derivados.'),
(NULL, 'Laticínios', 'Leites e derivados.'),
(NULL, 'Grãos', 'Arroz e derivados.'),
(NULL, 'Limpeza', 'Veja e derivados.'),
(NULL, 'Bebidas', 'Cerveja e derivados.'),
(NULL, 'Frios', 'Leites e derivados.'),
(NULL, 'Papelaria', 'Papéis e derivados.'),
(NULL, 'Hortifruti', 'Frutas e vegetais'),
(NULL, 'Construção', 'Cimento e derivados.'),
(NULL, 'Roupas', 'Bonés e derivados.'),
(NULL, 'Pet shop', 'Ração e derivados.'),
(NULL, 'Informática', 'Mouses e derivados.');

INSERT INTO `tb_marca_produto` VALUES
(NULL, 'Cheqstlé', DEFAULT, DEFAULT),
(NULL, 'Mike', DEFAULT, DEFAULT),
(NULL, 'Nestlé', DEFAULT, DEFAULT),
(NULL, 'Fazenda Zulatto', DEFAULT, DEFAULT);

INSERT INTO `tb_tipo_produto` VALUES
('132F23E1', 'Leite Qualitá', 'Leite Qualitá 1L 1un' , 1, 2, '5.25', '6.00', 50, 200),
('242G23A1', 'Arroz' , 'Arroz Prato Fino 1Kg 1un', 2, 5, 5.25, '6.00', 40, 160),
('5C27Y345', 'Bolacha Adria' ,'Bolacha Adria 300g 25un', 3, 6, 5.25, '6.00', 100, 400);

INSERT INTO `tb_fornecedor` VALUES
(NULL, 'Apple', '29392812', 'email@mail.com', 'ele nos fornece', 'Isabela', '13 97474744', 'Rua da Isabela', 1),
(NULL, 'IBM', '93748235', 'email@mail.com', 'ele nos fornece', 'Eduardo', '13 97474744', 'Rua do Eduardo', 1),
(NULL, 'Microsoft', '02947385', 'email@mail.com', 'ele nos fornece', 'Vinicius', '13 97474744', 'Rua do Vinicius', 1);

INSERT INTO `tb_lote` VALUES
(NULL, 'NB01', '132F23E1', 5, '2012-02-02', 1),
(NULL, 'NB02', '242G23A1', 30, '2000-05-03', 1),
(NULL, 'NB03', '242G23A1', 5, '2012-02-02', 1),
(NULL, 'NB04', '5C27Y345', 13, '2012-02-02', 1),
(NULL, 'NB05', '132F23E1', 5, '2012-02-02', 1),
(NULL, 'NB06', '242G23A1', 5, '2012-02-02', 1);

INSERT INTO `tb_prateleira` VALUES
(NULL, '132F23E1', 10),
(NULL, '242G23A1', 10),
(NULL, '5C27Y345', 0);

INSERT INTO `tb_config_loja` VALUES
(NULL, 123, 'Atacadão do Xec', 'logoLoja.png', 2000, 2469, '123');

INSERT INTO `tb_log_movimentacao` VALUES
(NULL, "estoque", "prateleira", 10, 3, 3, '2012-02-02 13:23:42'),
(NULL, "estoque", "prateleira", 15, 2, 2, '2012-02-02 13:23:43'),
(NULL, "estoque", "prateleira", 10, 1, 3, '2012-02-02 13:23:44'),
(NULL, "estoque", "prateleira", 10, 4, 3, '2012-02-02 13:23:45'),
(NULL, "estoque", "prateleira", 20, 3, 1, '2012-02-02 13:23:46');

INSERT INTO `tb_desconto`(`cd_desconto`, `id_tipo_produto`, `int_desconto`, `dt_inicio`, `dt_termino`) VALUES
(NULL, '132F23E1', 90, DEFAULT, "2018-11-10 00:00:00");

INSERT INTO `tb_metodo_pagamento`(`cd_metodo_pagamento`, `nm_metodo_pagamento`) VALUES 
(NULL, 'Dinheiro'), 
(NULL, 'Crédito'), 
(NULL, 'Débito');

INSERT INTO `tb_log_venda`(`cd_log_venda`, `vl_total`, `vl_troco`, `id_funcionario`, `id_metodo_pagamento`, `dt_venda`) VALUES 
(NULL, 350.99, 24.30, 3, 1, '12-12-2000'),
(NULL, 35.00, 0.50, 2, 1, '12-12-2000'),
(NULL, 96.30, 5.70, 2, 1, '12-12-2000');

INSERT INTO `tb_venda_itens`(`cd_venda_item`, `id_log_venda`, `id_tipo_produto`, `nr_qtd`) VALUES
(null, 1, '132F23E1', 2),
(null, 1, '242G23A1', 3),
(null, 1, '5C27Y345', 5);