<?php
error_reporting(E_ALL ^ E_NOTICE);

session_start();

include_once("../biblioteca/class_mysql.php");
include_once("../biblioteca/class_usuario.php");
include_once("../biblioteca/class_validarFormulario.php");
include_once("../biblioteca/class_funcoes_diversas.php");

$email = tiraAspas($_REQUEST["email"]);

$validarForm = new validarFormulario();

$erro = "";

if ($validarForm -> camposVazios($email) == true)
	$erro .= ".erro01.";

$acaoUsuario = new usuario();

$exeProcurarUsuarioPorEmail = $acaoUsuario -> procurarUsuarioPorEmail($email);
$infProcurarUsuarioPorEmail = mysql_fetch_array($exeProcurarUsuarioPorEmail);

if ($infProcurarUsuarioPorEmail == FALSE)
	$erro .= ".erro2.";

if ($erro != "") {

	$_SESSION["adm_lembrar_senha_aviso"] = "erro";
	$_SESSION["adm_lembrar_senha_erro"]  = $erro;
		
	voltarPagina("?area=".base64_encode("acesso/lembrar_senha_frm.php"));
	
} else {
	
	$senha_nova = gerarNumeroAleatorio(6);
	
	$acaoUsuario -> alterarUsuarioSenhaLembrar($infProcurarUsuarioPorEmail["id_usuario"], $senha_nova);

	$message = '
	<html>
    <head>
    	<title>ALG Consultoria - Lembrar Senha</title>
    </head>
    <body>
    <table width=500 border=0 align=center cellpadding=0 cellspacing=1>
        <tr> 
        	<td height="1" bgcolor="#000000"> </td>
        </tr>
        <tr> 
        	<td height="30" bgcolor="ececec" align=center>
            	<font size=2 face=Verdana, Arial, Helvetica, sans-serif><b>Lembrar Senha</b></font>
            </td>
        </tr>
        <tr> 
        	<td height="1" bgcolor="#000000"> </td>
        </tr>
        <tr> 
        	<td>
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
				Caro(a) usu&aacute;rio(a),
				<br />
				<br />Conforme solicitado, estamos enviando uma nova senha para acesso ao sistema.
				<br />
				<br />Senha: <b>' . $senha_nova . '</b>
				<br />
				<br />Data: <b>' . date('d/m/Y h:i:s') . '</b>
				<br />
				<br />Atenciosamente
				<br /><a href="mailto:suporte@algconsultoria.com.br">suporte@algconsultoria.com.br</a>
                </font>
            </td>
        </tr>
        <tr> 
        	<td height="20" align="center">
            	<a href="http://www.algconsultoria.com.br" target="_blank">
                	<font size="2" face="Verdana, Arial, Helvetica, sans-serif">http://www.algconsultoria.com.br</font>
                </a>
            </td>
        </tr>
    </table>
    </body>
</html>
	';
	
	$to       = $infProcurarUsuarioPorEm["nome"] . "<" . $email . ">";
	$subject  = "ALG - Lembrar Senha";
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: ALG - Suporte <suporte@algconsultoria.com.br>\r\n";
	$headers .= "Reply-To: ALG - Suporte <suporte@algconsultoria.com.br>\r\n";
	$headers .= "Return-Path: ALG - Suporte <suporte@algconsultoria.com.br>\r\n"; 
	$headers .= "Message-ID: <" . time() . "-" . $email . ">\r\n";
	$headers .= "X-Mailer: PHP v" . phpversion() . "\r\n"; 
	
	mail($to, $subject, $message, $headers);
	
	voltarPagina("?area=".base64_encode("acesso/login_frm.php")."&envio_ok=1");
}
?>