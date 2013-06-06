<?php
session_start();

include_once("../biblioteca/funcoesDiversas.php");
?>

<script language="javascript" src="../js/js_valida_alterar_senha.js" type="text/javascript"></script>
<script language="javascript" src="../js/js_funcoes_diversas.js" type="text/javascript"></script>

<div align="center">		
	<p><i>[ Seguran&ccedil;a ] Alterar Senha</i></p>
    
    <h1>Alterar Senha</h1>
		
	<form name="formAlterarSenha" id="formAlterarSenha" method="post" action="?area=<?php echo base64_encode("seguranca/alterar_senha/alterar_senha_exe.php");?>" style="width: 500px; text-align:left;" onsubmit="return validarAlterarSenha();">
	
		<p>(*) Ítens obrigat&oacute;rios.</p>
		
		<?php
		if ($_SESSION["adm_alterar_senha_aviso"] == "erro") {
			
			echo '<p class="msgerro" align="center">ERRO(S):';
		
			# TABELA DE ERROS ----------------------------------------------- #
			if (strpos($_SESSION["adm_alterar_senha_erro"], ".erro01.") !== false)
                echo "<br />- Informe sua senha atual!";
			
			if (strpos($_SESSION["adm_alterar_senha_erro"], ".erro02.") !== false)
                echo "<br />- Informe a nova senha!";
			
			if (strpos($_SESSION["adm_alterar_senha_erro"], ".erro03.") !== false)
                echo "<br />- Repita a nova senha!";
			
			if (strpos($_SESSION["adm_alterar_senha_erro"], ".erro04.") !== false)
                echo "<br />- Repida a nova senha igual ao campo nova senha!";
			
			if (strpos($_SESSION["adm_alterar_senha_erro"], ".erro05.") !== false)
                echo "<br />- A senha atual informada esta errada!";
			# TABELA DE ERROS ----------------------------------------------- #
			
			echo '</p>';
		
		} elseif ($_SESSION["adm_alterar_senha_aviso"] == "ok") {
			
			echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';
			
			unset($_SESSION["adm_alterar_senha_aviso"]);
			unset($_SESSION["adm_alterar_senha_erro"]);
		}
		
		?>
        
        <p>Senha Atual: * <br /> <input name="senha_atual" type="password" id="senha_atual" size="30" maxlength="100" value="" /></p>
        
        <p>Nova Senha: * <br /> <input name="senha_nova" type="password" id="senha_nova" size="30" maxlength="100" value="" /></p>
        
        <p>Repetir Nova Senha: * <br /> <input name="senha_nova_repetir" type="password" id="senha_nova_repetir" size="30" maxlength="100" value="" /></p>
        
        <input name="botaoAcao" type="submit" class="frmBotao" id="botaoAcao" value="  Alterar  " />
			
	</form>

</div>

<script type="text/javascript">
	document.getElementById('senha_atual').focus();
</script>