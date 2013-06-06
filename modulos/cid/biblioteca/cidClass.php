<?php
error_reporting(E_ALL ^ E_NOTICE);

class Cid{
    
   public function cadastrarCid($codigo, $descricao, $id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO cid 
				( 
				codigo, descricao, id_usuario, ultima_atualizacao, ativo 
				) 
				VALUES 
				( 
				"' . $codigo . '", "' . $descricao . '", "' . $id_usuario . '", CURRENT_TIMESTAMP(), 1
				)';
		$exe = $mySQL->runQuery($sql);
				
		return mysql_insert_id();
	}
    public function alterarCid($id_cid, $codigo, $descricao, $ativo, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'UPDATE cid SET
                    codigo  = "' . $codigo . '", 
                    descricao  = "' . $descricao . '", 
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "' . $ativo . '" 
                WHERE id_cid = ' . $id_cid;

        $exe = $mySQL->runQuery($sql);	
    }
    
    public function excluirCid($id_cid){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'DELETE
                FROM cid 
                WHERE id_cid= ' . $id_cid;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function desativarCidAtiva($id_cid, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'UPDATE cid SET
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "0" 
                WHERE id_cid = ' . $id_cid;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function listarCid(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM cid
                ORDER BY descricao ASC';

        return $mySQL->runQuery($sql);
    }
    
    public function procurarCid($id_cid){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM cid
                WHERE id_cid = ' . $id_cid;

        return $mySQL->runQuery($sql);
    }
    
    public function procurarCidPorPalavraChave($palavraChave){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT id_cid, codigo, descricao, ativo, DATE_FORMAT(ultima_atualizacao,"%d/%m/%Y  %H:%i:%S") AS ultima
                FROM cid
                WHERE codigo LIKE "%' . $palavraChave . '%" 
                   OR descricao LIKE "%' . $palavraChave . '%" 
                ORDER BY descricao ASC';
        return $mySQL->runQuery($sql);
    }
    
    public function consultarCidAtiva(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = "SELECT id_cid, codigo,descricao 
		FROM id_cid 
		WHERE ativo = '1'";
        
        return $mySQL->runQuery($sql);
    }
   
}
?>