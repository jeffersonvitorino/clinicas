<?php
session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoUsuario = new usuario();

$id_usuario = tiraAspas($_REQUEST["id_usuario"]);

if (trim($_REQUEST["botaoAcao"]) == "Excluir") { 
	
	$acaoUsuario -> desativarUsuario($id_usuario);

	$_SESSION["adm_usuario_aviso"] = "ok";
	
	voltarPagina("?area=".base64_encode("seguranca/usuario/usuario_ndx.php"));

} else {

	unset($_SESSION["adm_usuario_id_usuario_nivel"]);
	unset($_SESSION["adm_usuario_nome"]);
	unset($_SESSION["adm_usuario_senha"]);
	unset($_SESSION["adm_usuario_ativo"]);

	$_SESSION["adm_usuario_id_usuario_nivel"] = tiraAspas($_REQUEST["id_usuario_nivel"]);
	$_SESSION["adm_usuario_nome"]             = tiraAspas($_REQUEST["nome"]);
	$_SESSION["adm_usuario_senha"]            = tiraAspas($_REQUEST["senha"]);
	$_SESSION["adm_usuario_ativo"]            = tiraAspas($_REQUEST["ativo"]);

	
	$erro = "";
	
	if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
		
		unset($_SESSION["adm_usuario_email"]);
		
		$_SESSION["adm_usuario_email"] = tiraAspas(trim($_REQUEST["email"]));
		
		$exeProcurarUsuarioPorEmail = $acaoUsuario -> procurarUsuarioPorEmail($_SESSION["adm_usuario_email"]);
		$infProcurarUsuarioPorEmail = mysql_fetch_array($exeProcurarUsuarioPorEmail);
		
		if ($infProcurarUsuarioPorEmail == true)
			$erro .= ".erro03.";
			
	} elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
		
		if ($_SESSION["adm_usuario_email"] != tiraAspas(trim($_REQUEST["email"]))) {
		
			unset($_SESSION["adm_usuario_email"]);
			
			$_SESSION["adm_usuario_email"] = tiraAspas(trim($_REQUEST["email"]));
			
			$exeProcurarUsuarioPorEmail = $acaoUsuario -> procurarUsuarioPorEmail($_SESSION["adm_usuario_email"]);
			$infProcurarUsuarioPorEmail = mysql_fetch_array($exeProcurarUsuarioPorEmail);
			
			if ($infProcurarUsuarioPorEmail == true)
				$erro .= ".erro03.";
				
		}
		
	}
	
	# Testar campos vazios
	if (camposVazios($_SESSION["adm_usuario_nome"]) == true)
		$erro .= ".erro01.";
	
	if (camposVazios($_SESSION["adm_usuario_email"]) == true)
		$erro .= ".erro02.";
	
	if (verificaEmail($_SESSION["adm_usuario_email"]) == false)
		$erro .= ".erro02.";
	
	if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
		if (camposVazios($_SESSION["adm_usuario_senha"]) == true)
			$erro .= ".erro04.";
	}
	
	if (camposSelecionados($_SESSION["adm_usuario_id_usuario_nivel"]) == true)
		$erro .= ".erro05.";
	
	if ($erro != "") {

		$_SESSION["adm_usuario_aviso"] = "erro";
		$_SESSION["adm_usuario_erro"]  = $erro;
		
		if ($id_usuario == "")
			voltarPagina("?area=".base64_encode("seguranca/usuario/usuario_frm.php"));
		else
			voltarPagina("?area=".base64_encode("seguranca/usuario/usuario_frm.php")."&id_usuario=$id_usuario");
		
		exit;
	} else {
		
		if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
			
			// Cadastrar
			$id_usuario = $acaoUsuario -> cadastrarUsuario($_SESSION["adm_usuario_id_usuario_nivel"], $_SESSION["adm_usuario_nome"], $_SESSION["adm_usuario_email"], $_SESSION["adm_usuario_senha"]);
						
			$link_acao = "?area=".base64_encode("seguranca/usuario/usuario_frm.php");
		
		} elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {

			// Alterar os dados
			if ($_SESSION["adm_usuario_senha"] != "") {
				$acaoUsuario -> alterarUsuario($id_usuario, $_SESSION["adm_usuario_id_usuario_nivel"], $_SESSION["adm_usuario_nome"], $_SESSION["adm_usuario_email"], $_SESSION["adm_usuario_senha"], $_SESSION["adm_usuario_ativo"]);
			} else {
				$acaoUsuario -> alterarUsuarioSemSenha($id_usuario, $_SESSION["adm_usuario_id_usuario_nivel"], $_SESSION["adm_usuario_nome"], $_SESSION["adm_usuario_email"], $_SESSION["adm_usuario_ativo"]);
			}
			
			$link_acao = "?area=".base64_encode("seguranca/usuario/usuario_frm.php")."&id_usuario=$id_usuario";

		}
		
		unset($_SESSION["adm_usuario_id_usuario_nivel"]);
		unset($_SESSION["adm_usuario_nome"]);
		unset($_SESSION["adm_usuario_email"]);
		unset($_SESSION["adm_usuario_senha"]);
		unset($_SESSION["adm_usuario_ativo"]);
		
		$_SESSION["adm_usuario_aviso"] = "ok";
		
		voltarPagina($link_acao);
		
	}
}
?>