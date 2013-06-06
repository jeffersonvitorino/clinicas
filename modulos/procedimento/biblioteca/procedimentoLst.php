<?php

session_start();

$palavraChave = $_REQUEST["palavraChave"];

include_once("../../../biblioteca/class_mysql.php");
include_once("procedimentoClass.php");

$acaoProcedimento = new Procedimento();


$totalRegistros = $acaoProcedimento->procurarProcedimentoPorPalavraChave($palavraChave);
$totalRegistros1 = mysql_num_rows($totalRegistros);

if ($totalRegistros1 == 0)
    echo '<p>N&atilde;o foi encontrado <b>nenhum</b> registro!</p>';
elseif ($totalRegistros1 == 1)
    echo '<p>Foi encontrado <b>1</b> registro!</p>';
elseif ($totalRegistros1 > 1)
    echo '<p>Foram encontrados <b>' . $totalRegistros . '</b> registros!</p>';

echo '<table width="820" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="50" bgcolor="#d9dbdc">&nbsp;</td>
                        <td bgcolor="#d9dbdc"><p><b>Especialidade</b></p></td>
                        <td bgcolor="#d9dbdc"><p><b>Código</b></p></td>
                        <td bgcolor="#d9dbdc"><p><b>Tuss Grupo</b></p></td>
                        <td bgcolor="#d9dbdc"><p><b>Tuss Subgrupo</b></p></td>
			<td bgcolor="#d9dbdc"><p><b>Procedimento</b></p></td>
			<td width="50" bgcolor="#d9dbdc" aling="center"><p><b>Ativo?</b></p></td>
                        <td width="110" bgcolor="#d9dbdc" aling="center"><p><b>&Uacute;ltima Atualiza&ccedil;&atilde;o</b></p></td>
		</tr>';

$cont = 0;

$exeProcedimentoPorPalavraChave = $acaoProcedimento->procurarProcedimentoPorPalavraChave($palavraChave);
while ($infProcedimentoPorPalavraChave = mysql_fetch_array($exeProcedimentoPorPalavraChave)) {

    if ($infProcedimentoPorPalavraChave["ativo"] == 0)
        $ativo = "N&atilde;o";
    else
        $ativo = "Sim";

    if ($cont % 2 == 0)
        $cor = "#FFFFFF";
    else
        $cor = "#e6e7e8";

    $cont++;

    echo '<tr bgcolor="' . $cor . '">
			<td><p align="center"><a href="?area=' . base64_encode("../modulos/procedimento/backEnd/procedimentoFrm.php") . '&id_procedimento=' . $infProcedimentoPorPalavraChave["id_procedimento"] . '"><img src="../design/util/ico_editar.gif" alt="Alterar" border="0" /></a></p></td>
                        <td><p>' . $infProcedimentoPorPalavraChave["lista_tipo_conselho"] . '</p></td>
			<td><p aling="center">' . $codigo . '</p></td>
                        <td><p aling="center">' . $ativo . '</p></td>
                        <td><p aling="center">' . $ativo . '</p></td>
                        <td><p aling="center">' . $ativo . '</p></td>
                        <td><p aling="center">' . $ativo . '</p></td>
                        <td><p aling="center">' . $infProcedimentoPorPalavraChave["ultima"] . '</p></td>
		 </tr>';
}

echo '</table>';
?>