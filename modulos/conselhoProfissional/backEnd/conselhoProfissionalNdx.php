<script language="javascript" src="../js/ajax/ajax_lista.js" type="text/javascript"></script>
<script type="text/javascript">
        function pegadados(){
            var palavraChave = document.formConselhoProfissional.palavraChave.value;
            var ajax = new AJAX();
            ajax.Updater("../modulos/conselhoProfissional/biblioteca/conselhoProfissionalLst.php?palavraChave="+palavraChave,"divExibir", "get", "carregando os dados...");
        }
</script>

<div align="center">
    <p><i>[ Conselho Profissional ]</i></p>
    
    <h1>Conselho Profissional</h1>
        <a href="?area=<?php echo base64_encode("../modulos/conselhoProfissional/backEnd/conselhoProfissionalFrm.php")?>"><img src="../design/util/novo.png" border="0" /></a>
        <form name="formConselhoProfissional" id="formConselhoProfissional" method="post">
            <p>
            <b>Palavra-Chave</b>
            
            <input name="palavraChave" id="palavraChave" type="text" size="30" maxlength="40" onKeyUp="pegadados();" />
            </p>
        </form>
        
        <?php 
        if($_SESSION["adm_conselhoProfissional_aviso"] == "ok") {
            echo '<p class="msgok" align="center" style="height: 30px;">0 registro foi excluido com sucesso!</p>';
        }
        ?>
</div>

<div id="divExibir">
</div>

<p align="center">
    <a href="?area=<?php echo base64_encode("home.php"); ?>"><img src="../design/util/voltar.png"  border="0" /></a>
</p>

<script type="text/javascript">
    document.getElementById('palavraChave').focus();
</script>

<?php

unset($_SESSION["adm_conselhoProfissional_numero"]);
unset($_SESSION["adm_conselhoProfissional_uf"]);
unset($_SESSION["adm_conselhoProfissional_erro"]);
unset($_SESSION["adm_conselhoProfissional_aviso"]);
?>