<?php
error_reporting(E_ALL ^ E_NOTICE);

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario.php");
include_once("../biblioteca/funcoesDiversas.php");

$email = tiraAspas($_REQUEST["email"]);
$senha = tiraAspas($_REQUEST["senha"]);



$erro = "";

if (camposVazios($email) == true)
	$erro .= ".erro01.";

if (camposVazios($senha) == true)
	$erro .= ".erro02.";

$acaoUsuario = new usuario();

$exeProcurarUsuarioPorEmailESenha = $acaoUsuario -> procurarUsuarioPorEmailESenha($email, $senha);





$infProcurarUsuarioPorEmailESenha = mysql_fetch_array($exeProcurarUsuarioPorEmailESenha);
if ($infProcurarUsuarioPorEmailESenha == FALSE)
	$erro .= ".erro3.";

if ($erro != "") {

	$_SESSION["adm_acesso_aviso"] = "erro";
	$_SESSION["adm_acesso_erro"]  = $erro;
		
	voltarPagina("?area=".base64_encode("acesso/login_frm.php"));
	
} else {

	unset($_SESSION["adm_acesso_aviso"]);
	unset($_SESSION["adm_acesso_erro"]);

	$_SESSION["adm_acesso_id_usuario"]       = $infProcurarUsuarioPorEmailESenha["id_usuario"];
	$_SESSION["adm_acesso_nome"]             = $infProcurarUsuarioPorEmailESenha["nome"];
	$_SESSION["adm_acesso_id_usuario_nivel"] = $infProcurarUsuarioPorEmailESenha["id_usuario_nivel"];

	voltarPagina("?area=".base64_encode("home.php"));

}
?>