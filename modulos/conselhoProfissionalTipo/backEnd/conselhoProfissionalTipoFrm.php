<?php
session_start();

include_once("../modulos/conselhoProfissionalTipo/biblioteca/conselhoProfissionalTipoClass.php");
$acaoConselhoProfissionalTipo = new ConselhoProfissionalTipo();

$id_conselho_profissional_tipo = $_REQUEST["id_conselho_profissional_tipo"];

if($id_conselho_profissional_tipo != ""){
    
    $exeProcurarConselhoProfissionalTipo = $acaoConselhoProfissionalTipo->procurarConselhoProfissionalTipo($id_conselho_profissional_tipo);
    $infProcurarConselhoProfissionalTipo = mysql_fetch_array($exeProcurarConselhoProfissionalTipo);
    
    $_SESSION["adm_conselhoProfissionalTipo_id_usuario"] = $infProcurarConselhoProfissionalTipo["id_usuario"];
    $_SESSION["adm_conselhoProfissionalTipo_sigla"] = $infProcurarConselhoProfissionalTipo["sigla"];
    $_SESSION["adm_conselhoProfissionalTipo_descricao"] = $infProcurarConselhoProfissionalTipo["descricao"];
    $_SESSION["adm_conselhoProfissionalTipo_ativo"] = $infProcurarConselhoProfissionalTipo["ativo"];
}
?>

<script type="text/javascript">
    document.ready(function(){
        $('#botaoAcao').click(function(){
            var numero = $("#titulo").val();
            if(numero = ""){
                alert("Digite um numero!");
                $("#titulo").focus();
                return false;
                        }else{
                $("#formConselhoProfissional").submit();
            }
        });
    });
</script>

<div align="center">
    <p><i>Tipo Conselho</p></i>
    
    <h1>Tipo Conselho</h1>
        <?php if($id_conselho_profissional_tipo != "") { ?>
            <h2>Alterar</h2>
	<?php } else { ?>
            <h2>Cadastrar</h2>
	<?php } ?>

    <form action="?area=<?php echo base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoExe.php");?>" method="post"
        name="formConselhoProfissionalTipo" id="formConselhoProfissionalTipo" style="width: 500px; text-align:left;" enctype="multipart/form-data" >

        <p>(*) Itens obrigat&oacute;rios.</p>

            <?php
            if($_SESSION["adm_conselhoProfissionalTipo_aviso"] == "erro"){

                    echo '<p class="msgerro" align="center">ERRO(S):';

                    # TABELA DE ERROS ----------------------------------------------- #
                            if (strpos($_SESSION["adm_conselhoProfissionalTipo_erro"], ".erro01.") !== false)
                    echo "<br />- Informe a Sigla!";
                            else  if (strpos($_SESSION["adm_conselhoProfissionalTipo_erro"], ".erro02.") !== false)
                    echo "<br />- Informe a Descrição!";
                                                  # TABELA DE ERROS ----------------------------------------------- #

                            echo '</p>';
            } elseif (($_SESSION["adm_conselhoProfissionalTipo_aviso"] == "ok") and ($id_conselho_profissional_tipo == "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

                            unset($_SESSION["adm_conselhoProfissional_aviso"]);
                            unset($_SESSION["adm_conselhoProfissional_erro"]);

            } elseif (($_SESSION["adm_conselhoProfissional_aviso"] == "ok") and ($id_conselho_profissional_tipo != "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

                            unset($_SESSION["adm_conselhoProfissional_aviso"]);
                            unset($_SESSION["adm_conselhoProfissional_erro"]);
            }
            ?>
        
            
           

            <p>Sigla: *<br />
            <input name="sigla" type="text" id="sigla" value="<?php echo $_SESSION["adm_conselhoProfissionalTipo_sigla"];?>" size="65" maxlength="250" /></p>

            <p>Descrição: *<br />
            <textarea id = "descricao" name= "descricao" rows="4" cols="60"><?php echo $_SESSION["adm_conselhoProfissionalTipo_descricao"];?></textarea></p>
          
            <?php if ($id_conselho_profissional_tipo!= "") { ?>
                <p>Ativo: * <br /> 
                <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_conselhoProfissionalTipo_ativo"] == 1) echo "checked";?> /> Sim | 
                <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_conselhoProfissionalTipo_ativo"] == 0) echo "checked";?> /> N&atilde;o
                </p>
            <?php } ?>

            <input type="hidden" name="id_conselho_profissional_tipo" id="id_conselho_profissional_tipo" value="<?php echo $id_conselho_profissional_tipo;?>" />

            <?php if ($id_conselho_profissional_tipo!= "") { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Alterar  " />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="botaoAcaoExcluir" type="submit" id="botaoAcaoExcluir" value="  Excluir  " />
            <?php } else { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Cadastrar  " />
            <?php } ?>

    </form>
            
</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoNdx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('titulo').focus();
</script>