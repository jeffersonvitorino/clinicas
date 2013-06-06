<?php
error_reporting(E_ALL ^ E_NOTICE);

class Especialidade{
    
   public function cadastrarEspecialidade($nome,$id_usuario){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
	
		$sql = 'INSERT INTO especialidade 
				( 
				nome,id_usuario, ultima_atualizacao, ativo 
				) 
				VALUES 
				( 
				"' . $nome . '", "' . $id_usuario . '", CURRENT_TIMESTAMP(), 1
				)';
		$exe = $mySQL->runQuery($sql);
				
		return mysql_insert_id();
	}
    public function alterarEspecialidade($id_especialidade, $nome,$ativo, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'UPDATE especialidade SET
                    nome  = "' . $nome . '", 
                id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "' . $ativo . '" 
                WHERE id_especialidade = ' . $id_especialidade;

        $exe = $mySQL->runQuery($sql);	
    }
    
    public function excluirEspecialidade($id_especialidade){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'DELETE
                FROM especialidade
                WHERE id_especialidade= ' . $id_especialidade;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function desativarEspecialidadeAtiva($id_especialidade, $id_usuario){
        $mySQL = new MySQL;
        $mySQL->connMySQL();
        
        $sql = 'UPDATE especialidade SET
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "0" 
                WHERE id_especialidade = ' . $id_especialidade;
        $exe = $mySQL->runQuery($sql);
    }
    
    public function listarEspecialidade(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM especialidade
                ORDER BY nome ASC';

        return $mySQL->runQuery($sql);
    }
    
    public function procurarEspecialidade($id_especialidade){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM especialidade
                WHERE id_especialidade = ' . $id_especialidade;

        return $mySQL->runQuery($sql);
    }
    
    public function procurarEspecialidadePorPalavraChave($palavraChave){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT id_especialidade,nome,ativo, DATE_FORMAT(ultima_atualizacao,"%d/%m/%Y  %H:%i:%S") AS ultima
                FROM especialidade
                WHERE nome LIKE "%' . $palavraChave . '%" 
                              ORDER BY nome ASC';
        return $mySQL->runQuery($sql);
    }
    
    public function consultarEspecialidadeAtiva(){
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = "SELECT id_especialidade, nome 
		FROM id_especialidade 
		WHERE ativo = '1'";
        
        return $mySQL->runQuery($sql);
    }
   
}
?>