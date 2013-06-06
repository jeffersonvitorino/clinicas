<?php
session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario_area.php");
include_once("../biblioteca/funcoesDiversas.php");

$id_usuario_area = tiraAspas($_REQUEST["id_usuario_area"]);

if (trim($_REQUEST["botaoAcao"]) == "Excluir") {
	
	$acaoUsuarioArea = new usuario_area();
	
	$acaoUsuarioArea -> excluirUsuarioArea($id_usuario_area);

	$_SESSION["adm_usuario_area_aviso"] = "ok";
	
	voltarPagina("?area=".base64_encode("seguranca/usuario_area/usuario_area_ndx.php"));

} else {

	unset($_SESSION["adm_usuario_area_caminho"]);
	unset($_SESSION["adm_usuario_area_area_id"]);
	unset($_SESSION["adm_usuario_area_ordem"]);
	unset($_SESSION["adm_usuario_area_ativo"]);
	
	$_SESSION["adm_usuario_area_caminho"] = tiraAspas(trim($_REQUEST["caminho"]));
	$_SESSION["adm_usuario_area_area_id"] = tiraAspas(trim($_REQUEST["area_id"]));
	$_SESSION["adm_usuario_area_ordem"]   = tiraAspas(trim($_REQUEST["ordem"]));
	$_SESSION["adm_usuario_area_ativo"]   = tiraAspas(trim($_REQUEST["ativo"]));

	$erro = "";
	
	$acaoUsuarioArea = new usuario_area();
	
	if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
		
		unset($_SESSION["adm_usuario_area_descricao"]);
		
		$_SESSION["adm_usuario_area_descricao"] = tiraAspas(trim($_REQUEST["descricao"]));
		
		$exeProcurarUsuarioAreaPorDescricaoEAreaId = $acaoUsuarioArea -> procurarUsuarioAreaPorDescricaoEAreaId($_SESSION["adm_usuario_area_descricao"], $_SESSION["adm_usuario_area_area_id"]);
		$infProcurarUsuarioAreaPorDescricaoEAreaId = mysql_fetch_array($exeProcurarUsuarioAreaPorDescricaoEAreaId);
		
		if ($infProcurarUsuarioAreaPorDescricaoEAreaId == true)
			$erro .= ".erro01.";
		
	} elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
		
		if ($_SESSION["adm_usuario_area_descricao"] != tiraAspas(trim($_REQUEST["descricao"]))) {
		
			unset($_SESSION["adm_usuario_area_descricao"]);
			
			$_SESSION["adm_usuario_area_descricao"] = tiraAspas(trim($_REQUEST["descricao"]));
			
			$exeProcurarUsuarioAreaPorDescricaoEAreaId = $acaoUsuarioArea -> procurarUsuarioAreaPorDescricaoEAreaId($_SESSION["adm_usuario_area_descricao"], $_SESSION["adm_usuario_area_area_id"]);
		$infProcurarUsuarioAreaPorDescricaoEAreaId = mysql_fetch_array($exeProcurarUsuarioAreaPorDescricaoEAreaId);
		
		if ($infProcurarUsuarioAreaPorDescricaoEAreaId == true)
			$erro .= ".erro01.";
				
		}
		
	}

	// Validar campos obrigatórios

	
	# Testar campos vazios
	if (camposVazios($_SESSION["adm_usuario_area_descricao"]) == true)
		$erro .= ".erro02.";
	
	if (camposVazios($_SESSION["adm_usuario_area_ordem"]) == true)
		$erro .= ".erro03.";
	
	if ($erro != "") {

		$_SESSION["adm_usuario_area_aviso"] = "erro";
		$_SESSION["adm_usuario_area_erro"]  = $erro;
		
		if ($id_usuario_area == "")
			voltarPagina("?area=".base64_encode("seguranca/usuario_area/usuario_area_frm.php"));
		else
			voltarPagina("?area=".base64_encode("seguranca/usuario_area/usuario_area_frm.php")."&id_usuario_area=$id_usuario_area");
		
		exit;
	} else {

		if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {
			
			// Cadastrar
			$id_usuario_area = $acaoUsuarioArea -> cadastrarUsuarioArea($_SESSION["adm_usuario_area_descricao"], $_SESSION["adm_usuario_area_caminho"], $_SESSION["adm_usuario_area_area_id"], $_SESSION["adm_usuario_area_ordem"]);
						
			$link_acao = "?area=".base64_encode("seguranca/usuario_area/usuario_area_frm.php");
		
		} elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {

			// Alterar os dados
			$acaoUsuarioArea -> alterarUsuarioArea($id_usuario_area, $_SESSION["adm_usuario_area_descricao"], $_SESSION["adm_usuario_area_caminho"], $_SESSION["adm_usuario_area_area_id"], $_SESSION["adm_usuario_area_ordem"], $_SESSION["adm_usuario_area_ativo"]);
						
			$link_acao = "?area=".base64_encode("seguranca/usuario_area/usuario_area_frm.php")."&id_usuario_area=$id_usuario_area";

		}
		
		unset($_SESSION["adm_usuario_area_descricao"]);
		unset($_SESSION["adm_usuario_area_caminho"]);
		unset($_SESSION["adm_usuario_area_area_id"]);
		unset($_SESSION["adm_usuario_area_ordem"]);
		unset($_SESSION["adm_usuario_area_ativo"]);
		
		$_SESSION["adm_usuario_area_aviso"] = "ok";
		
		voltarPagina($link_acao);
		
	}
}
?>