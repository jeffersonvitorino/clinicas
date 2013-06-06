<?php
session_start();

include_once("../biblioteca/funcoesDiversas.php");
include_once("../biblioteca/class_usuario_nivel.php");
include_once("../biblioteca/class_usuario_area.php");

$acaoUsuarioNivel = new usuario_nivel();
$acaoUsuarioArea  = new usuario_area();

$id_usuario_nivel = $_REQUEST["id_usuario_nivel"];

if ($id_usuario_nivel != "") {

	$exeProcurarUsuarioNivel = $acaoUsuarioNivel -> procurarUsuarioNivel($id_usuario_nivel);
	$infProcurarUsuarioNivel = mysql_fetch_array($exeProcurarUsuarioNivel);

	$_SESSION["adm_usuario_nivel_descricao"] = $infProcurarUsuarioNivel["descricao"];	
}
?>

<script language="javascript" src="../js/js_valida_usuario_nivel.js" type="text/javascript"></script>
<script language="javascript" src="../js/js_funcoes_diversas.js" type="text/javascript"></script>

<div align="center">
	<p><i>[ Seguran&ccedil;a ] N&iacute;veis de Permiss&atilde;o</i></p>
    
    <h1>N&iacute;veis de Permiss&atilde;o</h1>
		
	<?php if ($id_usuario_nivel != "") { ?>
        <h2>Alterar</h2>
    <?php } else { ?>
        <h2>Cadastrar</h2>
    <?php } ?>
		
	<form name="formUsuarioNivel" id="formUsuarioNivel" method="post" action="?area=<?php echo base64_encode("seguranca/usuario_nivel/usuario_nivel_exe.php");?>" style="width: 500px; text-align:left;" onsubmit="return validarUsuarioNivel();">
	
		<p>(*) Ítens obrigat&oacute;rios.</p>
		
		<?php
		if ($_SESSION["adm_usuario_nivel_aviso"] == "erro") {
			
			echo '<p class="msgerro" align="center">ERRO(S):';
		
			# TABELA DE ERROS ----------------------------------------------- #
			if (strpos($_SESSION["adm_usuario_nivel_erro"], ".erro01.") !== false)
                echo "<br />- N&iacute;vel j&aacute; cadastrado!";
			
			if (strpos($_SESSION["adm_usuario_nivel_erro"], ".erro02.") !== false)
                echo "<br />- Informe a descri&ccedil;&atilde;o!";
			
			if (strpos($_SESSION["adm_usuario_nivel_erro"], ".erro03.") !== false)
                echo "<br />- Selecione no m&iacute;nimo uma &aacute;rea";
			# TABELA DE ERROS ----------------------------------------------- #
			
			echo '</p>';
		} elseif (($_SESSION["adm_usuario_nivel_aviso"] == "ok") and ($id_usuario_nivel == "")) {
			
			echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';
			
			unset($_SESSION["adm_usuario_nivel_aviso"]);
			unset($_SESSION["adm_usuario_nivel_erro"]);
		
		} elseif (($_SESSION["adm_usuario_nivel_aviso"] == "ok") and ($id_usuario_nivel != "")) {
			
			echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';
			
			unset($_SESSION["adm_usuario_nivel_aviso"]);
			unset($_SESSION["adm_usuario_nivel_erro"]);
		}
		?>
        
        <p>Descri&ccedil;&atilde;o: * <br /> <input name="descricao" type="text" id="descricao" size="70" maxlength="100" value="<?php echo $_SESSION["adm_usuario_nivel_descricao"];?>" /></p>
        
        <p><b>&Aacute;reas do Sistema: *</b> <br />
        
        <table width="600" border="0" cellspacing="0" cellpadding="0">
        <?php
        $exeListarUsuarioArea = $acaoUsuarioArea -> listarUsuarioAreaAtivo();
		while ($infListarUsuarioArea = mysql_fetch_array($exeListarUsuarioArea)) {
			$id_usuario_area = $infListarUsuarioArea["id_usuario_area"];
			$descricao       = $infListarUsuarioArea["descricao"];
			
			if ($id_usuario_nivel != "") {
				$exeProcurarUsuarioAreaPorIdNivelEIdArea = $acaoUsuarioNivel -> procurarUsuarioAreaPorIdNivelEIdArea($id_usuario_nivel, $id_usuario_area);
				$infProcurarUsuarioAreaPorIdNivelEIdArea = mysql_fetch_array($exeProcurarUsuarioAreaPorIdNivelEIdArea);
			}
			
			if ($infListarUsuarioArea["area_id"] != 0) {
				$exeProcurarUsuarioArea = $acaoUsuarioArea -> procurarUsuarioArea($infListarUsuarioArea["area_id"]);
				$infProcurarUsuarioArea = mysql_fetch_array($exeProcurarUsuarioArea);
				
				$descricao = "[ " . $infProcurarUsuarioArea["descricao"] . " ] &raquo; " . $descricao;
			} else {
				$descricao = "&raquo; " . $descricao;
			}
		?>
          <tr>
          	<td width="10" height="20"><input name="id_usuario_area[]" id="id_usuario_area[]" type="checkbox" value="<?php echo $id_usuario_area; ?>" <?php if ($infProcurarUsuarioAreaPorIdNivelEIdArea == true) echo "checked"; ?> /></td>
            <td width="259"><p><?php echo $descricao; ?></p></td>
            <?php
            $id_usuario_area = "";
			$descricao       = "";
			if ($infListarUsuarioArea = mysql_fetch_array($exeListarUsuarioArea)) {
				$id_usuario_area = $infListarUsuarioArea["id_usuario_area"];
				$descricao       = $infListarUsuarioArea["descricao"];
			}
			?>
            <td width="10"></td>
            <td width="10">
				<?php
                if ($id_usuario_area != "") {
					if ($id_usuario_nivel != "") {
						$exeProcurarUsuarioAreaPorIdNivelEIdArea = $acaoUsuarioNivel -> procurarUsuarioAreaPorIdNivelEIdArea($id_usuario_nivel, $id_usuario_area);
						$infProcurarUsuarioAreaPorIdNivelEIdArea = mysql_fetch_array($exeProcurarUsuarioAreaPorIdNivelEIdArea);
					}
					
					if ($infListarUsuarioArea["area_id"] != 0) {
						$exeProcurarUsuarioArea = $acaoUsuarioArea -> procurarUsuarioArea($infListarUsuarioArea["area_id"]);
						$infProcurarUsuarioArea = mysql_fetch_array($exeProcurarUsuarioArea);
						
						$descricao = "[ " . $infProcurarUsuarioArea["descricao"] . " ] &raquo; " . $descricao;
					} else {
						$descricao = "&raquo; " . $descricao;
					}
				?>
                <input name="id_usuario_area[]" id="id_usuario_area[]" type="checkbox" value="<?php echo $id_usuario_area; ?>" <?php if ($infProcurarUsuarioAreaPorIdNivelEIdArea == true) echo "checked"; ?> />
                <?php } ?>
            </td>
            <td>
				<?php if ($descricao != "") { ?>
                <p><?php echo $descricao; ?></p>
                <?php } ?>
            </td>
          </tr>
		<?php } ?>
        </table>
        </p>
        
    <input type="hidden" name="id_usuario_nivel" id="id_usuario_nivel" value="<?php echo $id_usuario_nivel;?>" />
        
        <?php if ($id_usuario_nivel != "") { ?>
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Alterar  " />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="botaoAcao" type="button" class="frmBotao" id="botaoAcao" value="  Excluir  " onclick="excluirUsuarioNivel();" />
        <?php } else { ?>
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Cadastrar  " />
        <?php } ?>
			
	</form>

</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("seguranca/usuario_nivel/usuario_nivel_ndx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('descricao').focus();
</script>