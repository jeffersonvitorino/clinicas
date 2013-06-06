<?php

error_reporting(E_ALL ^ E_NOTICE);

class Procedimento {

    public function cadastrarProcedimento($codigo, $tuss_grupos, $tuss_subgrupos, $procedimento, $id_usuario) {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'INSERT INTO procedimento 
				( 
				codigo, tuss_grupos,tuss_subgrupos,procedimento, id_usuario, ultima_atualizacao, ativo 
				) 
				VALUES 
				( 
				"' . $codigo . '", "' . $tuss_grupos . '",  "' . $tuss_subgrupos . '", "' . $procedimento . '","' . $id_usuario . '", CURRENT_TIMESTAMP(), 1
				)';
        $exe = $mySQL->runQuery($sql);

        return mysql_insert_id();
    }

    public function alterarProcedimento($id_procedimento, $codigo, $tuss_grupos, $tuss_subgrupos, $procedimento, $ativo, $id_usuario) {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'UPDATE procedimento SET
                    codigo  = "' . $codigo . '", 
                    tuss_grupo  = "' . $tuss_grupos . '", 
                    tuss_subgrupo  = "' . $tuss_subgrupos . '", 
                    procedimento  = "' . $procedimento . '", 
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "' . $ativo . '" 
                WHERE id_procedimento = ' . $id_procedimento;

        $exe = $mySQL->runQuery($sql);
    }

    public function excluirProcedimento($id_procedimento) {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'DELETE
                FROM procedimento 
                WHERE procedimento = ' . $id_procedimento;
        $exe = $mySQL->runQuery($sql);
    }

    public function desativarProcedimentoAtiva($id_procedimento, $id_usuario) {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'UPDATE procedimento SET
                    id_usuario = "' . $id_usuario . '",
                    ultima_atualizacao = CURRENT_TIMESTAMP(), 
                    ativo = "0" 
                WHERE id_procedimento = ' . $id_procedimento;
        $exe = $mySQL->runQuery($sql);
    }

    public function listarProcedimento() {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM procedimento 
                ORDER BY codigo ASC';

        return $mySQL->runQuery($sql);
    }

    public function procurarProcedimento($id_procedimento) {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT * 
                FROM procedimento
                WHERE id_procedimento = ' . $id_procedimento;

        return $mySQL->runQuery($sql);
    }

    public function procurarProcedimentoPorPalavraChave($palavraChave) {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'SELECT id_procedimento, codigo, tuss_grupos,tuss_subgrupos,procedimento, ativo, DATE_FORMAT(ultima_atualizacao,"%d/%m/%Y  %H:%i:%S") AS ultima
                FROM procedimento 
                WHERE codigo LIKE "%' . $palavraChave . '%" 
                   OR procedimento LIKE "%' . $palavraChave . '%" 
                ORDER BY procedimento ASC';
        return $mySQL->runQuery($sql);
    }

    public function consultarProcedimentoTipoAtiva() {
        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = "SELECT id_procedimento,codigo,tuss_grupos,tuss_subgrupos,procedimento 
		FROM id_procedimento 
		WHERE ativo = '1'";

        return $mySQL->runQuery($sql);
    }

}

?>