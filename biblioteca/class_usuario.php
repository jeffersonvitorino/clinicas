<?php
error_reporting(E_ALL ^ E_NOTICE);

class usuario {  

	public function cadastrarUsuario($id_usuario_nivel, $nome, $email, $senha){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO usuario 
				( 
				id_usuario_nivel, nome, email, senha, ativo, ultima_atualizacao 
				) 
				VALUES 
				( 
				"' . $id_usuario_nivel . '", "' . $nome . '", "' . $email . '", md5("' . $senha . '"), "1", CURRENT_TIMESTAMP() 
				)';
		$exe = $mySQL->runQuery($sql);
		
		$id_sql = mysql_insert_id();
				
		return $id_sql;
	}

	public function alterarUsuario($id_usuario, $id_usuario_nivel, $nome, $email, $senha, $ativo){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario SET 
					id_usuario_nivel   = "' . $id_usuario_nivel . '", 
					nome               = "' . $nome . '", 
					email              = "' . $email . '", 
					senha              = md5("' . $senha . '"), 
					ativo              = "' . $ativo . '", 
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario = ' . $id_usuario;
		$exe = $mySQL->runQuery($sql);
		
	}
	
	public function alterarUsuarioSenha($id_usuario, $senha, $senha_nova){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario SET 
					senha              = md5("' . $senha_nova . '"),  
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario = "' . $id_usuario . '" 
				  AND senha = md5("' . $senha . '")';
		$exe = $mySQL->runQuery($sql);
	}
	
	public function alterarUsuarioSenhaLembrar($id_usuario, $senha_nova){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario SET 
					senha              = md5("' . $senha_nova . '"),  
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario = ' . $id_usuario;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function alterarUsuarioSemSenha($id_usuario, $id_usuario_nivel, $nome, $email, $ativo){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario SET 
					id_usuario_nivel   = "' . $id_usuario_nivel . '", 
					nome               = "' . $nome . '", 
					email              = "' . $email . '", 
					ativo              = "' . $ativo . '", 
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario = ' . $id_usuario;
		$exe = $mySQL->runQuery($sql);
	}

	public function desativarUsuario($id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario SET 
					senha              = md5("Qu@lqU3rC015@"), 
					ativo              = "0", 
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario = ' . $id_usuario;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function excluirUsuario($id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$sql = 'DELETE 
				FROM usuario 
				WHERE id_usuario = ' . $id_usuario;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function listarUsuario(){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario 
				ORDER BY nome ASC';
		
		return $mySQL->runQuery($sql);
	}

	public function procurarUsuario($id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario 
				WHERE id_usuario = ' . $id_usuario;
		
		return $mySQL->runQuery($sql);
	}

	public function procurarUsuarioPorPalavraChave($palavraChave){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario 
				WHERE nome LIKE "%' . $palavraChave . '%" 
				   OR email LIKE "%' . $palavraChave . '%" 
				ORDER BY nome ASC';

		return $mySQL->runQuery($sql);
	}

	public function procurarUsuarioPorEmail($email){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario 
				WHERE email = "' . $email . '" ';

		return $mySQL->runQuery($sql);
	}
	
	public function procurarUsuarioPorEmailESenha($email, $senha){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario 
				WHERE email = "' . $email . '" 
				  AND senha = md5("' . $senha . '") 
				  AND ativo = 1';
		
		return $mySQL->runQuery($sql);
	}
	
	public function procurarUsuarioPorIdESenha($id_usuario, $senha){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario 
				WHERE id_usuario = "' . $id_usuario . '" 
				  AND senha = md5("' . $senha . '")';
		
		return $mySQL->runQuery($sql);
	}

}
?>