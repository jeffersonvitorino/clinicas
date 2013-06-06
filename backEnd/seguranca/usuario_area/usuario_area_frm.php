<?php
session_start();

include_once("../biblioteca/funcoesDiversas.php");
include_once("../biblioteca/class_usuario_area.php");

$acaoUsuarioArea = new usuario_area();

$id_usuario_area = $_REQUEST["id_usuario_area"];

if ($id_usuario_area != "") {

	$exeProcurarUsuarioArea = $acaoUsuarioArea -> procurarUsuarioArea($id_usuario_area);
	$infProcurarUsuarioArea = mysql_fetch_array($exeProcurarUsuarioArea);

	$_SESSION["adm_usuario_area_descricao"] = $infProcurarUsuarioArea["descricao"];
	$_SESSION["adm_usuario_area_caminho"]   = $infProcurarUsuarioArea["caminho"];
	$_SESSION["adm_usuario_area_area_id"]   = $infProcurarUsuarioArea["area_id"];
	$_SESSION["adm_usuario_area_ordem"]     = $infProcurarUsuarioArea["ordem"];
	$_SESSION["adm_usuario_area_ativo"]     = $infProcurarUsuarioArea["ativo"];
}
?>

<script language="javascript" src="../js/js_valida_usuario_area.js" type="text/javascript"></script>
<script language="javascript" src="../js/js_funcoes_diversas.js" type="text/javascript"></script>

<div align="center">
	<p><i>[ Seguran&ccedil;a ] &Aacute;reas do Sistema</i></p>
    
    <h1>&Aacute;reas do Sistema</h1>
		
	<?php if ($id_usuario_area != "") { ?>
        <h2>Alterar</h2>
    <?php } else { ?>
        <h2>Cadastrar</h2>
    <?php } ?>
		
	<form name="formUsuarioArea" id="formUsuarioArea" method="post" action="?area=<?php echo base64_encode("seguranca/usuario_area/usuario_area_exe.php");?>" style="width: 500px; text-align:left;" onsubmit="return validarUsuarioArea();">
	
		<p>(*) Ítens obrigat&oacute;rios.</p>
		
		<?php
		if ($_SESSION["adm_usuario_area_aviso"] == "erro") {
			
			echo '<p class="msgerro" align="center">ERRO(S):';
		
			# TABELA DE ERROS ----------------------------------------------- #
			if (strpos($_SESSION["adm_usuario_area_erro"], ".erro01.") !== false)
                echo "<br />- &Aacute;rea j&aacute; cadastrada!";
			
			if (strpos($_SESSION["adm_usuario_area_erro"], ".erro02.") !== false)
                echo "<br />- Informe a descri&ccedil;&atilde;o!";
				
			if (strpos($_SESSION["adm_usuario_area_erro"], ".erro03.") !== false)
                echo "<br />- Informe a ordem em que &agrave; &Aacute; aparecer&aacute; no menu!";
			# TABELA DE ERROS ----------------------------------------------- #
			
			echo '</p>';
		} elseif (($_SESSION["adm_usuario_area_aviso"] == "ok") and ($id_usuario_area == "")) {
			
			echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';
			
			unset($_SESSION["adm_usuario_area_aviso"]);
			unset($_SESSION["adm_usuario_area_erro"]);
		
		} elseif (($_SESSION["adm_usuario_area_aviso"] == "ok") and ($id_usuario_area != "")) {
			
			echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';
			
			unset($_SESSION["adm_usuario_area_aviso"]);
			unset($_SESSION["adm_usuario_area_erro"]);
		}
		?>
        
        <p>Descri&ccedil;&atilde;o: * <br /> <input name="descricao" type="text" id="descricao" size="70" maxlength="50" value="<?php echo $_SESSION["adm_usuario_area_descricao"];?>" /></p>
        
        <p>Caminho: <br /> <input name="caminho" type="text" id="caminho" size="70" maxlength="255" value="<?php echo $_SESSION["adm_usuario_area_caminho"];?>" /></p>
        
        <p>Ordem: * <br /> <input name="ordem" type="text" id="ordem" size="5" maxlength="3" value="<?php echo $_SESSION["adm_usuario_area_ordem"];?>" /></p>
        
        <p>Menu: <br /> 
        <select name="area_id" id="area_id">
        	<option value="0"> </option>
		<?php
        $exeListarUsuarioAreaAtivoPai = $acaoUsuarioArea -> listarUsuarioAreaAtivoPai();
		while ($infListarUsuarioAreaAtivoPai = mysql_fetch_array($exeListarUsuarioAreaAtivoPai)) {
		?>
        	<option value="<?php echo $infListarUsuarioAreaAtivoPai["id_usuario_area"];?>" <?php if ($_SESSION["adm_usuario_area_area_id"] == $infListarUsuarioAreaAtivoPai["id_usuario_area"]) echo "selected";?> ><?php echo $infListarUsuarioAreaAtivoPai["descricao"];?></option>
        <?php } ?>
        </select>
        </p>
        
        <?php if ($id_usuario_area != "") { ?>
        	<p>Ativo: * <br /> 
            <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_usuario_area_ativo"] == 1) echo "checked";?> /> Sim | 
            <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_usuario_area_ativo"] == 0) echo "checked";?> /> N&atilde;o
            </p>
        <?php } ?>
        
        <input type="hidden" name="id_usuario_area" id="id_usuario_area" value="<?php echo $id_usuario_area;?>" />
        
        <?php if ($id_usuario_area != "") { ?>
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Alterar  " />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="botaoAcao" type="button" class="frmBotao" id="botaoAcao" value="  Excluir  " onclick="excluirUsuarioArea();" />
        <?php } else { ?>
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Cadastrar  " />
        <?php } ?>
			
	</form>

</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("seguranca/usuario_area/usuario_area_ndx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('descricao').focus();
</script>