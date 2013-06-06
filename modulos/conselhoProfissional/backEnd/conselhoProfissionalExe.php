<?php

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../modulos/conselhoProfissional/biblioteca/conselhoProfissionalClass.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoConselhoProfissional = new ConselhoProfissional();

$id_conselho_profissional = tiraAspas($_REQUEST["id_conselho_profissional"]);

if (trim($_REQUEST["botaoAcaoExcluir"]) == "Excluir") {

    include_once("../modulos/conselhoProfissional/biblioteca/conselhoProfissionalClass.php");
    
    $acaoEspecialidade = new Especialidade();
    
    $totalRegistros = $acaoEspecialidade ->consultarConselhoProfissional($id_conselho_profissional);
    
    if ($totalRegistros == 0)
        $acaoConselhoProfissional->excluirConselhoProfissional($id_conselho_profissional);
    else
        $acaoConselhoProfissional->desativarConselhoProfissionalAtiva($id_conselho_profissional, $_SESSION["adm_acesso_id_usuario"]);

    voltarPagina("?area=" . base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissionalNdx.php"));
} else {

    unset($_SESSION["adm_conselhoProfissional_id_conselho_profissional_tipo"]);
    unset($_SESSION["adm_conselhoProfissional_numero"]);
    unset($_SESSION["adm_conselhoProfissional_uf"]);
    unset($_SESSION["adm_conselhoProfissional_ativo"]);

    $_SESSION["adm_conselhoProfissional_id_conselho_profissional_tipo"] = tiraAspas($_REQUEST["id_conselho_profissional_tipo"]);
    $_SESSION["adm_conselhoProfissional_numero"] = tiraAspas($_REQUEST["numero"]);
    $_SESSION["adm_conselhoProfissional_uf"] = tiraAspas($_REQUEST["uf"]);
    $_SESSION["adm_conselhoProfissional_ativo"] = tiraAspas($_REQUEST["ativo"]);

    // Validar campos obrigatórios

    $erro = "";

    # Testar campos vazios
    if (camposVazios($_SESSION["adm_conselhoProfissional_numero"]) == true)
        $erro .= ".erro01.";

    if (camposVazios($_SESSION["adm_conselhoProfissional_uf"]) == true)
        $erro .= ".erro02.";
    if ($erro != "") {

        $_SESSION["adm_conselhoProfisisonal_aviso"] = "erro";
        $_SESSION["adm_conselhoProfissional_erro"] = $erro;

        if ($id_conselho_profissional == "")
            voltarPagina("?area=" . base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissionalFrm.php"));
        else
            voltarPagina("?area=" . base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissionalFrm.php"));

        exit;
    } else {

        if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {

            $id_conselho_profissional = $acaoConselhoProfissional->cadastrarConselhoProfissional($_SESSION["adm_conselhoProfissional_id_conselho_profissional_tipo"],$_SESSION["adm_conselhoProfissional_numero"], $_SESSION["adm_conselhoProfissional_uf"], $_SESSION["adm_acesso_id_usuario"]);

            $link_acao = "?area=" . base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissionalFrm.php");
        
         } elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
            
            $acaoConselhoProfissional->alterarConselhoProfissional($_SESSION["adm_conselhoProfisional_id_conselho_profissional_tipo"], $_SESSION["adm_conselhoProfisional_numero"], $_SESSION["adm_conselhoProfisisonal_uf"]);
            $link_acao = "?area=" . base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfisionalFrm.php") . "&id_conselhoProfissional=$id_conselho_profissional";
        }
        unset($_SESSION["adm_conselhoProfissional_id_tipo"]);
        unset($_SESSION["adm_conselhoProfissional_numero"]);
        unset($_SESSION["adm_conselhoProfissional_uf"]);
        
        $_SESSION["adm_conselhoProfissional_aviso"] = "ok";  

        voltarPagina($link_acao);
    }
}
?>