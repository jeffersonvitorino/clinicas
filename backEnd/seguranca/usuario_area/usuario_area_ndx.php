<script language="javascript" src="../js/ajax/ajax_lista.js" type="text/javascript"></script>
<script type="text/javascript">
	function recuperardados() {
	    var palavraChave = document.formUsuarioArea.palavraChave.value;
		var ajax         = new AJAX();
	    
	    ajax.Updater("../biblioteca/lst_usuario_area.php?palavraChave="+palavraChave,"divExibir","get","carregando os dados...");
	}
</script>

<div align="center">
	<p><i>[ Seguran&ccedil;a ] &Aacute;reas do Sistema</i></p>
    
<h1>&Aacute;reas do Sistema</h1>
	
	<a href="?area=<?php echo base64_encode("seguranca/usuario_area/usuario_area_frm.php"); ?>"><img src="../design/util/novo.png" border="0" /></a>

	<form name="formUsuarioArea" id="formUsuarioArea" method="post">
		<p>
		<b>Palavra-Chave:</b>  

		<input name="palavraChave" id="palavraChave" type="text" size="30" maxlength="40" onKeyUp="recuperardados();" />
		
		</p>
	</form>
	
	<?php
    if ($_SESSION["adm_usuario_area_aviso"] == "ok") {
        
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
unset($_SESSION["adm_usuario_area_descricao"]);
unset($_SESSION["adm_usuario_area_caminho"]);
unset($_SESSION["adm_usuario_area_area_id"]);
unset($_SESSION["adm_usuario_area_ordem"]);
unset($_SESSION["adm_usuario_area_ativo"]);
unset($_SESSION["adm_usuario_area_erro"]);
unset($_SESSION["adm_usuario_area_aviso"]);
?>