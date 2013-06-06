<?php
session_start();

include_once("../modulos/procedimento/biblioteca/procedimentoClass.php");
$acaoProcedimento = new Procedimento();

$id_procedimento = $_REQUEST["id_procedimento"];

if ($id_procedimento != "") {

    $exeProcurarProcedimento = $acaoProcedimento->procurarProcedimento($id_procedimento);
    $infProcurarProcedimento = mysql_fetch_array($exeProcurarProcedimento);

    $_SESSION["adm_procedimento_id_usuario"] = $infProcurarProcedimento["id_usuario"];
    $_SESSION["adm_procedimento_codigo"] = $infProcurarProcedimento["codigo"];
    $_SESSION["adm_procedimento_tuss_grupo"] = $infProcurarProcedimento["tuss_grupo"];
    $_SESSION["adm_procedimento_tuss_subgrupo"] = $infProcurarProcedimento["tuss_subgrupo"];
    $_SESSION["adm_procedimento_procedimento"] = $infProcurarProcedimento["procedimento"];
    $_SESSION["adm_procedimento_ativo"] = $infProcurarProcedimento["ativo"];
}
?>

<script type="text/javascript">
    document.ready(function() {
        $('#botaoAcao').click(function() {
            var codigo = $("#titulo").val();
            if (codigo == "") {
                alert("Digite um código!");
                $("#titulo").focus();
                return false;
            } else {
                $("#formProcedimento").submit();
            }
        });
    });
</script>

<div align="center">
    <p><i>Procedimento</p></i>

<h1>Procedimento</h1>
<?php if ($id_procedimento != "") { ?>
    <h2>Alterar</h2>
<?php } else { ?>
    <h2>Cadastrar</h2>
<?php } ?>

<form action="?area=<?php echo base64_encode("../modulos/procedimento/backEnd/procedimentoExe.php"); ?>" method="post"
      name="formProcedimento "id="formProcedimento" style="width: 500px; text-align:left;" enctype="multipart/form-data" >

    <p>(*) Itens obrigat&oacute;rios.</p>

    <?php
    if ($_SESSION["adm_procedimento_aviso"] == "erro") {

        echo '<p class="msgerro" align="center">ERRO(S):';

        # TABELA DE ERROS ----------------------------------------------- #
        if (strpos($_SESSION["adm_procedimento_erro"], ".erro01.") !== false)
            echo "<br />- Informe o Código!";
        if (strpos($_SESSION["adm_procedimento_erro"], ".erro02.") !== false)
            echo "<br />- Informe o Tuss Grupo!";
        if (strpos($_SESSION["adm_procedimento_erro"], ".erro03.") !== false)
            echo "<br />- Informe o Tuss Grupo!";
        if (strpos($_SESSION["adm_procedimento_erro"], ".erro04.") !== false)
            echo "<br />- Informe o Procedimento!";

        # TABELA DE ERROS ----------------------------------------------- #

        echo '</p>';
    } elseif (($_SESSION["adm_procedimento_aviso"] == "ok") and ($id_procedimento == "")) {

        echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

        unset($_SESSION["adm_procedimento_aviso"]);
        unset($_SESSION["adm_procedimento_erro"]);
    } elseif (($_SESSION["adm_procedimento_aviso"] == "ok") and ($id_procedimento != "")) {

        echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

        unset($_SESSION["adm_procedimento_aviso"]);
        unset($_SESSION["adm_procedimento_erro"]);
    }
    ?>


  <p>Especialidade: *<br />
                <select id="id_especialidade" name="id_especialidade">
                    <option value="XXXXX" selected>Selecione ...</option>
                    <?php
                    include_once("../modulos/especialidade/biblioteca/especialidadeClass.php");
                    $acaoEspecialidade = new Especialidade();
                    
                    $exeListarEspecialidade = $acaoEspecialidade ->listarEspecialidade();
                    
                    while ($infListarEspecialidade = mysql_fetch_array($exeListarEspecialidade)){
                    ?>
                        <option value="<?php echo $infListarEspecialidade["id_especialidade"];?>" <?php if ($_SESSION["adm_procedimento_id_tipo"] == $infListarEspecialidade["id_especialidade"]) echo "selected";?>><?php echo $infListarEspecialidade["nome"];?></option>
                    <?php } ?>
                </select>
            </p>


    <p>Código: *<br />
        <input name="codigo" type="text" id="codigo" value="<?php echo $_SESSION["adm_procedimento_codigo"]; ?>" size="65" maxlength="250" /></p>
    <p>Tuss Grupo: *<br />
        <input name="tuss_grupos" type="text" id="tuss_grupo" value="<?php echo $_SESSION["adm_procedimento_tuss_grupo"]; ?>" size="65" maxlength="250" /></p>
    <p>Tuss Subgrupo: *<br />
        <input name="tuss_subgrupos" type="text" id="tuss_subgrupo" value="<?php echo $_SESSION["adm_procedimento_tuss_subgrupo"]; ?>" size="65" maxlength="250" /></p>
    <p>Procedimento: *<br />
        <input name="procedimento" type="text" id="procedimento" value="<?php echo $_SESSION["adm_procedimento_procedimento"]; ?>" size="65" maxlength="250" /></p>


    <?php if ($id_procedimento != "") { ?>
        <p>Ativo: * <br /> 
            <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_procedimento_ativo"] == 1) echo "checked"; ?> /> Sim | 
            <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_procedimento_ativo"] == 0) echo "checked"; ?> /> N&atilde;o
        </p>
    <?php } ?>

    <input type="hidden" name="id_procedimento" id="id_procedimento" value="<?php echo $id_procedimento; ?>" />

    <?php if ($id_procedimento != "") { ?>
        <input name="botaoAcao" type="submit" id="botaoAcao" value="  Alterar  " />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="botaoAcaoExcluir" type="submit" id="botaoAcaoExcluir" value="  Excluir  " />
    <?php } else { ?>
        <input name="botaoAcao" type="submit" id="botaoAcao" value="  Cadastrar  " />
    <?php } ?>

</form>

</div>

<p align="center">
    <a href="?area=<?php echo base64_encode("../modulos/procedimento/backEnd/procedimentoNdx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
    document.getElementById('titulo').focus();
</script>