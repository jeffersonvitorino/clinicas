<?php
error_reporting(E_ALL ^ E_NOTICE);

class ConselhoProfissionalTipo{
    
   public function cadastrarConselhoProfissionalTipo($sigla, $descricao, $id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO lista_tipo_conselho 
				( 
				sigla, descricao, id_usuario, ultima_atualizacao, ativo 
				) 
				VALUES 
				( 
				"' . $sigla . '", "' . $descricao . '", "' . $id_usuario . '", CURRENT_TIMESTAMP(), 1
				)';
		$exe = $mySQL->runQuery($sql);
				
		return mysql_insert_id();
	}
        
    public function alterarConselhoProfissionalTipo($id_conselho_profissional_tipo, $sigla, $descricao, $ativo, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'UPDATE lista_tipo_conselho SET
                    sigla  = "' . $sigla . '", 
                    descricao  = "' . $descricao . '", 
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "' . $ativo . '" 
                WHERE id_conselho_profissional_tipo = ' . $id_conselho_profissional_tipo;

        $exe = $mySQL->runQuery($sql);	
    }
    
    public function excluirConselhoProfissionalTipo($id_conselho_profissional_tipo){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'DELETE
                FROM lista_tipo_conselho
                WHERE id_conselho_profissional_tipo= ' . $id_conselho_profissional_tipo;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function desativarConselhoProfissionalTipoAtiva($id_conselho_profissional_tipo, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'UPDATE lista_tipo_conselho SET
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "0" 
                WHERE id_conselho_profissional_tipo = ' . $id_conselho_profissional_tipo;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function listarConselho_profissional_tipo(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM lista_tipo_conselho 
                ORDER BY descricao ASC';

        return $mySQL->runQuery($sql);
    }
    
    public function procurarConselhoProfissionalTipo($id_conselho_profissional_tipo){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM lista_tipo_conselho
                WHERE id_conselho_profissional_tipo = ' . $id_conselho_profissional_tipo;

        return $mySQL->runQuery($sql);
    }
    
    public function procurarConselhoProfissionalTipoPorPalavraChave($palavraChave){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT id_conselho_profissional_tipo, sigla, descricao, ativo, DATE_FORMAT(ultima_atualizacao,"%d/%m/%Y  %H:%i:%S") AS ultima
                FROM lista_tipo_conselho 
                WHERE sigla LIKE "%' . $palavraChave . '%" 
                   OR descricao LIKE "%' . $palavraChave . '%" 
                ORDER BY descricao ASC';
        return $mySQL->runQuery($sql);
    }
    
    public function consultarConselhoProfissionalTipoAtiva(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = "SELECT id_conselho_profissional_tipo, sigla,descricao 
		FROM id_conselho_profissional_tipo 
		WHERE ativo = '1'";
        
        return $mySQL->runQuery($sql);
    }
   
}
?>