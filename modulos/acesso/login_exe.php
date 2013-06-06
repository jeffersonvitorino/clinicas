<?php
session_start();

include_once("biblioteca/class_mysql.php");
include_once("biblioteca/class_responsavel.php");
include_once("biblioteca/class_validarFormulario.php");
include_once("biblioteca/class_funcoes_diversas.php");
include_once("biblioteca/class_etapas.php");
include_once("biblioteca/class_aluno.php");
include_once("biblioteca/class_boleto_bancario.php");



$matricula = $_REQUEST["matricula"];
$cpf = $_REQUEST["cpf"];

$validarForm = new validarFormulario();

$erro = "";

if ($validarForm -> camposVazios($matricula) == true)
	$erro .= ".erro01.";

if ($validarForm -> camposVazios($cpf) == true)
	$erro .= ".erro02.";

$acaoResponsavel = new responsavel();
$exe = $acaoResponsavel->logarResponsavel($cpf, $matricula);
$inf = mysql_fetch_array($exe);


if ($inf == FALSE)
	$erro .= ".erro3.";

if ($erro != "") {

	$_SESSION["acesso_aviso"] = "erro";
	$_SESSION["acesso_erro"]  = $erro;
        
        
        
        /*echo '<pre>';
        var_dump($_SESSION["acesso_aviso"]);
        echo '<br />';
        var_dump($_SESSION["acesso_erro"]);
        die();*/
        
		
	voltarPagina("?area=homeErro");
	
} else {

    
/*    echo '<pre>';
var_dump($inf);
die();*/
    
	//unset($_SESSION["acesso_aviso"]);
	//unset($_SESSION["acesso_erro"]);

	$_SESSION["responsavel_id"] = $inf["id_responsavel"];
	$_SESSION["responsavel_nome"] = $inf["nome"];
	$_SESSION["responsavel_nome_aluno"] = $inf["nomeAluno"];
	$_SESSION["responsavel_id_aluno"] = $inf["id_aluno"];
	$_SESSION["responsavel_matricula_aluno"] = $inf['matricula'];
        
        // com o id do aluno verifica se o responsavel ja confirmou o contrato
        // se confirmou manda pra tela de cadastro se não manda pra tela de confirmação
        // de contrato
        
        $acaoEtapas = new etapas();
        $exeEtapas = $acaoEtapas->procurarPeloIdDoALuno($inf["id_aluno"]);
        $infEtapas = mysql_fetch_array($exeEtapas);
        
        $acaoBoelto = new boletoBancario();
        $exeBoleto = $acaoBoelto->buscaPagouOuNão($inf["id_aluno"]);
        $infBoleto = mysql_fetch_array($exeBoleto);
        
        
        
        $acaoAluno = new aluno();
        $exeAluno = $acaoAluno->procurarEscolaPorIdAluno($inf["id_aluno"]);
        $infAluno = mysql_fetch_array($exeAluno);
        
        $_SESSION["responsavel_id_escola"] = $infAluno['id_escola'];
        
        
        
        if($infEtapas == null){
            voltarPagina("?area=etapas");
        }
        else{
            if($infBoleto == null){
            //ja confirmou o contrato
            /*echo'ja confirmou o contrato';
            die();*/
            //PASSO 2
            voltarPagina("?area=dados_cadastrais");
            }
            else {
                // não confirmou..
                /*echo'não confirmou..';
                die();*/
                //PASSO 1
                voltarPagina("?area=etapas");
            }
        }
        
        
        /*if($infBoleto == null){
            //ja confirmou o contrato
            echo'ja confirmou o contrato';
            die();
            //PASSO 2
            voltarPagina("?area=dados_cadastrais");
        }
        else {
            // não confirmou..
            echo'não confirmou..';
            die();
            //PASSO 1
            voltarPagina("?area=etapas");
        }*/
                
	

}
?>