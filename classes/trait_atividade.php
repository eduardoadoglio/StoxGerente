<?php

trait Atividade
{
	public $func;
	public $acao;
	public $alvo;
	public $data;

	private $acoes = ['moveu', 'cadastrou', 'fez', 'alterou', 'apagou'];
	public $funcionarios;
	function __construct($func, $acao, $alvo, $data)
	{
		$this->func = $func;
		$this->acao = $acao;
		$this->alvo = $alvo;
		$this->data = $data;
		$this->funcionarios = $this->getFuncionarios();
	}

	public function getFuncionarios()
	{
		try
		{
			$query = $this->conn->prepare("SELECT cd_funcionario FROM tb_funcionario");
			$query->execute();

			$funcionarios = [];
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				array_push($funcionarios, $row['cd_funcionario']);
			}
			return $funcionarios;
		}
		catch(PDOException $e)
		{
			echo $e;
			return ERR_SQL;
		}
	}

	public function registrarAtividade()
	{
		try
		{
			$query = $this->conn->prepare("INSERT INTO tb_atividades(nm_func, nm_acao, nm_alvo, dt_atividade) VALUES(:func, :acao, :alvo, :data)");
			$query->bindValue(':func', $this->tipo);
			$query->bindValue(':acao', $this->acao);
			$query->bindValue(':alvo', $this->alvo);
			$query->bindValue(':data', $this->data);
			$query->execute();
		}
		catch(PDOException $e)
		{
			return ERR_SQL;
		}

	}
}