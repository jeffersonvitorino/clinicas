// Função para Adicionar os campos de experiencia profissional
var n_ExpProfissional = 0;

function addExpProfissional() {
	var DivExpProfissional = document.getElementById('ExpProfissionalDiv');

	var DivNovoExpProfissional = document.createElement('div');
		DivNovoExpProfissional.setAttribute("id","DivExpProfissional"+n_ExpProfissional);
		DivNovoExpProfissional.innerHTML = '<p>_____________________________________________________<br /><br />Nome da Empresa:* <br /><input type="text" class="frmCampoTexto" name="exp_empresa_tbconosco1['+n_ExpProfissional+']" id="exp_empresa_tbconosco1['+n_ExpProfissional+']" size="55" maxlegth="250" /><br /><br />Per&iacute;do que Trabalhou na Empresa:<br /><br />Data entrada:*<br /><input type="text" class="frmCampoTexto" name="exp_periodo_i_tbconosco1['+n_ExpProfissional+']" id="exp_periodo_i_tbconosco1['+n_ExpProfissional+']" size="15" maxlegth="20" />&nbsp;<b>Formato: dia/m&ecirc;s/ano</b><br /><br />Data sa&iacute;da:<br /><input type="text" class="frmCampoTexto" name="exp_periodo_s_tbconosco1['+n_ExpProfissional+']" id="exp_periodo_s_tbconosco1['+n_ExpProfissional+']" size="15" maxlegth="20" />&nbsp;<b>Formato: dia/m&ecirc;s/ano</b><br /><br />Cargo Ocupado:*<br /><input type="text" class="frmCampoTexto" name="exp_cargo_tbconosco1['+n_ExpProfissional+']" id="exp_cargo_tbconosco1['+n_ExpProfissional+']" size="55" maxlegth="250" /><br /><br />Breve Descri&ccedil;&atilde;o de Atividades:*<br /><textarea class="frmCampoTexto" name="exp_desc_tbconosco1['+n_ExpProfissional+']" id="exp_desc_tbconosco1['+n_ExpProfissional+']" cols="40" rows="5" /></textarea><br /><br />Nome Contato:*<br /><input type="text" class="frmCampoTexto" name="exp_contato_tbconosco1['+n_ExpProfissional+']" id="exp_contato_tbconosco1['+n_ExpProfissional+']" size="55" maxlegth="250" /><br /><br />Telefone Contato:*<br /><input type="text" class="frmCampoTexto" name="exp_tel_tbconosco1['+n_ExpProfissional+']" id="exp_tel_tbconosco1['+n_ExpProfissional+']" size="25" maxlegth="10" />&nbsp;<b>Apenas números</b><br /><br /><h2><input type="button" value="X" onClick="delExpProfissional(\'DivExpProfissional'+n_ExpProfissional+'\')" class="FrmBotao"> Excluir</h2><br /></p>';

	DivExpProfissional.appendChild(DivNovoExpProfissional);

	n_ExpProfissional++;
}

// Função para Remover os campos de experiencia profissional
function delExpProfissional(divNum){
	var d      = document.getElementById('ExpProfissionalDiv');
	var olddiv = document.getElementById(divNum);

	d.removeChild(olddiv);
}


// Conteúdo
function mostrarConteudo(quem){
	if (document.getElementById(quem).style.display == "")
		document.getElementById(quem).style.display = "none";
	else
		document.getElementById(quem).style.display = "";		
}

// Abre Pop Up
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

// Vai para a URL
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

// Valida E-mail
function validaEmail(str) {
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	
	if (str.indexOf(at)==-1){
	   alert("Email invalido!")
	   return false
	}
	
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   alert("Email invalido!")
	   return false
	}
	
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Email invalido!")
		return false
	}
	
	 if (str.indexOf(at,(lat+1))!=-1){
		alert("Email invalido!")
		return false
	 }
	
	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Email invalido!")
		return false
	 }
	
	 if (str.indexOf(dot,(lat+2))==-1){
		alert("Email invalido!")
		return false
	 }
	
	 if (str.indexOf(" ")!=-1){
		alert("Email invalido!")
		return false
	 }
	
	 return true					
}

// Função para Adicionar Campo para Foto
var n_Foto = 0;

function addFoto() {
	var DivFoto = document.getElementById('FotoDiv');

	var DivNovoFoto = document.createElement('div');
		DivNovoFoto.setAttribute("id","DivFoto"+n_Foto);
		DivNovoFoto.innerHTML = '<p>Foto:* <input type="file" class="frmCampoTexto" name="foto['+n_Foto+']" id="foto['+n_Foto+']" /> | Legenda: <input name="legenda['+n_Foto+']" type="text" class="frmCampoTexto" id="legenda['+n_Foto+']" size="30" /> | <input type="button" value="X" onClick="delFoto(\'DivFoto'+n_Foto+'\')" class="frmBotao"></p>';

	DivFoto.appendChild(DivNovoFoto);

	n_Foto++;
}

