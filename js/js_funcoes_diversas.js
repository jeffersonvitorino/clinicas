// Funções para limpar caracteres em branco (TRIM)
function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

// Áreas restritas
function mostrarDiv(quem){
	document.getElementById(quem).style.display = "";
}

function esconderDiv(quem){
	document.getElementById(quem).style.display = "none";
}

function ativarAreaRestrita(quem){
	document.getElementById(quem).style.backgroundColor = "F4751B";
	document.getElementById(quem).style.color = "FFFFFF";
}

function desativarAreaRestrita(quem){
	document.getElementById(quem).style.backgroundColor = "";
	document.getElementById(quem).style.color = "D36719";
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

// Jumpmenu
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

// Show and Hide Layers
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

// Inicio da Função Auto Tab
var isNN = (navigator.appName.indexOf("Netscape")!=-1);

function autoTab(input,len, e) {
	var keyCode = (isNN) ? e.which : e.keyCode; 
	var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
	
	if(input.value.length >= len && !containsElement(filter,keyCode)) {
		input.value = input.value.slice(0, len);
		input.form[(getIndex(input)+1) % input.form.length].focus();
}

function containsElement(arr, ele) {
	var found = false, index = 0;
	
	while(!found && index < arr.length)
		if(arr[index] == ele)
			found = true;
		else
			index++;
	
	return found;
}

function getIndex(input) {
	var index = -1, i = 0, found = false;
	
	while (i < input.form.length && index == -1)
		if (input.form[i] == input)
			index = i;
		else i++;
			return index;
	}
	
	return true;
}

// Valida E-mail
function validaEmail(str) {
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	
	if (str.indexOf(at)==-1){
	   return false
	}
	
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   return false
	}
	
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		return false
	}
	
	 if (str.indexOf(at,(lat+1))!=-1){
		return false
	 }
	
	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		return false
	 }
	
	 if (str.indexOf(dot,(lat+2))==-1){
		return false
	 }
	
	 if (str.indexOf(" ")!=-1){
		return false
	 }
	
	 return true					
}

// VALIDA E FORMATA DATA //
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

// FORMATA HORA
function mascara_hora(campo,hora){

	if (hora.length == 2){ 
		hora = hora + ':';
	}
	
	if (hora.length == 5){ 
		hora = hora + ':';
	}
	
	document.getElementById(campo).value = hora;
} 

function verifica_hora(valor){ 
	hora       = (valor.substring(0,2));
	minuto     = (valor.substring(3,5));
	segundo    = (valor.substring(6,8));
	separador1 = (valor.substring(2,3));
	separador2 = (valor.substring(5,6));
	
	if (isNaN(hora) == true){ 
		return false;
	}
	
	if (isNaN(minuto) == true){ 
		return false;
	}
	
	if (isNaN(segundo) == true){ 
		return false;
	}
	
	if ((hora < 00 ) || (hora > 23)){ 
		return false;
	}
	
	if (( minuto < 00) ||( minuto > 59)){ 
		return false;
	}
	
	if (( segundo < 00) ||( segundo > 59)){ 
		return false;
	}
	
	if (separador1 != ":"){ 
		return false;
	}
	
	if (separador2 != ":"){ 
		return false;
	}
}

// VALIDAR HORA
function validar_hora(hora){	
	if (hora == ""){ 
		return false;
	}
	
	if (isNaN(hora) == true){ 
		return false;
	}
	
	if ((hora < 00 ) || (hora > 23)){ 
		return false;
	}
}

function validar_minuto(minuto){	
	if (minuto == ""){ 
		return false;
	}
	
	if (isNaN(minuto) == true){ 
		return false;
	}
	
	if ((minuto < 00 ) || (minuto > 59)){ 
		return false;
	}
}

// VALIDAR CRIPTOGRAFAR
var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf(" chrome/") >= 0 || ua.indexOf(" firefox/") >= 0 || ua.indexOf(' gecko/') >= 0) {
	var StringMaker = function () {
		this.str = "";
		this.length = 0;
		this.append = function (s) {
			this.str += s;
			this.length += s.length;
		}
		this.prepend = function (s) {
			this.str = s + this.str;
			this.length += s.length;
		}
		this.toString = function () {
			return this.str;
		}
	}
} else {
	var StringMaker = function () {
		this.parts = [];
		this.length = 0;
		this.append = function (s) {
			this.parts.push(s);
			this.length += s.length;
		}
		this.prepend = function (s) {
			this.parts.unshift(s);
			this.length += s.length;
		}
		this.toString = function () {
			return this.parts.join('');
		}
	}
}

function encode64(input) {
	var output = new StringMaker();
	var chr1, chr2, chr3;
	var enc1, enc2, enc3, enc4;
	var i = 0;

	while (i < input.length) {
		chr1 = input.charCodeAt(i++);
		chr2 = input.charCodeAt(i++);
		chr3 = input.charCodeAt(i++);

		enc1 = chr1 >> 2;
		enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
		enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
		enc4 = chr3 & 63;

		if (isNaN(chr2)) {
			enc3 = enc4 = 64;
		} else if (isNaN(chr3)) {
			enc4 = 64;
		}

		output.append(keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4));
   }
   
   return output.toString();
}

// VALIDAR DESCRIPTOGRAFAR
function decode64(input) {
	var output = new StringMaker();
	var chr1, chr2, chr3;
	var enc1, enc2, enc3, enc4;
	var i = 0;

	// remove all characters that are not A-Z, a-z, 0-9, +, /, or =
	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	while (i < input.length) {
		enc1 = keyStr.indexOf(input.charAt(i++));
		enc2 = keyStr.indexOf(input.charAt(i++));
		enc3 = keyStr.indexOf(input.charAt(i++));
		enc4 = keyStr.indexOf(input.charAt(i++));

		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;

		output.append(String.fromCharCode(chr1));

		if (enc3 != 64) {
			output.append(String.fromCharCode(chr2));
		}
		if (enc4 != 64) {
			output.append(String.fromCharCode(chr3));
		}
	}

	return output.toString();
}

// FORMATAR VALOR
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}