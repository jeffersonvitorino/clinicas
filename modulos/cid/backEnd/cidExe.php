<?php

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../modulos/cid/biblioteca/cidClass.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoCid = new Cid();

$id_cid = tiraAspas($_REQUEST["id_cid"]);

if (trim($_REQUEST["botaoAcaoExcluir"]) == "Excluir") {

    include_once("../modulos/cid/biblioteca/cidClass.php");
    
    $acaoCid = new Cid();
    
    $totalRegistros = $acaoCid ->consultarCid($id_cid);
    
    if ($totalRegistros == 0)
        $acaoCid->excluirCid($id_cid);
    else
        $acaoCid->desativarCidAtiva($id_cid, $_SESSION["adm_acesso_id_usuario"]);

    voltarPagina("?area=" . base64_encode("../modulos/cid/backEnd/cidNdx.php"));
} else {

    unset($_SESSION["adm_cid_codigo"]);
    unset($_SESSION["adm_cid_descricao"]);
    unset($_SESSION["adm_cid_ativo"]);

    $_SESSION["adm_cid_codigo"] = tiraAspas($_REQUEST["codigo"]);
    $_SESSION["adm_cid_descricao"] = tiraAspas($_REQUEST["descricao"]);
    $_SESSION["adm_cid_ativo"] = tiraAspas($_REQUEST["ativo"]);

    // Validar campos obrigatórios

    $erro = "";

    # Testar campos vazios
    if (camposVazios($_SESSION["adm_cid_codigo"]) == true)
        $erro .= ".erro01.";

    if (camposVazios($_SESSION["adm_cid_descricao"]) == true)
        $erro .= ".erro02.";
    if ($erro != "") {

        $_SESSION["adm_cid_aviso"] = "erro";
        $_SESSION["adm_cid_erro"] = $erro;

        if ($id_cid== "")
            voltarPagina("?area=" . base64_encode("../modulos/cid/backEnd/cidFrm.php"));
        else
            voltarPagina("?area=" . base64_encode("../modulos/cid/backEnd/cidFrm.php"));

        exit;
    } else {

        if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {

            $id_cid = $acaoCid->cadastrarCid($_SESSION["adm_cid_codigo"], $_SESSION["adm_cid_descricao"], $_SESSION["adm_acesso_id_usuario"]);

            $link_acao = "?area=" . base64_encode("../modulos/cid/backEnd/cidFrm.php");
        } elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
            
            $acaoCid->alterarCid($id_cid, $_SESSION["adm_cid_codigo"], $_SESSION["adm_cid_descricao"], $_SESSION["adm_cid_ativo"], $_SESSION["adm_acesso_id_usuario"]);
            $link_acao = "?area=" . base64_encode("../modulos/cid/backEnd/cidFrm.php") . "&id_cid=$id_cid";
        }
        unset($_SESSION["adm_cid_codigo"]);
        unset($_SESSION["adm_cid_descricao"]);
        unset($_SESSION["adm_cid_ativo"]);
        
        $_SESSION["adm_cid_aviso"] = "ok";

        voltarPagina($link_acao);
    }
}
?>