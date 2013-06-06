<script type="text/javascript" src="../js/js_valida_acesso.js"></script>
<script language="javascript" src="../js/js_funcoes_diversas.js" type="text/javascript"></script>

<div align="center">

    <h1>Lembrar Senha</h1>
    
    <div align="center" style="border: 1px solid #000000; width: 350px; padding: 5px;">
    <form name="formLembrarSenha" method="post" action="?area=<?php echo base64_encode("acesso/lembrar_senha_exe.php");?>" onSubmit="return validarLembrarSenha();" style="text-align:left;">
    
    <p align="center">Para receber sua senha, digite abaixo o e-mail cadastrado no sistema.</p>
    
    <?php
    if ($_SESSION["adm_lembrar_senha_aviso"] == "erro") {
        
        echo '<p class="msgerro" align="left">ERRO(S):';
    
        # TABELA DE ERROS ----------------------------------------------- #
            if (strpos($_SESSION["adm_lembrar_senha_erro"], ".erro1.") !== false)
                echo "<br />- Digite o E-mail";
            
            if (strpos($_SESSION["adm_lembrar_senha_erro"], ".erro2.") !== false)
                echo "<br />- O e-mail informado não foi localizado";
        # TABELA DE ERROS ----------------------------------------------- #
        
        echo '</p>';
    }
    ?>
    
    <p>E-mail:* <br /><input name="email" id="email" class="frmCampoTexto" type="text" size="40" maxlength="100" /></p>
    
    <p align="left"><input name="Submit" type="submit" class="frmBotao" value="  Enviar  " /></p>
    
    </form>
    </div>

</div>

<p align="center">
	<a href="?area=<?php echo base64_encode("acesso/login_frm.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('email').focus();
</script>