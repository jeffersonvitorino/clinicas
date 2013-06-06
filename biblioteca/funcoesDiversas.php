<?php
function gerarNumeroAleatorio($quantidadeDeNumeros){

	$numeros = "0123456789";
     
	 for($indice = 0;$indice < $quantidadeDeNumeros;$indice++){                
	 	$rand = rand(0,9);                
	 	$digito .= substr($numeros,$rand,1);
	}
	
	return $digito;
}
		
//**********************************************************************************
// Função para verificar ataque por SQL Injection
//**********************************************************************************
function verificaDados($data) { 
	$data = strip_tags($data);
	$data = trim($data);
	$data = get_magic_quotes_gpc() == 0 ? addslashes($data) : $data;
	$data = preg_replace("@(--|\#|\*|;)@s", "", $data);
	return $data;
}

//********************************************************************
// Fun��o para Retirar as Aspas Simples e Duplas
//********************************************************************
function tiraAspas($texto) {
	
	$texto = addslashes($texto);
	
	return $texto;
}

//********************************************************************
// Fun��o para retornar toda a vari�vel em MAI�SCULO.
//********************************************************************
function maiusculo(&$string) {
	$string = strtoupper($string);
	$string = str_replace("á","Á",$string);
	$string = str_replace("é","É",$string);
	$string = str_replace("í","Í",$string);
	$string = str_replace("ó","Ó",$string);
	$string = str_replace("ú","Ú",$string);
	$string = str_replace("â","Â",$string);
	$string = str_replace("ê","Ê",$string);
	$string = str_replace("ô","Ô",$string);
	$string = str_replace("î","Î",$string);
	$string = str_replace("û","Û",$string);
	$string = str_replace("ã","Ã",$string);
	$string = str_replace("õ","Õ",$string);
	$string = str_replace("ç","Ç",$string);
	$string = str_replace("à","À",$string);
	$string = str_replace("è","È",$string);
	$string = str_replace("ñ","Ñ",$string);
	return $string;
}

//**********************************************************************************
// Fun��o padroniza a codifica��o
//**********************************************************************************
function tamanhoImg($imagem) {
	$imgsize = GetImageSize("$imagem");
	$img_w   = $imgsize[0];
	
	if ($img_w >= 220)
		$imgDest = 1;
	else
		$imgDest = 0;
	
	return $imgDest;
}


//**********************************************************************************
// Fun��o para retornar a data formatada - XX/XX/XXXX
//**********************************************************************************
function formatodata(&$datafor) {
  $datafor = substr($datafor,8,2)."/".substr($datafor,5,2)."/".substr($datafor,0,4);
  return $datafor;
}

//**********************************************************************************
// Fun��o para retornar a data para banco de dados - XXXX-XX-XX
//**********************************************************************************
function formatoDataBD(&$datafor) {
  $datafor = substr($datafor,6,4)."-".substr($datafor,3,2)."-".substr($datafor,0,2);
  return $datafor;
}

//**********************************************************************************
// Fun��o para retornar a hora formatada - XX:XX
//**********************************************************************************
function formatohora(&$horafor) {
  $horafor = substr($horafor,0,5);
  return $horafor;
}


function str_encode ($string,$to="iso-8859-9",$from="utf8") {
	if($to=="iso-8859-9" && $from=="utf8"){
		$str_array = array(
			chr(196).chr(177) => chr(253),
			chr(196).chr(176) => chr(221),
			chr(195).chr(182) => chr(246),
			chr(195).chr(150) => chr(214),
			chr(195).chr(167) => chr(231),
			chr(195).chr(135) => chr(199),
			chr(197).chr(159) => chr(254),
			chr(197).chr(158) => chr(222),
			chr(196).chr(159) => chr(240),
			chr(196).chr(158) => chr(208),
			chr(195).chr(188) => chr(252),
			chr(195).chr(156) => chr(220),
			chr(195).chr(163) => chr(227),
			chr(195).chr(169) => chr(233),
			chr(195).chr(186) => chr(250),
			chr(195).chr(179) => chr(243),
			chr(195).chr(129) => chr(193),
			chr(195).chr(137) => chr(201),
			chr(195).chr(147) => chr(211),
			chr(195).chr(154) => chr(218),
			chr(195).chr(130) => chr(194),
			chr(195).chr(138) => chr(202),
			chr(195).chr(142) => chr(206),
			chr(195).chr(148) => chr(212),
			chr(195).chr(155) => chr(219),
			chr(195).chr(128) => chr(192),
			chr(195).chr(136) => chr(200),
			chr(195).chr(140) => chr(204),
			chr(195).chr(146) => chr(210),
			chr(195).chr(153) => chr(217),
			chr(195).chr(131) => chr(195),
			chr(195).chr(149) => chr(213),
			chr(195).chr(145) => chr(209),
			chr(195).chr(161) => chr(225),
			chr(195).chr(173) => chr(237),
			chr(195).chr(162) => chr(226),
			chr(195).chr(170) => chr(234),
			chr(195).chr(174) => chr(238),
			chr(195).chr(180) => chr(244),
			chr(195).chr(187) => chr(251),
			chr(195).chr(168) => chr(232),
			chr(195).chr(172) => chr(236),
			chr(195).chr(178) => chr(242),
			chr(195).chr(185) => chr(249),
			chr(195).chr(181) => chr(245),
			chr(195).chr(177) => chr(241),
			chr(194).chr(186) => chr(186)
		);
		return str_replace(array_keys($str_array), array_values($str_array), $string);
	
	}   
	return $string;
}




