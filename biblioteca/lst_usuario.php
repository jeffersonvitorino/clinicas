<?php
session_start();

$palavraChave = $_REQUEST["palavraChave"];

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario.php");
include_once("../biblioteca/class_usuario_nivel.php");

$acaoUsuario      = new usuario();
$acaoUsuarioNivel = new usuario_nivel();

$totalRegistros = $acaoUsuario -> procurarUsuarioPorPalavraChave($palavraChave);
$totalRegistros = mysql_num_rows($totalRegistros);

if ($totalRegistros == 0)
	echo '<p>N&atilde;o foi encontrado <b>nenhum</b> registro!</p>';
elseif ($totalRegistros == 1)
	echo '<p>Foi encontrado <b>1</b> registro!</p>';
elseif ($totalRegistros > 1)
	echo '<p>Foram encontrados <b>' . $totalRegistros . '</b> registros!</p>';

echo '<table width="820" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="50" bgcolor="#d9dbdc">&nbsp;</td>
			<td bgcolor="#d9dbdc"><p><b>Nome</b></p></td>
			<td width="200" bgcolor="#d9dbdc"><p><b>N&iacute;vel</b></p></td>
			<td width="170" bgcolor="#d9dbdc"><p><b>Ativo?</b></p></td>
		</tr>';

$cont = 0;

$exeUsuarioPorPalavraChave = $acaoUsuario -> procurarUsuarioPorPalavraChave($palavraChave);
while ($infUsuarioPorPalavraChave = mysql_fetch_array($exeUsuarioPorPalavraChave)) {
	
	$exeUsuarioNivel = $acaoUsuarioNivel -> procurarUsuarioNivel($infUsuarioPorPalavraChave["id_usuario_nivel"]);
	$infUsuarioNivel = mysql_fetch_array($exeUsuarioNivel);
	
	if ($infUsuarioPorPalavraChave["ativo"] == 0)
		$ativo = "N&atilde;o";
	else
		$ativo = "Sim";

	if ($cont % 2 == 0)
		$cor = "#FFFFFF";
	else
		$cor = "#e6e7e8";

	$cont++;

	echo '<tr bgcolor="' . $cor . '">
			<td><p align="center"><a href="?area=' . base64_encode("seguranca/usuario/usuario_frm.php") . '&id_usuario=' . $infUsuarioPorPalavraChave["id_usuario"] . '"><img src="../design/util/ico_editar.gif" alt="Alterar" border="0" /></a></p></td>
			<td><p>' . $infUsuarioPorPalavraChave["nome"] . '</p></td>
			<td><p>' . $infUsuarioNivel["descricao"] . '</p></td>
			<td><p>' . $ativo . '</p></td>
		 </tr>';

}

echo '</table>';
?>