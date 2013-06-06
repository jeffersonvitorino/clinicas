<?php
session_start();

include_once("../modulos/conselhoProfissional/biblioteca/conselhoProfissionalClass.php");
$acaoConselhoProfissional = new ConselhoProfissional();

$id_conselho_profissional = $_REQUEST["id_conselho_profisional"];

if($id_conselho_profissional != ""){
    
    $exeProcurarConselhoProfissional = $acaoConselhoProfissional->procurarConselhoProfissional($id_conselho_profissional);
    $infProcurarConselhoProfissional = mysql_fetch_array($exeProcurarConselhoProfissional);
    
    $_SESSION["adm_conselhoProfissional_id_usuario"] = $infProcurarConselhoProfissional["id_usuario"];
    $_SESSION["adm_conselhoProfissional_numero"] = $infProcurarConselhoProfissional["numero"];
    $_SESSION["adm_conselhoProfissional_uf"] = $infProcurarConselhoProfissional["uf"];
    $_SESSION["adm_conselhoProfissional_ativo"] = $infProcurarConselhoProfissional["ativo"];
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
    <p><i>Conselho Profissional</p></i>
    
    <h1>Conselho Profissional</h1>
        <?php if($id_conselho_profissional!= "") { ?>
            <h2>Alterar</h2>
	<?php } else { ?>
            <h2>Cadastrar</h2>
	<?php } ?>

    <form action="?area=<?php echo base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissionalExe.php");?>" method="post"
        name="formConselhoProfissional" id="formConselhoProfissional" style="width: 500px; text-align:left;" enctype="multipart/form-data" >

        <p>(*) Itens obrigat&oacute;rios.</p>

            <?php
            if($_SESSION["adm_conselhoProfissional_aviso"] == "erro"){

                    echo '<p class="msgerro" align="center">ERRO(S):';

                    # TABELA DE ERROS ----------------------------------------------- #
                            if (strpos($_SESSION["adm_conselhoProfissional_erro"], ".erro01.") !== false)
                    echo "<br />- Informe o Numero!";
                            else  if (strpos($_SESSION["adm_conselhoProfissional_erro"], ".erro02.") !== false)
                    echo "<br />- Informe a Uf!";
                    
                                     
                            # TABELA DE ERROS ----------------------------------------------- #

                            echo '</p>';
            } elseif (($_SESSION["adm_conselhoProfissional_aviso"] == "ok") and ($id_conselho_profissional == "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

                            unset($_SESSION["adm_conselhoProfissional_aviso"]);
                            unset($_SESSION["adm_conselhoProfissional_erro"]);

            } elseif (($_SESSION["adm_conselhoProfissional_aviso"] == "ok") and ($id_conselho_profissional != "")) {

                            echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

                            unset($_SESSION["adm_conselhoProfissional_aviso"]);
                            unset($_SESSION["adm_conselhoProfissional_erro"]);
            }
            ?>
        
            
        
            <p>Tipo do Conselho Profissional: *<br />
                <select id="id_conselho_profissional_tipo" name="id_conselho_profissional_tipo">
                   <option value="XXXXX" selected>Selecione ...</option>
                    <?php
                    include_once("../modulos/conselhoProfissionalTipo/biblioteca/conselhoProfissionalTipoClass.php");
                    $acaoConselhoProfissionalTipo = new ConselhoProfissionalTipo();
                    
                    $exeListarConselhoProfissionalTipo = $acaoConselhoProfissionalTipo -> listarConselho_profissional_tipo();
                    
                    while ($infListarConselhoProfissionalTipo = mysql_fetch_array($exeListarConselhoProfissionalTipo)){
                    ?>
                        <option value="<?php echo $infListarConselhoProfissionalTipo["id_conselho_profissional_tipo"];?>" <?php if ($_SESSION["adm_conselhoProfissional_id_tipo"] == $infListarConselhoProfissionalTipo["id_conselho_profissional_tipo"]) echo "selected";?>><?php echo $infListarConselhoProfissionalTipo["sigla"] . " - " . $infListarConselhoProfissionalTipo["descricao"];?></option>
                    <?php } ?>
                </select>
            </p>

        
            <p>N&uacute;mero: *<br />
            <input name="numero" type="text" id="numero" value="<?php echo $_SESSION["adm_conselhoProfissional_numero"];?>" size="65" maxlength="250" /></p>

           <p>Uf: *<br />
                              
                                        <select id="uf" name="uf" value="<?php echo $_SESSION["adm_conselhoProfissional_uf"];?>">
                                            <option value="XXXXX" selected>Selecione ...</option>
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AP">AP</option>
                                            <option value="AM">AM</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MT">MT</option>
                                            <option value="MS">MS</option>
                                            <option value="MG">MG</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PR">PR</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SP">SP</option>
                                            <option value="SE">SE</option>
                                            <option value="TO">TO</option> 
                                        </select>
           </p>
            <?php if ($id_conselho_profissional != "") { ?>
                <p>Ativo: * <br /> 
                <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_conselhoProfisisonal_ativo"] == 1) echo "checked";?> /> Sim | 
                <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_conselhoProfissional_ativo"] == 0) echo "checked";?> /> N&atilde;o
                </p>
            <?php } ?>

            <input type="hidden" name="id_conselho_profissional" id="id_conselho_profissional" value="<?php echo $id_conselho_profissional;?>" />

            <?php if ($id_conselho_profissional != "") { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Alterar  " />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="botaoAcaoExcluir" type="submit" id="botaoAcaoExcluir" value="  Excluir  " />
            <?php } else { ?>
            <input name="botaoAcao" type="submit" id="botaoAcao" value="  Cadastrar  " />
            <?php } ?>

    </form>
            
</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissional Ndx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('titulo').focus();
</script>