function formartarNumero($valor) {
		
        $valor = str_replace(",",".",$valor);

        $sufixo=strstr($valor,".");
        $sufixo=str_replace(".","",$sufixo);

    if(strlen($sufixo)==0){
         $valor=$valor.'.00';
        }else if(strlen($sufixo)==1){
         $valor=$valor.'0';
        }
        return $valor;
}
	
function convertCpfBdCpfForm($cpf){

        $cpf1=substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,9);

        $cpf=$cpf1;		
        return $cpf;
}
	
function convertCpfFormCpfBd($cpf){

        $cpf=str_replace(".","",$cpf);
        $cpf=str_replace("-","",$cpf);

        return $cpf;
}
	
function convertDataBdDataForm($data){

        $data=explode("-",$data);
        $data=$data[2]."/".$data[1]."/".$data[0];

        return $data;
}
	
function convertDataFormDataBd($data){

        $data=explode("/",$data);
        $data=$data[2]."-".$data[1]."-".$data[0];

        return $data;
}
	
function gerarandonstring($caracteres){	
    $string = "abcdefghijklmnopqrstuvxyz";
    $senha = "";        
        for($indice = 0;$indice < $caracteres;$indice++){                
            $rand = rand(0,12);                
            $senha .= substr($string,$rand,1);
        }
    return $senha;
}

function uploadiarArquivo($arquivo,$dest) {

    $arrayMensgamgem=array();

    if ($arquivo == "" || $arquivo == " ") {
        echo 'Arquivo em branco';
        return false;
    } else {
        //upload da foto
        $Destino = $dest;
        $Videos = $arquivo;
        $Conta = 0;

        for ($i = 0; $i < sizeof($Videos); $i++) {

            $Nome = $Videos['name'][$i];
            $Tamanho = $Videos['size'][$i];
            $Tipo = $Videos['type'][$i];
            $Tmpname = $Videos['tmp_name'][$i];

            if ($Tamanho > 0 && strlen($Nome) > 1) {
                    $Nome = str_replace(" ", "", $Nome);
                    $Caminho = $Destino . $Nome;

                    while(file_exists($Caminho)==true){
                        $string=$this->gerarandonstring(4);
                        $Nome=$string.$Nome;
                        $Caminho = $Destino . $Nome;
                    }	

                    if (move_uploaded_file($Tmpname, $Caminho)) {
                        return $Caminho;
                        $Conta++;
                    } else {			
                        echo 'Erro ao mover o arquivo';				
                        return false;
                    }

            } else {
                echo 'Erro no loop do arquivo';							
                return false;
            }
        }

    }

}
	
function infomativo($mensagem){

        echo '<div>'.
                '<table width="100%" border="0" bgcolor=#F5F5F5  height="60">'.
                    '<td width="100%" align=left     height="100%">';
        
            echo '<font face=verdana size=2 color=#000099>Atenção: </font>'.
                 '<font face=verdana size=2 color=#333300>'.$mensagem.'<font>';

                echo '</td>'.
                 '</table>'.
             '</div>';

}
	
function mostrarAviso($s_aviso,$s_erro,$id){
    if ($s_aviso == "erro") {

    echo '<p class="msgerro" align="left">ERRO(S):';

    # TABELA DE ERROS ----------------------------------------------- #
    $tamanho=count($s_erro);
    $indice=0;
        echo '<br>';
    while($indice<$tamanho){

        echo $s_erro[$indice]."<br>";

        $indice++;
    }            

    # TABELA DE ERROS ----------------------------------------------- #

    echo '</p>';

    } elseif (($s_aviso == "ok") and ($id == "")) {

    echo '<p class="msgok" align="center" style="height: 30px;">O cadastro foi realizado com sucesso!</p>';

    } elseif (($s_aviso == "ok") and ($id != "")) {

    echo '<p class="msgok" align="center" style="height: 30px;">Os dados foram alterados com sucesso!</p>';

    }
}

	
function retira_acentos( $texto ){ 
    $array1 = array(   "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" 
                       , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); 
    $array2 = array(   "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" 
                       , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); 
    return str_replace( $array1, $array2, $texto ); 
}
        
function verificaDadosAjax($data) {
        $data = strip_tags($data);
        $data = trim($data);
        $data = get_magic_quotes_gpc() == 0 ? addslashes($data) : $data;
        $data = preg_replace("@(--|\#|\*|;)@s", "", $data);
        $data = urldecode($data);   // espec�fico no caso do Ajax
        $data = utf8_decode($data); // espec�fico no caso do Ajax
        return $data;
}

