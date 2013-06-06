<?php
session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoUsuario = new usuario();

$senha_atual        = tiraAspas($_REQUEST["senha_atual"]);
$senha_nova         = tiraAspas($_REQUEST["senha_nova"]);
$senha_nova_repetir = tiraAspas($_REQUEST["senha_nova_repetir"]);



$erro = "";

# Testar campos vazios
if (camposVazios($senha_atual) == true)
	$erro .= ".erro01.";

if (camposVazios($senha_nova) == true)
	$erro .= ".erro02.";

if (camposVazios($senha_nova_repetir) == true)
	$erro .= ".erro03.";

if ($senha_nova != $senha_nova_repetir)
	$erro .= ".erro04.";

$exeProcurarUsuarioPorIdESenha = $acaoUsuario -> procurarUsuarioPorIdESenha($_SESSION["adm_acesso_id_usuario"], $senha_atual);
$infProcurarUsuarioPorIdESenha = mysql_fetch_array($exeProcurarUsuarioPorIdESenha);

if ($infProcurarUsuarioPorIdESenha == FALSE)
	$erro .= ".erro5.";

if ($erro != "") {

	$_SESSION["adm_alterar_senha_aviso"] = "erro";
	$_SESSION["adm_alterar_senha_erro"]  = $erro;
	
	voltarPagina("?area=".base64_encode("seguranca/alterar_senha/alterar_senha_frm.php"));
	
	exit;
} else {
		
	$acaoUsuario -> alterarUsuarioSenha($_SESSION["adm_acesso_id_usuario"], $senha_atual, $senha_nova);
	
	$link_acao = "?area=".base64_encode("seguranca/alterar_senha/alterar_senha_frm.php");
	
	$_SESSION["adm_alterar_senha_aviso"] = "ok";
	
	voltarPagina($link_acao);
	
}
?>