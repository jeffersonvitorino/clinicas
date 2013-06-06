<?php
session_start();

function protegePagina() {

	if ($_SESSION["adm_acesso_id_usuario"] == "") {
		
		expulsaVisitante();

	}

}

function expulsaVisitante() {
		
	session_destroy();
	
	echo '
		  <script language="JavaScript">
			  function redireciona() {
				  window.location="?area=' . base64_encode("acesso/login_frm.php") . '"
			  }
			
			  redireciona();
		  </script>
		 ';

}
?>
