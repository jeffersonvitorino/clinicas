<script language="javascript" src="../js/ajax/ajax_lista.js" type="text/javascript"></script>
<script type="text/javascript">
	function recuperardados() {
	    var palavraChave = document.formUsuario.palavraChave.value;
		var ajax         = new AJAX();
	    
	    ajax.Updater("../biblioteca/lst_usuario.php?palavraChave="+palavraChave,"divExibir","get","carregando os dados...");
	}
</script>

<div align="center">
	<p><i>[ Seguran&ccedil;a ] Usu&aacute;rio</i></p>
    
    <h1>Usu&aacute;rio</h1>
	
	<a href="?area=<?php echo base64_encode("seguranca/usuario/usuario_frm.php"); ?>"><img src="../design/util/novo.png" border="0" /></a>

	<form name="formUsuario" id="formUsuario" method="post">
		<p>
		<b>Palavra-Chave:</b>  

		<input name="palavraChave" id="palavraChave" type="text" size="30" maxlength="40" onKeyUp="recuperardados();" />
		
		</p>
	</form>
	
	<?php
    if ($_SESSION["adm_usuario_aviso"] == "ok") {
        
        echo '<p class="msgok" align="center" style="height: 30px;">O registro foi excluido com sucesso!</p>';
	
	}
    ?>
</div>

<div id="divExibir">
	
</div>

<p align="center">
	<a href="?area=<?Php echo base64_encode("home.php"); ?>"><img src="../design/util/voltar.png" border="0" /></a>
</p>

<script type="text/javascript">
	document.getElementById('palavraChave').focus();
</script>

<?php
unset($_SESSION["adm_usuario_id_usuario_nivel"]);
unset($_SESSION["adm_usuario_nome"]);
unset($_SESSION["adm_usuario_email"]);
unset($_SESSION["adm_usuario_ativo"]);
unset($_SESSION["adm_usuario_erro"]);
unset($_SESSION["adm_usuario_aviso"]);
?>