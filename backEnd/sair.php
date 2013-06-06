<?php
session_destroy();
?>

<script language="JavaScript">
		window.location = "?area=<?php echo base64_encode("acesso/login_frm.php");?>";
</script>

<?php
	header("location: ?area=" . base64_encode("acesso/login_frm.php"));
?>