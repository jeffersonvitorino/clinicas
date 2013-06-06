<?php
session_start();

$palavraChave = $_REQUEST["palavraChave"];

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario_area.php");

$acaoUsuarioArea = new usuario_area();

$totalRegistros = $acaoUsuarioArea -> procurarUsuarioAreaPorPalavraChave($palavraChave);
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
			<td width="300" bgcolor="#d9dbdc"><p><b>Menu</b></p></td>
			<td bgcolor="#d9dbdc"><p><b>Descri&ccedil;&atilde;o</b></p></td>
			<td width="50" bgcolor="#d9dbdc"><p><b>Ordem</b></p></td>
		</tr>';

$cont = 0;

$exeUsuarioAreaPorPalavraChave = $acaoUsuarioArea -> procurarUsuarioAreaPorPalavraChave($palavraChave);
while ($infUsuarioAreaPorPalavraChave = mysql_fetch_array($exeUsuarioAreaPorPalavraChave)) {

	$exeProcurarUsuarioArea = $acaoUsuarioArea -> procurarUsuarioArea($infUsuarioAreaPorPalavraChave["area_id"]);
	$infProcurarUsuarioArea = mysql_fetch_array($exeProcurarUsuarioArea);

	if ($cont % 2 == 0)
		$cor = "#FFFFFF";
	else
		$cor = "#e6e7e8";

	$cont++;

	echo '<tr bgcolor="' . $cor . '">
			<td><p align="center"><a href="?area=' . base64_encode("seguranca/usuario_area/usuario_area_frm.php") . '&id_usuario_area=' . $infUsuarioAreaPorPalavraChave["id_usuario_area"] . '"><img src="../design/util/ico_editar.gif" alt="Alterar" border="0" /></a></p></td>
			<td><p>' . $infProcurarUsuarioArea["descricao"] . '</p></td>
			<td><p>' . $infUsuarioAreaPorPalavraChave["descricao"] . '</p></td>
			<td><p>' . $infUsuarioAreaPorPalavraChave["ordem"] . '</p></td>
		 </tr>';

}

echo '</table>';
?>