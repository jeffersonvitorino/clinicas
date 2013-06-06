<?php
session_start();

include_once("../biblioteca/funcoesDiversas.php");
include_once("../biblioteca/class_usuario.php");
include_once("../biblioteca/class_usuario_nivel.php");

$acaoUsuario      = new usuario();
$acaoUsuarioNivel = new usuario_nivel();

$id_usuario = $_REQUEST["id_usuario"];

if ($id_usuario != "") {

	$exeProcurarUsuario = $acaoUsuario -> procurarUsuario($id_usuario);
	$infProcurarUsuario = mysql_fetch_array($exeProcurarUsuario);

	$_SESSION["adm_usuario_id_usuario_nivel"] = $infProcurarUsuario["id_usuario_nivel"];
	$_SESSION["adm_usuario_nome"]             = $infProcurarUsuario["nome"];
	$_SESSION["adm_usuario_email"]            = $infProcurarUsuario["email"];
	$_SESSION["adm_usuario_ativo"]            = $infProcurarUsuario["ativo"];
}
?>

<script language="javascript" src="../js/js_valida_usuario.js" type="text/javascript"></script>
<script language="javascript" src="../js/js_funcoes_diversas.js" type="text/javascript"></script>

<div align="center">
	<p><i>[ Seguran&ccedil;a ] Usu&aacute;rio</i></p>
    
    <h1>Usu&aacute;rio</h1>
		
	<?php if ($id_usuario != "") { ?>
        <h2>Alterar</h2>
    <?php } else { ?>
        <h2>Cadastrar</h2>
    <?php } ?>
		
	<form name="formUsuario" id="formUsuario" method="post" action="?area=<?php echo base64_encode("seguranca/usuario/usuario_exe.php");?>" style="width: 500px; text-align:left;" onsubmit="return validarUsuario();">
	
		<p>(*) Ítens obrigat&oacute;rios.</p>
		
		<?php
		if ($_SESSION["adm_usuario_aviso"] == "erro") {
			
			echo '<p class="msgerro" align="center">ERRO(S):';
		
			# TABELA DE ERROS ----------------------------------------------- #
			if (strpos($_SESSION["adm_usuario_erro"], ".erro01.") !== false)
                echo "<br />- Informe o nome!";
			
			if (strpos($_SESSION["adm_usuario_erro"], ".erro02.") !== false)
                echo "<br />- Informe um e-mail v&aacute;lido!";
			
			if (strpos($_SESSION["adm_usuario_erro"], ".erro03.") !== false)
                echo "<br />- O e-mail informado encontra-se cadastrado!";
			
			if (strpos($_SESSION["adm_usuario_erro"], ".erro04.") !== false)
                echo "<br />- Informe a senha!";
			
			if (strpos($_SESSION["adm_usuario_erro"], ".erro05.") !== false)
                echo "<br />- Selecione o n&iacute;vel!";
			# TABELA DE ERROS ----------------------------------------------- #
			
			echo '</p>';
		} elseif (($_SESSION["adm_usuario_aviso"] == "ok") and ($id_usuario == "")) {
			
			echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';
			
			unset($_SESSION["adm_usuario_aviso"]);
			unset($_SESSION["adm_usuario_erro"]);
		
		} elseif (($_SESSION["adm_usuario_aviso"] == "ok") and ($id_usuario != "")) {
			
			echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';
			
			unset($_SESSION["adm_usuario_aviso"]);
			unset($_SESSION["adm_usuario_erro"]);
		}
		
		?>
        
        <p>Nome: * <br /> <input name="nome" type="text" id="nome" size="70" maxlength="100" value="<?php echo $_SESSION["adm_usuario_nome"];?>" /></p>
        
        <p>E-mail: * <br /> <input name="email" type="text" id="email" size="70" maxlength="100" value="<?php echo $_SESSION["adm_usuario_email"];?>" /></p>
        
        <p>Senha: * <br /> <input name="senha" type="password" id="senha" size="30" maxlength="100" value="" /></p>
        
        <p>N&iacute;vel: * <br /> 
        <select name="id_usuario_nivel" id="id_usuario_nivel">
        	<option value="XXXXX"> </option>
        <?php
        $exeListarUsuarioNivel = $acaoUsuarioNivel -> listarUsuarioNivel();
		while ($infListarUsuarioNivel = mysql_fetch_array($exeListarUsuarioNivel)) {
		?>
        	<option value="<?php echo $infListarUsuarioNivel["id_usuario_nivel"];?>" <?php if ($_SESSION["adm_usuario_id_usuario_nivel"] == $infListarUsuarioNivel["id_usuario_nivel"]) echo "selected";?> ><?php echo $infListarUsuarioNivel["descricao"];?></option>
        <?php } ?>
        </select>
        </p>
        
        <?php if ($id_usuario != "") { ?>
        	<p>Ativo: * <br /> 
            <input name="ativo" id="ativo" type="radio" value="1" <?php if ($_SESSION["adm_usuario_ativo"] == 1) echo "checked";?> /> Sim | 
            <input name="ativo" id="ativo" type="radio" value="0" <?php if ($_SESSION["adm_usuario_ativo"] == 0) echo "checked";?> /> N&atilde;o
            </p>
        <?php } ?>
        
        
        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario;?>" />
        
        <?php if ($id_usuario != "") { ?>
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Alterar  " />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="botaoAcao" type="button" class="frmBotao" id="botaoAcao" value="  Excluir  " onclick="excluirUsuario();" />
        <?php } else { ?>
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Cadastrar  " />
        <?php } ?>
			
	</form>

</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("seguranca/usuario/usuario_ndx.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('nome').focus();
</script>