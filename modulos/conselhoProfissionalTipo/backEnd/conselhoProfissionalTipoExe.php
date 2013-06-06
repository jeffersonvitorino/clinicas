<?php

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../modulos/conselhoProfissionalTipo/biblioteca/conselhoProfissionalTipoClass.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoConselhoProfissionalTipo = new ConselhoProfissionalTipo();

$id_conselho_profissional_tipo = tiraAspas($_REQUEST["id_conselho_profissional_tipo"]);

if (trim($_REQUEST["botaoAcaoExcluir"]) == "Excluir") {

    include_once("../modulos/conselhoProfissionalTipo/biblioteca/conselhoProfissionalTipoClass.php");
    
    $acaoConselhoProfissionalTipo = new ConselhoProfissionalTipo();
    
    $totalRegistros = $acaoConselhoProfissionalTipo ->consultarConselhoProfissionalTipo($id_conselho_profissional_tipo);
    
    if ($totalRegistros == 0)
        $acaoConselhoProfissionalTipo->excluirCid($id_conselho_profissional_tipo);
    else
        $acaoConselhoProfissionalTipo->desativarConselhoProfissionalTipoAtiva($id_conselho_profissional_tipo, $_SESSION["adm_acesso_id_usuario"]);

    voltarPagina("?area=" . base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoNdx.php"));
} else {

    unset($_SESSION["adm_conselhoProfissionalTipo_sigla"]);
    unset($_SESSION["adm_conselhoProfissionalTipo_descricao"]);
    unset($_SESSION["adm_conselhoProfissionalTipo_ativo"]);

    $_SESSION["adm_conselhoProfissionalTipo_sigla"] = tiraAspas($_REQUEST["sigla"]);
    $_SESSION["adm_conselhoProfissionalTipo_descricao"] = tiraAspas($_REQUEST["descricao"]);
    $_SESSION["adm_conselhoProfissionalTipo_ativo"] = tiraAspas($_REQUEST["ativo"]);

    // Validar campos obrigatórios

    $erro = "";

    # Testar campos vazios
    if (camposVazios($_SESSION["adm_conselhoProfissionalTipo_sigla"]) == true)
        $erro .= ".erro01.";

    if (camposVazios($_SESSION["adm_conselhoProfissionalTipo_descricao"]) == true)
        $erro .= ".erro02.";
    if ($erro != "") {

        $_SESSION["adm_conselhoProfissionalTipo_aviso"] = "erro";
        $_SESSION["adm_conselhoProfissionalTipo_erro"] = $erro;

        if ($id_conselho_profissional_tipo== "")
            voltarPagina("?area=" . base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoFrm.php"));
        else
            voltarPagina("?area=" . base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoFrm.php"));

        exit;
    } else {

        if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {

            $id_conselho_profissional_tipo = $acaoConselhoProfissionalTipo->cadastrarConselhoProfissionalTipo($_SESSION["adm_conselhoProfissionalTipo_sigla"], $_SESSION["adm_conselhoProfissionalTipo_descricao"], $_SESSION["adm_acesso_id_usuario"]);

            $link_acao = "?area=" . base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoFrm.php");
        } elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
            
                     $acaoConselhoProfissionalTipo->alterarConselhoProfissionalTipo($id_conselho_profissional_tipo, $_SESSION["adm_conselhoProfissionalTipo_sigla"], $_SESSION["adm_conselhoProfissional_descricao"], $_SESSION["adm_cid_ativo"], $_SESSION["adm_acesso_id_usuario"]);
            $link_acao = "?area=" . base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoFrm.php") . "&id_conselho_profissional_tipo=$id_conselho_profissional_tipo";
        }
        unset($_SESSION["adm_conselhoProfissionalTipo_sigla"]);
        unset($_SESSION["adm_conselhoProfissionalTipo_descricao"]);
        unset($_SESSION["adm_conselhoProfissionalTipo_ativo"]);
        
        $_SESSION["adm_conselhoProfissionalTipo_aviso"] = "ok";

        voltarPagina($link_acao);
    }
}
?>