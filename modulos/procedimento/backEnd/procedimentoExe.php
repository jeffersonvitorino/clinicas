<?php

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../modulos/procedimento/biblioteca/procedimentoClass.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoProcedimento = new Procedimento();

$id_procedimento = tiraAspas($_REQUEST["id_procedimento"]);

if (trim($_REQUEST["botaoAcaoExcluir"]) == "Excluir") {

    include_once("../modulos/procedimento/biblioteca/procedimentoClass.php");

    $acaoEspecialidades = new Especialidades();

    $totalRegistros = $acaoEspecialidades->consultarProcedimento($id_procedimento);

    if ($totalRegistros == 0)
        $acaoProcedimento->excluirProcedimento($id_procedimento);
    else
        $acaoProcedimento->desativarProcedimentoAtiva($id_procedimento, $_SESSION["adm_acesso_id_usuario"]);

    voltarPagina("?area=" . base64_encode("../modulos/procedimento/backEnd/procedimentoNdx.php"));
} else {

    unset($_SESSION["adm_procedimento_codigo"]);
    unset($_SESSION["adm_procedimento_tuss_grupo"]);
    unset($_SESSION["adm_procedimento_tuss_subgrupo"]);
    unset($_SESSION["adm_procedimento_tuss_procedimento"]);
    unset($_SESSION["adm_procedimento_ativo"]);

    $_SESSION["adm_procedimento_codigo"] = tiraAspas($_REQUEST["codigo"]);
    $_SESSION["adm_procedimento_tuss_grupo"] = tiraAspas($_REQUEST["tuss_grupo"]);
    $_SESSION["adm_procedimento_subtuss_grupo"] = tiraAspas($_REQUEST["tuss_subsgrupo"]);
    $_SESSION["adm_procedimento_procedimento"] = tiraAspas($_REQUEST["tuss_procedimento"]);
    $_SESSION["adm_procedimento_ativo"] = tiraAspas($_REQUEST["ativo"]);

    // Validar campos obrigatórios

    $erro = "";

    # Testar campos vazios
    if (camposVazios($_SESSION["adm_procedimento_codigo"]) == true)
        $erro .= ".erro01.";

    if (camposVazios($_SESSION["adm_procedimento_tuss_grupo"]) == true)
        $erro .= ".erro02.";

    if (camposVazios($_SESSION["adm_procedimento_tuss_subgrupo"]) == true)
        $erro .= ".erro03.";

    if (camposVazios($_SESSION["adm_procedimento_procedimento"]) == true)
        $erro .= ".erro04.";
    if ($erro != "") {

        $_SESSION["adm_procedimento_aviso"] = "erro";
        $_SESSION["adm_procedimento_erro"] = $erro;

        if ($id_procedimento == "")
            voltarPagina("?area=" . base64_encode("../modulos/procedimento/backEnd/procedimentoFrm.php"));
        else
            voltarPagina("?area=" . base64_encode("../modulos/procedimento/backEnd/procedimentoFrm.php"));

        exit;
    } else {

        if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {

            $id_procedimento = $acaoProcedimento->cadastrarProcedimento($_SESSION["adm_procedimento_codigo"], $_SESSION["adm_conselhoProfisisonal_tuss_grupo"], $_SESSION["adm_procedimento_tuss_subgrupo"], $_SESSION["adm_procedimento_procedimento"]);

            $link_acao = "?area=" . base64_encode("../modulos/procedimento/backEnd/procedimentoFrm.php");
        } elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {

            $acaoProcedimento->alterarProcedimento($id_procedimento, $_SESSION["adm_procedimento_codigo"], $_SESSION["adm_conselhoProfisisonal_tuss_grupo"], $_SESSION["adm_procedimento_tuss_subgrupo"], $_SESSION["adm_procedimento_procedimento"]);
            $link_acao = "?area=" . base64_encode("../modulos/procedimento/backEnd/procedimentoFrm.php") . "&id_procedimento=$id_procedimento";
        }
        unset($_SESSION["adm_procedimento_codigo"]);
        unset($_SESSION["adm_procedimento_tuss_grupo"]);
        unset($_SESSION["adm_procedimento_tuss_subgrupo"]);
        unset($_SESSION["adm_procedimento_procedimento"]);

        $_SESSION["adm_procedimento_aviso"] = "ok";

        voltarPagina($link_acao);
    }
}
?>