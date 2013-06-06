<?php
session_start();

include_once("../modulos/cid/biblioteca/cidClass.php");
$acaoCid = new Cid();

$id_cid= $_REQUEST["id_cid"];

if($id_cid!= ""){
    
    $exeProcurarCid = $acaoCid->procurarCid($id_cid);
    $infProcurarCid = mysql_fetch_array($exeProcurarCid);
    
    $_SESSION["adm_cid_id_usuario"] = $infProcurarCid["id_usuario"];
    $_SESSION["adm_cid_codigo"] = $infProcurarCid["codigo"];
    $_SESSION["adm_cid_descricao"] = $infProcurarCid["descricao"];
    $_SESSION["adm_cid_ativo"] = $infProcurarCid["ativo"];
}
?>

<script type="text/javascript">

    $(document).ready(function($) {



        $('#codigo').focus();


        $("#ok").click(function() {

            var codigo = $.trim($("#codigo").val());


            if (codigo.length <= 0) {
                alert('é necessário um código');
                $("#codigo").focus();
                return false;
            }

            else {
                $("#cadastro").submit();
            }


        });


    });
</script>

<div align="center">
    <p><i>Cid</p></i>
    
    <h1>Cid</h1>
        <?php if($id_cid!= "") { ?>
            <h2>Alterar</h2>
	<?php } else { ?>
            <h2>Cadastrar</h2>
	<?php } ?>

    <form action="?area=<?php echo base64_encode("../modulos/cid/backEnd/cidExe.php");?>" method="post"
        name="formCid" id="formCid" style="width: 500px; text-align:left;" enctype="multipart/form-data" >

        <p>(*) Itens obrigat&oacute;rios.</p>

            <?php
            if($_SESSION["adm_cid_aviso"] == "erro"){

                    echo '<p class="msgerro" align="center">ERRO(S):';

                    # TABELA DE ERROS ----------------------------------------------- #
                            if (strpos($_SESSION["adm_cid_erro"], ".erro01.") !== false)
                    echo "<br />- Informe o Código!";
                            else  if (strpos($_SESSION["adm_cid_erro"], ".erro02.") !== false)
                    echo "<br />- Informe a Descrição!";
                            # TABELA DE ERROS ----------------------------------------------- #

                            echo '</p>';
            } elseif (($_SESSION["adm_cid_aviso"] == "ok") and ($id_cid == "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

                            unset($_SESSION["adm_cid_aviso"]);
                            unset($_SESSION["adm_cid_erro"]);

            } elseif (($_SESSION["adm_cid_aviso"] == "ok") and ($id_cid != "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

                            unset($_SESSION["adm_cid_aviso"]);
                            unset($_SESSION["adm_cid_erro"]);
            }
            ?>
        
            
           

            <p>Código: *<br />
            <input name="codigo" type="text" id="codigo" value="<?php echo $_SESSION["adm_cid_codigo"];?>" size="65" maxlength="250" /></p>

            <p>Descrição: *<br />
            <textarea id = "descricao" name= "descricao" rows="4" cols="60"><?php echo $_SESSION["adm_cid_descricao"];?></textarea></p>
          
            <?php if ($id_cid!= "") { ?>
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