<?php

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../modulos/especialidade/biblioteca/especialidadeClass.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoEspecialidade = new Especialidade();

$id_especialidade = tiraAspas($_REQUEST["id_especialidade"]);

if (trim($_REQUEST["botaoAcaoExcluir"]) == "Excluir") {

    include_once("../modulos/especialidade/biblioteca/especialidadeClass.php");
    
    $acaoEspecialidade = new Especialidade();
    
    $totalRegistros = $acaoEspecialidade ->consultarEspecialidade($id_especialidade);
    
    if ($totalRegistros == 0)
        $acaoEspecialidade->excluirEspecialidade($id_especialidade);
    else
        $acaoEspecialidade->desativarEspecialidadeAtiva($id_especialidade, $_SESSION["adm_acesso_id_usuario"]);

    voltarPagina("?area=" . base64_encode("../modulos/especialidade/backEnd/especialidadeNdx.php"));
} else {

    unset($_SESSION["adm_especialidade_nome"]);
    unset($_SESSION["adm_especialidade_ativo"]);

    $_SESSION["adm_especialidade_nome"] = tiraAspas($_REQUEST["nome"]);
    $_SESSION["adm_especialidade_ativo"] = tiraAspas($_REQUEST["ativo"]);

    // Validar campos obrigatórios

    $erro = "";

    # Testar campos vazios
    if (camposVazios($_SESSION["adm_especialidade_nome"]) == true)
        $erro .= ".erro01.";
if ($erro != "") {

        $_SESSION["adm_especialidade_aviso"] = "erro";
        $_SESSION["adm_especialidade_erro"] = $erro;

        if ($id_especialidade== "")
            voltarPagina("?area=" . base64_encode("../modulos/especialidade/backEnd/especialidadeFrm.php"));
        else
            voltarPagina("?area=" . base64_encode("../modulos/especialidade/backEnd/especialidadeFrm.php"));

        exit;
    } else {

        if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {

            $id_especialidade = $acaoEspecialidade->cadastrarEspecialidade($_SESSION["adm_especialidade_codigo"], $_SESSION["adm_acesso_id_usuario"]);

            $link_acao = "?area=" . base64_encode("../modulos/especialidade/backEnd/especialidadeFrm.php");
        } elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
            
            $acaoEspecialidade->alterarEspecialidade($id_especialidade, $_SESSION["adm_especialidade_nome"],$_SESSION["adm_especialidade_ativo"], $_SESSION["adm_acesso_id_usuario"]);
            $link_acao = "?area=" . base64_encode("../modulos/especialidade/backEnd/especialidadeFrm.php") . "&id_especialidade=$id_especialidade";
        }
        unset($_SESSION["adm_especialidade_nome"]);
        unset($_SESSION["adm_especialidade_ativo"]);
        
        $_SESSION["adm_especialidade_aviso"] = "ok";

        voltarPagina($link_acao);
    }
}
?>s