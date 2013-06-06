<?php
session_start();

$palavraChave = $_REQUEST["palavraChave"];

include_once("../../../biblioteca/class_mysql.php");
include_once("conselhoProfissionalTipoClass.php");

$acaoConselhoProfissionalTipo = new ConselhoProfissionalTipo();


$totalRegistros = $acaoConselhoProfissionalTipo ->procurarConselhoProfissionalTipoPorPalavraChave($palavraChave);
$totalRegistros1 = mysql_num_rows($totalRegistros);

if ($totalRegistros1 == 0)
	echo '<p>N&atilde;o foi encontrado <b>nenhum</b> registro!</p>';
elseif ($totalRegistros1 == 1)
	echo '<p>Foi encontrado <b>1</b> registro!</p>';
elseif ($totalRegistros1 > 1)
	echo '<p>Foram encontrados <b>' . $totalRegistros1 . '</b> registros!</p>';

echo '<table width="820" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="50" bgcolor="#d9dbdc">&nbsp;</td>
                        <td bgcolor="#d9dbdc"><p><b>Sigla do Conselho</b></p></td>
			<td bgcolor="#d9dbdc"><p><b>Descri&ccedil;&atilde;o do Conselho</b></p></td>
			<td width="50" bgcolor="#d9dbdc" aling="center"><p><b>Ativo?</b></p></td>
                        <td width="110" bgcolor="#d9dbdc" aling="center"><p><b>&Uacute;ltima Atualiza&ccedil;&atilde;o</b></p></td>
		</tr>';

$cont = 0;

$exeConselhoProfissionalTipoPorPalavraChave = $acaoConselhoProfissionalTipo ->procurarConselhoProfissionalTipoPorPalavraChave($palavraChave);
while ($infConselhoProfissionalTipoPorPalavraChave = mysql_fetch_array($exeConselhoProfissionalTipoPorPalavraChave)) {
	
	if ($infConselhoProfissionalTipoPorPalavraChave["ativo"] == 0)
		$ativo = "N&atilde;o";
	else
		$ativo = "Sim";

	if ($cont % 2 == 0)
		$cor = "#FFFFFF";
	else
		$cor = "#e6e7e8";

	$cont++;
	echo '<tr bgcolor="' . $cor . '">
			<td><p align="center"><a href="?area=' . base64_encode("../modulos/conselhoProfissionalTipo/backEnd/conselhoProfissionalTipoFrm.php") . '&id_conselho_profissional_tipo=' . $infConselhoProfissionalTipoPorPalavraChave["id_conselho_profissional_tipo"] . '"><img src="../design/util/ico_editar.gif" alt="Alterar" border="0" /></a></p></td>
                        <td><p>' . $infConselhoProfissionalTipoPorPalavraChave["sigla"] . '</p></td>
                        <td><p>' . $infConselhoProfissionalTipoPorPalavraChave["descricao"] . '</p></td>
			<td><p aling="center">' . $ativo . '</p></td>
                        <td><p aling="center">' . $infConselhoProfissionalTipoPorPalavraChave["ultima"] . '</p></td>
		 </tr>';
}

echo '</table>';
?>