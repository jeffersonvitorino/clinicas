<?php
session_start();

include_once("../modulos/modeloAvaliacao/biblioteca/modeloAvaliacaoClass.php");
$acaoModeloAvaliacao = new ModeloAvaliacao();

$id_modeloAvaliacao= $_REQUEST["id_modeloAvaliacao"];

if($id_modeloAvaliacao!= ""){
    
    $exeProcurarModeloAvaliacao = $acaoModeloAvaliacao->procurarModeloAvaliacao($id_modeloAvaliacao);
    $infProcurarModeloAvaliacao = mysql_fetch_array($exeProcurarModeloAvaliacao);
    
    $_SESSION["adm_modeloAvaliacao_id_usuario"] = $infProcurarModeloAvaliacao["id_usuario"];
    $_SESSION["adm_modeloAvaliacao_descricao"] = $infProcurarModeloAvaliacao["descricao"];
    $_SESSION["adm_modeloAvaliacao_ativo"] = $infProcurarModeloAvaliacao["ativo"];
}
?>

<script type="text/javascript">

    $(document).ready(function($) {



        $('#descricao').focus();


        $("#ok").click(function() {

            var codigo = $.trim($("#descricao").val());


            if (codigo.length <= 0) {
                alert('é necessário uma descricao');
                $("#descricao").focus();
                return false;
            }

            else {
                $("#cadastro").submit();
            }


        });


    });
</script>

<div align="center">
    <p><i>Modelo Avaliação</p></i>
    
    <h1>Modelo Avaliação</h1>
        <?php if($id_modeloAvaliacao!= "") { ?>
            <h2>Alterar</h2>
	<?php } else { ?>
            <h2>Cadastrar</h2>
	<?php } ?>

    <form action="?area=<?php echo base64_encode("../modulos/modeloAvaliacao/backEnd/modeloAvaliacaoExe.php");?>" method="post"
        name="formModeloAvaliacao" id="formModeloAvaliacao" style="width: 500px; text-align:left;" enctype="multipart/form-data" >

        <p>(*) Itens obrigat&oacute;rios.</p>

            <?php
            if($_SESSION["adm_modeloAvaliacao_aviso"] == "erro"){

                    echo '<p class="msgerro" align="center">ERRO(S):';

                    # TABELA DE ERROS ----------------------------------------------- #
                            if (strpos($_SESSION["adm_modeloAvaliacao_erro"], ".erro01.") !== false)
                    echo "<br />- Informe a Descrição!";
                    
                            # TABELA DE ERROS ----------------------------------------------- #

                            echo '</p>';
            } elseif (($_SESSION["adm_modeloAvaliacao_aviso"] == "ok") and ($id_modeloAvaliacao == "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

                            unset($_SESSION["adm_modeloAvaliacao_aviso"]);
                            unset($_SESSION["adm_modeloAvaliacao_erro"]);

            } elseif (($_SESSION["adm_modeloAvaliacao_aviso"] == "ok") and ($id_modeloAvaliacao != "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

                            unset($_SESSION["adm_modeloAvaliacao_aviso"]);
                            unset($_SESSION["adm_modeloAvaliacao_erro"]);
            }
            ?>
        
            
           

            <p>Descrição: *<br />
            <textarea id = "descricao" name= "descricao" rows="4" cols="60"><?php echo $_SESSION["adm_modeloAvaliacao_descricao"];?></textarea></p>
          
            <?php if ($id_modeloAvaliacao!= "") { ?>
                <p>Ativo: * <br /> 
                <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_cid_ativo"] == 1) echo "checked";?> /> Sim | 
                <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_cid_ativo"] == 0) echo "checked";?> /> N&atilde;o
                </p>
            <?php } ?>

            <input type="hidden" name="id_cid" id="id_cid" value="<?php echo $id_cid;?>" />

            <?php if ($id_cid!= "") { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Alterar  " />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="botaoAcaoExcluir" type="submit" id="botaoAcaoExcluir" value="  Excluir  " />
            <?php } else { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Cadastrar  " />
            <?php } ?>

    </form>
            
</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("../modulos/cid/backEnd/cidNdx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('titulo').focus();
</script>