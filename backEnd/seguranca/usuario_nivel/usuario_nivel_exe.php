<?php
session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario_nivel.php");
include_once("../biblioteca/funcoesDiversas.php");

$id_usuario_nivel = tiraAspas($_REQUEST["id_usuario_nivel"]);

if (trim($_REQUEST["botaoAcao"]) == "Excluir") {
	
	$acaoUsuarioNivel = new usuario_nivel();
	
	$acaoUsuarioNivel -> excluirUsuarioNivelLigArea($id_usuario_nivel);
	
	$acaoUsuarioNivel -> excluirUsuarioNivel($id_usuario_nivel);

	$_SESSION["adm_usuario_nivel_aviso"] = "ok";
	
	voltarPagina("?area=".base64_encode("seguranca/usuario_nivel/usuario_nivel_ndx.php"));

} else {
	
	$erro = "";
	
	$acaoUsuarioNivel = new usuario_nivel();
	
	if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
		
		unset($_SESSION["adm_usuario_nivel_descricao"]);
		
		$_SESSION["adm_usuario_nivel_descricao"] = tiraAspas(trim($_REQUEST["descricao"]));
		
		$exeProcurarUsuarioNivelPorDescricao = $acaoUsuarioNivel -> procurarUsuarioNivelPorDescricao($_SESSION["adm_usuario_nivel_descricao"]);
		$infProcurarUsuarioNivelPorDescricao = mysql_fetch_array($exeProcurarUsuarioNivelPorDescricao);
		
		if ($infProcurarUsuarioNivelPorDescricao == true)
			$erro .= ".erro01.";
		
	} elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
		
		if ($_SESSION["adm_usuario_nivel_descricao"] != tiraAspas(trim($_REQUEST["descricao"]))) {
		
			unset($_SESSION["adm_usuario_nivel_descricao"]);
			
			$_SESSION["adm_usuario_nivel_descricao"] = tiraAspas(trim($_REQUEST["descricao"]));
			
		$exeProcurarUsuarioNivelPorDescricao = $acaoUsuarioNivel -> procurarUsuarioNivelPorDescricao($_SESSION["adm_usuario_nivel_descricao"]);
		$infProcurarUsuarioNivelPorDescricao = mysql_fetch_array($exeProcurarUsuarioNivelPorDescricao);
		
		if ($infProcurarUsuarioNivelPorDescricao == true)
				$erro .= ".erro01.";
				
		}
		
	}
	
	$_SESSION["adm_usuario_nivel_id_usuario_area"] = $_REQUEST["id_usuario_area"];

	
	
	# Testar campos vazios
	if (camposVazios($_SESSION["adm_usuario_nivel_descricao"]) == true)
		$erro .= ".erro02.";
	
	if (count($_SESSION["adm_usuario_nivel_id_usuario_area"]) < 1)
		$erro .= ".erro03.";
	
	if ($erro != "") {

		$_SESSION["adm_usuario_nivel_aviso"] = "erro";
		$_SESSION["adm_usuario_nivel_erro"]  = $erro;
		
		if ($id_usuario_nivel == "")
			voltarPagina("?area=".base64_encode("seguranca/usuario_nivel/usuario_nivel_frm.php"));
		else
			voltarPagina("?area=".base64_encode("seguranca/usuario_nivel/usuario_nivel_frm.php")."&id_usuario_nivel=$id_usuario_nivel");
		
		exit;
	} else {

		if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
			
			// Cadastrar
			$id_usuario_nivel = $acaoUsuarioNivel -> cadastrarUsuarioNivel($_SESSION["adm_usuario_nivel_descricao"]);
			
			foreach($_SESSION["adm_usuario_nivel_id_usuario_area"] as $indice => $id_area){
				$acaoUsuarioNivel -> cadastrarUsuarioNivelLigArea($id_usuario_nivel, $id_area);
			}
						
			$link_acao = "?area=".base64_encode("seguranca/usuario_nivel/usuario_nivel_frm.php");
		
		} elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {

			// Alterar os dados
			$acaoUsuarioNivel -> alterarUsuarioNivel($id_usuario_nivel, $_SESSION["adm_usuario_nivel_descricao"]);
			
			$acaoUsuarioNivel -> excluirUsuarioNivelLigArea($id_usuario_nivel);
			
			foreach($_SESSION["adm_usuario_nivel_id_usuario_area"] as $indice => $id_area){
				$acaoUsuarioNivel -> cadastrarUsuarioNivelLigArea($id_usuario_nivel, $id_area);
			}
						
			$link_acao = "?area=".base64_encode("seguranca/usuario_nivel/usuario_nivel_frm.php")."&id_usuario_nivel=$id_usuario_nivel";

		}
		
		unset($_SESSION["adm_usuario_nivel_descricao"]);
		
		$_SESSION["adm_usuario_nivel_aviso"] = "ok";
		
		voltarPagina($link_acao);
		
	}
}
?>