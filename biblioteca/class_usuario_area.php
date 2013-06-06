<?php
error_reporting(E_ALL ^ E_NOTICE);

class usuario_area {  

	public function cadastrarUsuarioArea($descricao, $caminho, $area_id, $ordem){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO usuario_area 
				( 
				descricao, caminho, area_id, ordem, ativo, ultima_atualizacao 
				) 
				VALUES 
				( 
				"' . $descricao . '", "' . $caminho . '", "' . $area_id . '", "' . $ordem . '", "1", CURRENT_TIMESTAMP() 
				)';
		$exe = $mySQL->runQuery($sql);
		
		$id_sql = mysql_insert_id();
		
		return $id_sql;
	}

	public function alterarUsuarioArea($id_usuario_area, $descricao, $caminho, $area_id, $ordem, $ativo){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario_area SET 
					descricao          = "' . $descricao . '", 
					caminho            = "' . $caminho . '", 
					area_id            = "' . $area_id . '", 
					ordem              = "' . $ordem . '",
					ativo              = "' . $ativo . '", 
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario_area = ' . $id_usuario_area;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function desativarUsuarioArea($id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'UPDATE usuario_area SET 
					ativo              = "0", 
					ultima_atualizacao = CURRENT_TIMESTAMP() 
				WHERE id_usuario_area = ' . $id_usuario_area;
		$exe = $mySQL->runQuery($sql);
	}

	public function excluirUsuarioArea($id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$sql = 'DELETE 
				FROM usuario_area 
				WHERE id_usuario_area = ' . $id_usuario_area;
		$exe = $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioArea(){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				ORDER BY descricao ASC';
		
		return $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioAreaAtivo(){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				WHERE ativo = 1 
				ORDER BY area_id, descricao ASC';
		
		return $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioAreaAtivoPai(){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				WHERE ativo = 1 
				  AND (area_id = 0 
				       OR caminho = "") 
				ORDER BY ordem ASC';
		
		return $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioAreaPorIdNivel($id_usuario_nivel){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT ua.* 
				FROM usuario_nivel_lig_area AS unla, usuario_area AS ua 
				WHERE unla.id_usuario_nivel = ' . $id_usuario_nivel . ' 
				  AND unla.id_usuario_area = ua.id_usuario_area 
				  AND ua.ativo = 1 
				ORDER BY ua.area_id, ua.ordem';
		
		return $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioAreaPorAreaId($id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				WHERE area_id = ' . $id_usuario_area . ' 
				  AND ativo = 1 
				ORDER BY ordem';
		
		return $mySQL->runQuery($sql);
	}
	
	public function listarUsuarioAreaPorAreaIdeIdNivel($id_usuario_nivel, $id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$sql = 'SELECT ua.* 
				FROM usuario_nivel_lig_area AS unla, usuario_area AS ua 
				WHERE unla.id_usuario_nivel = "' . $id_usuario_nivel . '" 
				  AND unla.id_usuario_area = ua.id_usuario_area 
				  AND ua.area_id = "' . $id_usuario_area . '" 
				  AND ua.ativo = 1 
				ORDER BY ua.ordem';
		
		return $mySQL->runQuery($sql);
	}
	
	public function contarUsuarioAreaTotalDeSubItens($id_usuario_nivel, $id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$sql = 'SELECT COUNT(ua.id_usuario_area) total 
				FROM usuario_nivel_lig_area AS unla, usuario_area AS ua 
				WHERE ua.area_id = ' . $id_usuario_area . ' 
				  AND ua.ativo = 1 
				  AND ua.id_usuario_area = unla.id_usuario_area 
				  AND unla.id_usuario_nivel = ' . $id_usuario_nivel;
		
		$exe = $mySQL->runQuery($sql);
		$inf = mysql_fetch_array($exe);
		
		return $inf["total"];
	}
	
	public function procurarUsuarioArea($id_usuario_area){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				WHERE id_usuario_area = ' . $id_usuario_area;
		
		return $mySQL->runQuery($sql);
	}

	public function procurarUsuarioAreaPorPalavraChave($palavraChave){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				WHERE descricao LIKE "%' . $palavraChave . '%" 
				ORDER BY area_id, descricao ASC';

		return $mySQL->runQuery($sql);
	}
	
	public function procurarUsuarioAreaPorDescricaoEAreaId($descricao, $area_id){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'SELECT * 
				FROM usuario_area 
				WHERE descricao = "' . $descricao . '" 
				  AND area_id = ' . $area_id ;

		return $mySQL->runQuery($sql);
	}

}
?>