<?php
header("Content-Type: text/html; charset=utf-8", true); 

error_reporting(E_ALL ^ E_NOTICE);

session_start();

$area = base64_decode($_REQUEST["area"]);

if (($area != "") and ($area != "acesso/login_frm.php") and ($area != "acesso/login_exe.php") and ($area != "acesso/lembrar_senha_frm.php") and ($area != "acesso/lembrar_senha_exe.php")){
	include_once("seguranca.php"); 	
	protegePagina();
}

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/funcoesDiversas.php");
include_once("../biblioteca/class_usuario_nivel.php");
include_once("../biblioteca/class_usuario_area.php");
include_once("../biblioteca/class_menu.php");

$acaoUsuarioArea  = new usuario_area();
$acaoUsuarioNivel = new usuario_nivel();
$acaoMenu         = new Menu();

// echo var_dump($area);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>FisiALGi</title>
<meta name='description' content='Descrição do Site' />
<meta name='keywords' content='Palavras, Chaves' />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="shortcut icon" href="../design/util/icone_alg.png" type="image/x-icon" />

<script type="text/javascript" src="../js/jquery-1.4.2.js"></script>

<script type="text/javascript" src="../js/jquery.meio.mask.js"></script> 
<!--
<script type="text/javascript" src="../js/funcoes.js"></script>
<script type="text/javascript" src="../js/java.js"></script>
<script type="text/javascript" src="../js/js_funcoes_diversas.js"></script>
-->
<link rel="stylesheet" href="../design/css/backEnd.css" type="text/css" media="screen" />

<!-- MENU [Inicio] -->

<link rel="stylesheet" type="text/css" href="../design/css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="../design/css/ddsmoothmenu-v.css" />

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> -->
<script type="text/javascript" src="../js/ddsmoothmenu.js"></script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<!-- MENU [Fim] -->

</head>

<body>

<div id="tudo_conteudo">

	<table width="900" height="100" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #000000;">
	  <tr>
		<td><img src="../design/layout/backEnd/bg_topo.jpg" width="900" height="102" alt="Topo"></td>
      </tr>
	  <tr>
	    <td width="900" height="30" bgcolor="#1c5a80">
	    <?php
        if ($_SESSION["adm_acesso_id_usuario"] != "") {
			echo $acaoMenu -> montarMenuNiveis('H', $_SESSION["adm_acesso_id_usuario_nivel"]);
		}
        ?>
		</td>
	  </tr>
	  <tr>
	    <td width="900" height="400" bgcolor="#ffffff" valign="top">
	    	<div id="conteudo">
				<?php
				if ($_SESSION["adm_acesso_id_usuario"] != "") {
					echo '<p align="center">Olá, <b>' . $_SESSION["adm_acesso_nome"] . '</b>, seja bem vindo ao sistema da ALG Consultoria.</p>';
				}
				?>
				<?php
				if(($area == "") or ($area == "acesso/login_frm.php")) {
					include_once("acesso/login_frm.php");
				} else {
					include_once($area); 
				}		
				?>
		    </div>
		</td>
	  </tr>
	  <tr>
	    <td width="900" height="50" background="../design/layout/backEnd/bg_rodape.jpg" align="center">
			<p><b>Copyright © 2012. Todos os direitos reservados</b></p>
		</td>
	  </tr>
	</table>

</div>

</body>
</html>
