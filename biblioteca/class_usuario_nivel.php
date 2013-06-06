<?php
error_reporting(E_ALL ^ E_NOTICE);

class usuario_nivel {  

	public function cadastrarUsuarioNivel($descricao){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO usuario_nivel 
				( 
				descricao
				) 
				VALUES 
				( 
				"' . $descricao . '"
				)';
		$exe = $mySQL->runQuery($sql);
		
		$id_sql = mysql_insert_id();
		
		return $id_sql;
	}
	
	public function cadastrarUsuarioNivelLigArea($id_usuario_nivel, $id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO usuario_nivel_lig_area 
				( 
				id_usuario_nivel, id_usuario_area
				) 
				VALUES 
				( 
				"' . $id_usuario_nivel . '", "' . $id_usuario_area . '" 
				)';
		$exe = $mySQL->runQuery($sql);
		
		$id_sql = mysql_insert_id();
		
		return $id_sql;
	}

	public function alterarUsuarioNivel($id_usuario_nivel, $descricao){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario_nivel SET 
					descricao = "' . $descricao . '"
				WHERE id_usuario_nivel = ' . $id_usuario_nivel;
		$exe = $mySQL->runQuery($sql);
	}

	public function excluirUsuarioNivel($id_usuario_nivel){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$sql = 'DELETE 
				FROM usuario_nivel 
				WHERE id_usuario_nivel = ' . $id_usuario_nivel;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function excluirUsuarioNivelLigArea($id_usuario_nivel){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$sql = 'DELETE 
				FROM usuario_nivel_lig_area 
				WHERE id_usuario_nivel = ' . $id_usuario_nivel;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioNivel(){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT id_usuario_nivel, descricao
				FROM usuario_nivel 
				ORDER BY descricao ASC';
		
		return $mySQL->runQuery($sql);
	}
	
	public function procurarUsuarioNivel($id_usuario_nivel){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_nivel 
				WHERE id_usuario_nivel = ' . $id_usuario_nivel;
		
		return $mySQL->runQuery($sql);
	}

	public function procurarUsuarioNivelPorPalavraChave($palavraChave){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT id_usuario_nivel, descricao
				FROM usuario_nivel 
				WHERE descricao LIKE "%' . $palavraChave . '%" 
				ORDER BY descricao ASC';

		return $mySQL->runQuery($sql);
	}
	
	public function procurarUsuarioAreaPorIdNivelEIdArea($id_usuario_nivel, $id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_nivel_lig_area 
				WHERE id_usuario_nivel = ' . $id_usuario_nivel . ' 
				  AND id_usuario_area = ' . $id_usuario_area;
		
		return $mySQL->runQuery($sql);
	}

	public function procurarPermissaoAreaPorIdNivelEIdArea($id_usuario_nivel, $id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_nivel_lig_area 
				WHERE id_usuario_nivel = ' . $id_usuario_nivel . ' 
				  AND id_usuario_area = ' . $id_usuario_area;
		
		return $mySQL->runQuery($sql);
	} 
	
	public function procurarUsuarioNivelPorDescricao($descricao){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_nivel 
				WHERE descricao = "' . $descricao . '" ';

		return $mySQL->runQuery($sql);
	}

}
?>