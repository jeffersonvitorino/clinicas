<?php
error_reporting(E_ALL ^ E_NOTICE);

class ConselhoProfissional{
    
   public function cadastrarConselhoProfissional($id_conselho_profissional_tipo,$numero, $uf, $id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO conselho_profissional 
				( 
				id_conselho_profissional_tipo,numero, uf, id_usuario, ultima_atualizacao, ativo 
				) 
				VALUES 
				( 
				"' . $id_conselho_profissional_tipo. '","' . $numero . '", "' . $uf . '", "' . $id_usuario . '", CURRENT_TIMESTAMP(), 1
				)';
		$exe = $mySQL->runQuery($sql);
				
		return mysql_insert_id();
	}
        
    public function alterarConselhoProfissional( $id_conselho_profissional_tipo,$numero, $uf, $ativo, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'UPDATE conselho_profissional SET
                    numero  = "' . $numero . '", 
                    uf  = "' . $uf . '", 
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "' . $ativo . '" 
                WHERE id_conselho_profissional_tipo = ' . $id_conselho_profissional_tipo;

        $exe = $mySQL->runQuery($sql);	
    }
    
    public function excluirConselhoProfissional($id_conselho_profissional){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'DELETE
                FROM conselho_profissional 
                WHERE id_conselho_profissional_tipo= ' . $id_conselho_profissional;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function desativarConselhoProfissionalAtiva($id_conselho_profissional, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'UPDATE conselho_profissional SET
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "0" 
                WHERE id_conselho_profissional = ' . $id_conselho_profissional;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function listarConselho_profissional(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM conselho_profissional
                ORDER BY uf ASC';

        return $mySQL->runQuery($sql);
    }
    
    public function procurarConselhoProfissional($id_conselho_profissional){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM conselho_profissional
                WHERE id_conselho_profissional = ' . $id_conselho_profissional;

        return $mySQL->runQuery($sql);
    }
    
    public function procurarConselhoProfissionalPorPalavraChave($palavraChave){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT id_conselho_profissional, numero, uf, ativo, DATE_FORMAT(ultima_atualizacao,"%d/%m/%Y  %H:%i:%S") AS ultima
                FROM conselho_profissional 
                WHERE numero LIKE "%' . $palavraChave . '%" 
                   OR uf LIKE "%' . $palavraChave . '%" 
                ORDER BY uf ASC';
        return $mySQL->runQuery($sql);
    }
    
    public function consultarConselhoProfissionalAtiva(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = "SELECT id_conselho_profissional, numero,uf 
		FROM id_conselho_profissional 
		WHERE ativo = '1'";
        
        return $mySQL->runQuery($sql);
    }
   
}
?>