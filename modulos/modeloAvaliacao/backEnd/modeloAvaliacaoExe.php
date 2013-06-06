<?php

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../modulos/modeloAvaliacao/biblioteca/modeloAvaliacaoClass.php");
include_once("../biblioteca/funcoesDiversas.php");

$acaoModeloAvaliacao = new ModeloAvaliacao();

$id_modeloAvaliacao = tiraAspas($_REQUEST["id_modeloAvaliacao"]);

if (trim($_REQUEST["botaoAcaoExcluir"]) == "Excluir") {

    include_once("../modulos/modeloAvaliacao/biblioteca/modeloAvaliacaoClass.php");
    
    $acaoModeloAvaliacao = new ModeloAvaliacao();
    
    $totalRegistros = $acaoModeloAvaliacao ->consultarModeloAvaliacao($id_modeloAvaliacao);
    
    if ($totalRegistros == 0)
        $acaoModeloAvaliacao->excluirModeloAvaliacao($id_modeloAvaliacao);
    else
        $acaoModeloAvaliacao->desativarModeloAvaliacaoAtiva($id_modeloAvaliacao, $_SESSION["adm_acesso_id_usuario"]);

    voltarPagina("?area=" . base64_encode("../modulos/modeloAvaliacao/backEnd/modeloAvaliacaoNdx.php"));
} else {

    unset($_SESSION["adm_modeloAvaliacao_descricao"]);
    unset($_SESSION["adm_modeloAvaliacao_ativo"]);

    $_SESSION["adm_modeloAvaliacao_descricao"] = tiraAspas($_REQUEST["descricao"]);
    $_SESSION["adm_modeloAvaliacao_ativo"] = tiraAspas($_REQUEST["ativo"]);

    // Validar campos obrigatórios

    $erro = "";

    # Testar campos vazios
      if (camposVazios($_SESSION["adm_modeloAvaliacao_descricao"]) == true)
        $erro .= ".erro01.";
    if ($erro != "") {

        $_SESSION["adm_modeloAvaliacao_aviso"] = "erro";
        $_SESSION["adm_modeloAvaliacao_erro"] = $erro;

        if ($id_modeloAvaliacao== "")
            voltarPagina("?area=" . base64_encode("../modulos/modeloAvaliacao/backEnd/modeloAvaliacaoFrm.php"));
        else
            voltarPagina("?area=" . base64_encode("../modulos/modeloAvaliacao/backEnd/modeloAvaliacaoFrm.php"));

        exit;
    } else {

        if (trim($_REQUEST["botaoAcao"]) == "Cadastrar") {

            $id_modeloAvaliacao = $acaoModeloAvaliacao->cadastrarModeloAvaliacao( $_SESSION["adm_modeloAvaliacao_descricao"], $_SESSION["adm_acesso_id_usuario"]);

            $link_acao = "?area=" . base64_encode("../modulos/modeloAvaliacao/backEnd/modeloAvaliacaoFrm.php");
        } elseif (trim($_REQUEST["botaoAcao"]) == "Alterar") {
            
            $acaoModeloAvaliacao->alterarModeloAvaliacao($id_modeloAvaliacao, $_SESSION["adm_modeloAvaliacao_descricao"], $_SESSION["adm_modeloAvaliacao_ativo"], $_SESSION["adm_acesso_id_usuario"]);
            $link_acao = "?area=" . base64_encode("../modulos/modeloAvaliacao/backEnd/modeloAvaliacaoFrm.php") . "&id_modeloAvaliacao=$id_modeloAvaliacao";
        }
        unset($_SESSION["adm_modeloAvaliacao_descricao"]);
        unset($_SESSION["adm_modeloAvaliacao_ativo"]);
        
        $_SESSION["adm_modeloAvaliacao_aviso"] = "ok";

        voltarPagina($link_acao);
    }
}
?>