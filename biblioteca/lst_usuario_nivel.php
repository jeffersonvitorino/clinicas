<?php
session_start();

$palavraChave = $_REQUEST["palavraChave"];

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario_nivel.php");

$acaoUsuarioNivel = new usuario_nivel();

$totalRegistros = $acaoUsuarioNivel -> procurarUsuarioNivelPorPalavraChave($palavraChave);
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
			<td bgcolor="#d9dbdc"><p><b>Descri&ccedil;&atilde;o</b></p></td>
		</tr>';

$cont = 0;

$exeUsuarioNivelPorPalavraChave = $acaoUsuarioNivel -> procurarUsuarioNivelPorPalavraChave($palavraChave);
while ($infUsuarioNivelPorPalavraChave = mysql_fetch_array($exeUsuarioNivelPorPalavraChave)) {

	if ($cont % 2 == 0)
		$cor = "#FFFFFF";
	else
		$cor = "#e6e7e8";

	$cont++;

	echo '<tr bgcolor="' . $cor . '">
			<td><p align="center"><a href="?area=' . base64_encode("seguranca/usuario_nivel/usuario_nivel_frm.php") . '&id_usuario_nivel=' . $infUsuarioNivelPorPalavraChave["id_usuario_nivel"] . '"><img src="../design/util/ico_editar.gif" alt="Alterar" border="0" /></a></p></td>
			<td><p>' . $infUsuarioNivelPorPalavraChave["descricao"] . '</p></td>
		 </tr>';

}

echo '</table>';
?>