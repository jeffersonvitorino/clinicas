<script type="text/javascript">
$(document).ready(function($){
    $("#acessar").click(function(){ 
        
        
        var tamanho = $("#matricula").val().length;
        
        if($("#matricula").val() ==""){
            alert("é necessário a matrícula do aluno");
            $("#matricula").focus();
            return false;
        } 
        
        if(tamanho < 8){
            alert("a matricula deve conter no mínimo 8 dígitos");
            $("#matricula").focus();
            return false;
        } 
        
        if($("#cpf").val() ==""){
            alert("é necessário o cpf do responsável financeiro do aluno");
            $("#cpf").focus();
            return false;
        } 
        
        else {
            $("#formAcesso").submit();
            return true;
        }        
    });
});
</script>
<div align="center">

    <h1>Acesso ao sistema</h1>
    
    <div align="center" style="border: 1px solid #000000; width: 350px; padding: 5px;">
    <form name="formAcesso" method="post" action="?area=login_exe" style="text-align:left; width: 330px;">
    
    (*) Itens obrigatórios.
    
    <?php
    
    if ($_SESSION["acesso_aviso"] == "erro") {
        
        echo '<p class="msgerro" align="left">ATENÇÃO:';
    
        # TABELA DE ERROS ----------------------------------------------- #
            if (strpos($_SESSION["acesso_erro"], ".erro1.") !== false)
                echo "<br />- Digite a matrícula";
            
            if (strpos($_SESSION["acesso_erro"], ".erro2.") !== false)
                echo "<br />- Digite o cpf";
            
            if (strpos($_SESSION["acesso_erro"], ".erro3.") !== false)
                echo "<br />- Procure a secretaria escolar – fones: 3268.6501 – 3268.8319 – 3268.0583.";
            
            if (strpos($_SESSION["acesso_erro"], ".erro4.") !== false)
                echo "<br />- Sua sessão expirou. Por favor, logue novamente!";
        # TABELA DE ERROS ----------------------------------------------- #
        
        echo '</p>';
    }
    ?>
    
    <p>Matrícula:*<br /><input name="matricula" id="matricula" type="text" size="40" maxlength="50" /></p>
    
    <p>CPF:* <br /><input name="cpf" alt="cpf" id="cpf" type="text" size="40" maxlength="50" /></p>
    
    <p align="left"><input name="Submit" type="submit" class="frmBotao" value="  Acessar  " id="acessar" name="acessar" /></p>
    
    </form>
    </div>

</div>

<script type="text/javascript">
	document.getElementById('matricula').focus();
</script>
