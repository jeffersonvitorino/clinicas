<script type="text/javascript" src="../js/js_valida_acesso.js"></script>
<script language="javascript" src="../js/js_funcoes_diversas.js" type="text/javascript"></script>

<div align="center">

    <h1>Acessar</h1>
    
    <div align="center" style="border: 1px solid #000000; width: 350px; padding: 5px;">
    <form name="formAcesso" method="post" action="?area=<?php echo base64_encode("acesso/login_exe.php");?>" onSubmit="return validarAcesso();" style="text-align:left;">
    
    <p align="center">(*) Itens obrigatórios.</p>
    
    <?php
    if ($_SESSION["adm_acesso_aviso"] == "erro") {
        
        echo '<p class="msgerro" align="left">ERRO(S):';
    
        # TABELA DE ERROS ----------------------------------------------- #
            if (strpos($_SESSION["adm_acesso_erro"], ".erro1.") !== false)
                echo "<br />- Digite o E-mail";
            
            if (strpos($_SESSION["adm_acesso_erro"], ".erro2.") !== false)
                echo "<br />- Digite a senha";
            
            if (strpos($_SESSION["adm_acesso_erro"], ".erro3.") !== false)
                echo "<br />- Usuário não autorizado";
            
            if (strpos($_SESSION["adm_acesso_erro"], ".erro4.") !== false)
                echo "<br />- Sua sessão expirou. Por favor, logue novamente!";
        # TABELA DE ERROS ----------------------------------------------- #
        
        echo '</p>';
    }
	
	if ($_REQUEST["envio_ok"] == "1") {
		echo '<p class="msgok" align="center" style="height:20px;">Sua senha foi enviada para seu e-mail.</p>';
	}
    ?>
    
    <p>E-mail:* <br /><input name="email" id="email" class="frmCampoTexto" type="text" size="40" maxlength="100" /></p>
    
    <p>Senha:* <br /><input name="senha" id="senha" class="frmCampoTexto" type="password" size="20" maxlength="50" /></p>
    
    <p align="left"><input name="Submit" type="submit" class="frmBotao" value="  Acessar  " /></p>
    
    <p align="center"><a href="?area=<?php echo base64_encode("acesso/lembrar_senha_frm.php"); ?>">Esqueceu sua Senha?</a></p>
    
    </form>
    </div>

</div>

<script type="text/javascript">
	document.getElementById('email').focus();
</script>