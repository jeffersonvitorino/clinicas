<?php 
class MySQL {
        /*
	var $host   = 'localhost';
	var $usr    = 'leogalva_root';
	var $pw     = 'root123456';
	var $bDados = 'leogalva_forum_consumidor';
	*/
	
	var $host   = 'localhost';
	var $usr    = 'root';
	var $pw     = '';


	var $bDados = 'clinicas';
	
	
	var $sql; // Query - instru&ccedil;&atilde;o SQL
	var $conn; // Conex&atilde;o ao bano
	var $resultado; // Resultado de uma consulta (query)

	function MySQL() {
	}
	
	// Esta fun&ccedil;&atilde;o conecta-se ao banco de dados e o seleciona
	function connMySQL() {
		$this->conn = mysql_connect($this->host,$this->usr,$this->pw);
		if(!$this->conn) {
			echo "<p>N�o foi poss&iacute;vel conectar-se ao servidor MySQL.</p>\n" 
				 .
				 "<p><strong>Erro MySQL: " . mysql_error() . "</strong></p>\n";
				 exit();
		} elseif (!mysql_select_db($this->bDados,$this->conn)) {
			echo "<p>N&atilde;o foi poss&iacute;vel selecionar o Banco de Dados desejado.</p>\n"
				 .
				 "<p><strong>Erro MySQL: " . mysql_error() . "</strong></p>\n";
				 exit();
		}
	}
	
	function runQuery($sql) {
		$this->connMySQL($this->bDados);
		$this->sql = $sql;
		if($this->resultado = mysql_query($this->sql)) {
			//$this->closeConnMySQL();
			return $this->resultado;
		} else {
			exit("<p>Erro MySQL: " . mysql_error() . "</p>");
			//$this->closeConnMySQL();
		}
	}
	
	function closeConnMySQL() {
		return mysql_close($this->conn);
	}
	
} // Finaliza a classe MySQL

$mySQL = new MySQL;
?>
