<?php
session_start();

include_once("../modulos/especialidade/biblioteca/especialidadeClass.php");
$acaoEspecialidade = new Especialidade();

$id_especialidade= $_REQUEST["id_cid"];

if($id_especialidade!= ""){
    
    $exeProcurarEspecialidade = $acaoEspecialidade->procurarEspecialidade($id_especialidade);
    $infProcurarEspecialidade = mysql_fetch_array($exeProcurarEspecialidade);
    
    $_SESSION["adm_especialidade_id_usuario"] = $infProcurarEspecialidade["id_usuario"];
    $_SESSION["adm_especialidade_nome"] = $infProcurarEspecialidade["nome"];
    $_SESSION["adm_especialidade_ativo"] = $infProcurarEspecialidade["ativo"];
}
?>

<script type="text/javascript">

    $(document).ready(function($) {



        $('#nome').focus();


        $("#ok").click(function() {

            var codigo = $.trim($("#nome").val());


            if (codigo.length <= 0) {
                alert('é necessário um nome');
                $("#nome").focus();
                return false;
            }

            else {
                $("#cadastro").submit();
            }


        });


    });
</script>

<div align="center">
    <p><i>Especialidade</p></i>
    
    <h1>Especialidade</h1>
        <?php if($id_especialidade!= "") { ?>
            <h2>Alterar</h2>
	<?php } else { ?>
            <h2>Cadastrar</h2>
	<?php } ?>

    <form action="?area=<?php echo base64_encode("../modulos/especialidade/backEnd/especialidadeExe.php");?>" method="post"
        name="formEspecialidade" id="formEspecialidade" style="width: 500px; text-align:left;" enctype="multipart/form-data" >

        <p>(*) Itens obrigat&oacute;rios.</p>

            <?php
            if($_SESSION["adm_especialidade_aviso"] == "erro"){

                    echo '<p class="msgerro" align="center">ERRO(S):';

                    # TABELA DE ERROS ----------------------------------------------- #
                            if (strpos($_SESSION["adm_especialidade_erro"], ".erro01.") !== false)
                    echo "<br />- Informe o Nome!";
                            else  if (strpos($_SESSION["adm_especialidade_erro"], ".erro02.") !== false)
                    echo "<br />- Informe o Conselho!";
                            # TABELA DE ERROS ----------------------------------------------- #

                            echo '</p>';
            } elseif (($_SESSION["adm_especialidade_aviso"] == "ok") and ($id_especialidade == "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

                            unset($_SESSION["adm_especialidade_aviso"]);
                            unset($_SESSION["adm_especialidade_erro"]);

            } elseif (($_SESSION["adm_especialidade_aviso"] == "ok") and ($id_especialidade != "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

                            unset($_SESSION["adm_especialidade_aviso"]);
                            unset($_SESSION["adm_especialidade_erro"]);
            }
            ?>
        
            
           

            <p>Nome: *<br />
            <input name="nome" type="text" id="nome" value="<?php echo $_SESSION["adm_especialidade_nome"];?>" size="65" maxlength="250" /></p>

            <?php if ($id_especialidade!= "") { ?>
                <p>Ativo: * <br /> 
                <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_especialidade_ativo"] == 1) echo "checked";?> /> Sim | 
                <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_especialidade_ativo"] == 0) echo "checked";?> /> N&atilde;o
                </p>
            <?php } ?>

            <input type="hidden" name="id_especialidade" id="id_especialidade" value="<?php echo $id_especialidade;?>" />

            <?php if ($id_especialidade!= "") { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Alterar  " />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="botaoAcaoExcluir" type="submit" id="botaoAcaoExcluir" value="  Excluir  " />
            <?php } else { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Cadastrar  " />
            <?php } ?>

    </form>
            
</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("../modulos/especialidade/backEnd/especialidadeNdx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('titulo').focus();
</script>