// Função para Remover Campo para Foto
function delFoto(divNum){
	var d      = document.getElementById('FotoDiv');
	var olddiv = document.getElementById(divNum);

	d.removeChild(olddiv);
}

// Função para Adicionar Campo para Arquivo
var n_Arquivo = 0;

function addArquivo() {
	var DivArquivo = document.getElementById('ArquivoDiv');

	var DivNovoArquivo = document.createElement('div');
		DivNovoArquivo.setAttribute("id","DivArquivo"+n_Arquivo);
		DivNovoArquivo.innerHTML = '<p>Arquivo:* <input type="file" class="frmCampoTexto" name="arquivo['+n_Arquivo+']" id="arquivo['+n_Arquivo+']" /> | Nome:* <input name="descricao['+n_Arquivo+']" type="text" class="frmCampoTexto" id="descricao['+n_Arquivo+']" size="30" /> | <input type="button" value="X" onClick="delArquivo(\'DivArquivo'+n_Arquivo+'\')" class="frmBotao"></p>';

	DivArquivo.appendChild(DivNovoArquivo);

	n_Arquivo++;
}

// Função para Remover Campo para Arquivo
function delArquivo(divNum){
	var d      = document.getElementById('ArquivoDiv');
	var olddiv = document.getElementById(divNum);

	d.removeChild(olddiv);
}

function formataData(campo){

	campo.value = filtraCampo(campo);
	vr          = campo.value;
	tam         = vr.length;

	if ( tam > 2 && tam < 5 )
		campo.value = vr.substr( 0, tam - 2  ) + '/' + vr.substr( tam - 2, tam );

	if ( tam >= 5 && tam <= 10 )
		campo.value = vr.substr( 0, 2 ) + '/' + vr.substr( 2, 2 ) + '/' + vr.substr( 4, 4 ); 
}

function filtraCampo(campo){

	var s  = "";
	var cp = "";

	vr  = campo.value;
	tam = vr.length;

	for (i = 0; i < tam ; i++) {  
		if (vr.substring(i,i + 1) != "/" && vr.substring(i,i + 1) != "-" && vr.substring(i,i + 1) != "."  && vr.substring(i,i + 1) != "," ){
		 	s = s + vr.substring(i,i + 1);}
	}

	campo.value = s;

	return cp = campo.value
}

// Valida uma DATA
function validaData(digData)
{
    var bissexto = 0;
    var data = digData;
    var tam = data.length;
    if (tam == 10)
    {
        var dia = data.substr(0,2)
        var mes = data.substr(3,2)
        var ano = data.substr(6,4)
        if ((ano > 1900)||(ano < 2100))
        {
            switch (mes)
            {
                case '01':
                case '03':
                case '05':
                case '07':
                case '08':
                case '10':
                case '12':
                    if  (dia <= 31)
                    {
                        return true;
                    }
                    break
                
                case '04':        
                case '06':
                case '09':
                case '11':
                    if  (dia <= 30)
                    {
                        return true;
                    }
                    break
                case '02':
                    /* Validando ano Bissexto / fevereiro / dia */
                    if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0))
                    {
                        bissexto = 1;
                    }
                    if ((bissexto == 1) && (dia <= 29))
                    {
                        return true;                
                    }
                    if ((bissexto != 1) && (dia <= 28))
                    {
                        return true;
                    }            
                    break                        
            }
        }
    }    
    return false;
}

// Função para validar CPF

function validarCPF(cpf){
       
   if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
	  cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
	  cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
	  cpf == "88888888888" || cpf == "99999999999"){
	  window.alert("CPF inválido. Tente novamente.");
	  return false;
   }

   soma = 0;
   for(i = 0; i < 9; i++)
   	 soma += parseInt(cpf.charAt(i)) * (10 - i);
   resto = 11 - (soma % 11);
   if(resto == 10 || resto == 11)
	 resto = 0;
   if(resto != parseInt(cpf.charAt(9))){
	 window.alert("CPF inválido. Tente novamente.");
	 return false;
   }
   soma = 0;
   for(i = 0; i < 10; i ++)
	 soma += parseInt(cpf.charAt(i)) * (11 - i);
   resto = 11 - (soma % 11);
   if(resto == 10 || resto == 11)
	 resto = 0;
   if(resto != parseInt(cpf.charAt(10))){
     window.alert("CPF inválido. Tente novamente.");
	 return false;
   }
 }

//função para para validar apenas numeros
function Apenas_Numeros(caracter)
{
  var nTecla = 0;
  if (document.all) {
      nTecla = caracter.keyCode;
  } else {
      nTecla = caracter.which;
  }
  if ((nTecla> 47 && nTecla <58)
  || nTecla == 8 || nTecla == 127
  || nTecla == 0 || nTecla == 9  // 0 == Tab
  || nTecla == 13) { // 13 == Enter
  } else {
      return false;
  }
}

