<?php
error_reporting(E_ALL ^ E_NOTICE);

/*
CREATE TABLE tb_log( 
	id_log INT NOT NULL AUTO_INCREMENT, 
	id_adm INT NOT NULL, 
	id_log_acao INT NOT NULL, 
	data DATE NOT NULL DEFAULT '0000-00-00',
	hora TIME NOT NULL DEFAULT '00:00:00',
	ip CHAR(15) NULL DEFAULT NULL,
	PRIMARY KEY (id_log)
);

CREATE TABLE tb_log_sql(
	id_log_sql INT NOT NULL AUTO_INCREMENT,
	id_log INT NOT NULL, 
	sql_executada TEXT NOT NULL,
	PRIMARY KEY (id_log_sql)
);

CREATE TABLE tb_log_acao( 
	id_log_acao INT NOT NULL AUTO_INCREMENT,
	descricao VARCHAR(15) NOT NULL, 
	PRIMARY KEY (id_log_acao)
);

INSERT INTO tb_log_acao (id_log_acao, descricao) VALUES (1, 'Entrar');
INSERT INTO tb_log_acao (id_log_acao, descricao) VALUES (2, 'Sair');
INSERT INTO tb_log_acao (id_log_acao, descricao) VALUES (3, 'Cadastrar');
INSERT INTO tb_log_acao (id_log_acao, descricao) VALUES (4, 'Consultar');
INSERT INTO tb_log_acao (id_log_acao, descricao) VALUES (5, 'Alterar');
INSERT INTO tb_log_acao (id_log_acao, descricao) VALUES (6, 'Excluir');

tb_log      - id_log, id_adm, id_log_acao, data, hora, ip
tb_log_sql  - id_log_sql, id_log, sql_executada
tb_log_acao - id_log_acao, descricao

A��ES: 1 - Entrar | 2 - Sair | 3 - Cadastrar | 4 - Consultar | 5 - Alterar | 6 - Excluir
*/

class bdLog {
	
	public function cadastrarLog($id_adm, $id_log_acao, $data, $hora, $ip, $sql_executada){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO tb_log ( 
					id_adm, id_log_acao, data, hora, ip 
				) VALUES ( 
					"' . $id_adm . '","' . $id_log_acao . '","' . $data . '","' . $hora . '","' . $ip . '" 
				)';
		$exe = $mySQL->runQuery($sql);
		
		if (isset($sql_executada)){
			$idLog = mysql_insert_id();
			
			$sql = 'INSERT INTO tb_log_sql ( 
						id_log, sql_executada 
					) VALUES ( 
						"' . $idLog . '","' . $sql_executada . '" 
					)';
			$exe = $mySQL->runQuery($sql);
		}
	}

	public function listarAcaoLog(){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT DISTINCT(tab1.id_log_acao), tab1.descricao 
				FROM tb_log_acao AS tab1, tb_log AS tab2 
				WHERE tab1.id_log_acao = tab2.id_log_acao 
				ORDER BY tab1.descricao ASC';
		
		return $mySQL->runQuery($sql);
	}
	
	public function consultarLog($id_adm, $id_log_acao, $dataInicio, $dataFim){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT id_log, id_adm, id_log_acao, data, hora, ip 
				FROM tb_log 
				WHERE id_log <> "" ';
		
		if ($id_adm != "XXXXX"){
			$sql .= '  AND id_adm = ' . $id_adm . ' ';
		}
		
		if ($id_log_acao != "XXXXX"){
			$sql .= '  AND id_log_acao = ' . $id_log_acao . ' ';
		}
		
		if (isset($dataInicio) && (isset($dataFim))){
			$sql .= '  AND data BETWEEN "' . $dataInicio . '" AND "' . $dataFim . '" ';
		}
		
		$sql .=	'ORDER BY id_log ASC';
                
                //var_dump($sql);
		
		return $mySQL->runQuery($sql);
	}

	public function consultarLogAcao($id_log_acao){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT id_log_acao, descricao 
				FROM tb_log_acao 
				WHERE id_log_acao = ' . $id_log_acao;
		
		return $mySQL->runQuery($sql);
	}

	public function consultarLogSqlPorIdLog($id_log){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT sql_executada 
				FROM tb_log_sql 
				WHERE id_log = ' . $id_log;
		
		return $mySQL->runQuery($sql);
	}
}
?>