function ValidaData($dat){
        $data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como refer�ncia
        $d = $data[0];
        $m = $data[1];
        $y = $data[2];

        // verifica se a data � v�lida!
        // 1 = true (v�lida)
        // 0 = false (inv�lida)
        $res = checkdate($m,$d,$y);
        if ($res == 1){
           return true;
        } else {
           return false;
        }
}
	
	
function checaCPF($cpf){
    $cpf = ereg_replace("[^0-9]", "", $cpf); 
    if (strlen($cpf)!=11) 
            return false; 
    else { 
            $dv = substr($cpf,-2); 
            $compdv = 0; 
            $nulos = array("12345678909","11111111111","22222222222","33333333333","44444444444","55555555555","66666666666","77777777777","88888888888","99999999999","00000000000");    

            if(in_array($cpf, $nulos)) 
                    return false;  
            else {  
                    $acum=0;  
                    for ($i=0; $i<9; $i++) 
                            $acum+=$cpf[$i]*(10-$i); 
                    $x=$acum % 11; 
                    $acum = ($x>1) ? (11 - $x) : 0; 
                    $compdv = $acum * 10; 

                    $acum=0; 
                    for ($i=0; $i<10; $i++) 
                            $acum+=$cpf[$i]*(11-$i);  
                    $x=$acum % 11; 
                    $acum = ($x>1) ? (11 - $x) : 0; 
                    $compdv = $compdv + $acum; 

                    if($compdv == $dv) 
                            return true; 
                    else 
                            return false; 
            }  
    }
}

function mensagem($mensagemValor){
        echo '<script language="Javascript">				
                    alert("'.$mensagemValor.'");				
              </script>';
}

function voltarPaginaLink($caminhoDaPagina) {
        echo '<center><a href=' . $caminhoDaPagina . '><img src="../../design/botao/voltar.png" border="0" /></a></center>';

}

function voltarPagina($caminhoDaPagina) {

    echo "<script language=\"JavaScript\">
                function redireciona() {
                    window.location=\"$caminhoDaPagina\";
                }
                redireciona();
          </script>";

}

// Verificar campos selecionados
function camposSelecionados($valor){
    if ($valor == "XXXXX")
        return true;
    else
        return false;
}

// Verificar campos vazios
function camposVazios($valor){
    if (($valor == "") or ($valor == null))
            return true;
    else
            return false;
}

// Verificar se sóo números
function soNumeros($valor){
    if ((strpos($valor, '.') == "") or (strpos($valor, '.') == 0) or (strpos($valor, '.') == false))
            if(is_numeric($valor))
                    return true;
            else
                    return false;
    else
            return false;
}

// Validar número de caracteres
function numCaracteres($tamanho, $campo){
    if (strlen($campo) == $tamanho){
        return true;
    } else {
        return false;
    }
}

// Função que válida o e-mail
function verificaEmail($email){
    if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
        return true;
    } else {
        return false;
    }
}

// Função que válida o CPF
function verificaCPF($cpf){ 
        for( $i = 0; $i < 10; $i++ ){ 
            if ( $cpf ==  str_repeat( $i , 11) or !preg_match("@^[0-9]{11}$@", $cpf ) or $cpf == "12345678909" )
        return false;                
                
        if ( $i < 9 )
        $soma[]  = $cpf{$i} * ( 10 - $i ); 
                
            $soma2[] = $cpf{$i} * ( 11 - $i );                       
        } 
        
        if(((array_sum($soma)% 11) < 2 ? 0 : 11 - ( array_sum($soma)  % 11 )) != $cpf{9})
        return false; 
        
        return ((( array_sum($soma2)% 11 ) < 2 ? 0 : 11 - ( array_sum($soma2) % 11 )) != $cpf{10}) ? false : true; 
}

// Função que válida o CNPJ
function verificaCNPJ( $cnpj ) {
    if( strlen( $cnpj ) <> 14 or !is_numeric( $cnpj ) ){
        return false;
    }
 
    $k = 6;
    $soma1 = "";
    $soma2 = "";
 
    for( $i = 0; $i < 13; $i++ ){
        $k = $k == 1 ? 9 : $k;
        $soma2 += ( $cnpj{$i} * $k );
        $k--;

        if($i < 12) {
            if($k == 1) {
                $k = 9;
                $soma1 += ( $cnpj{$i} * $k );
                $k = 1;
            } else {
                $soma1 += ( $cnpj{$i} * $k );
            }
        }
    }

    $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
    $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

    return ( $cnpj{12} == $digito1 and $cnpj{13} == $digito2 );
}

// Função que válida a Data
function verificaData($data){
    if ($data != "") {
        $dataTeste = explode("/",$data);
    if(checkdate($dataTeste[1], $dataTeste[0], $dataTeste[2]))
        return true;
    else
        return false;
    } else {
        return false;
    }
}



?>