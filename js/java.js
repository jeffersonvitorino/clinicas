
function goToURL(ENDERECO){
	window.location=ENDERECO;
}

function horizontal() {
	 
	   var navItems = document.getElementById("menu_dropdown").getElementsByTagName("li");
	    
	   for (var i=0; i< navItems.length; i++) {
	      if(navItems[i].className == "submenu")
	      {
	         if(navItems[i].getElementsByTagName('ul')[0] != null)
	         {
	            navItems[i].onmouseover=function() {this.getElementsByTagName('ul')[0].style.display="block";this.style.backgroundColor = "#000000";}
	            navItems[i].onmouseout=function() {this.getElementsByTagName('ul')[0].style.display="none";this.style.backgroundColor = "#000000";}
	         }
	      }
	   }
	 
	}	

//GERAIS
function Trim(str){return str.replace(/^\s+|\s+$/g,"");}

//enquete

function ativarEnquete(){ 
	var i; 
	var RADIO=document.getElementsByName('enquete_ativa');
	var id_enquete=0;
	
	if(RADIO.length==0){
		alert("Escolha uma enquete!");
		return false;
	}	
	
	if(confirm('Deseja realmente ativar esta enquete?')==true){
		
		for (i=0;i<RADIO.length;i++){ 
			if (RADIO[i].checked) {
				id_enquete = RADIO[i].value;
				break; 
			}
		} 
		
		document.getElementById('id_enquete_ativar').value=id_enquete;
		
		return true;
	}else{
		return false;	
	}
} 


function listaPergunta(ENQUETE) {
	$.ajax(
		{
			type: "POST",
			url: "enquete/enqueteListar.php",
			data: "enquete="+ENQUETE,
			beforeSend: function() {},
			success: function(txt) {
				$('#divExibirEnquete').html(txt);
			},
			error: function(txt) {
			}
		}
	);
}

function formItemResposta(){

	var qtd_resposta_enquete = document.getElementById('qtd_resposta_enquete').value;
	
	document.getElementById('qtd_resposta_enquete').value= parseInt(qtd_resposta_enquete) + 1;	
	
	var qtd_atual=document.getElementById('qtd_resposta_enquete').value;	
	
	jQuery('#div_resposta').append('<div id="div_resposta_'+qtd_atual+'" ><p>Resposta adicional:* <br /><input name="resposta'+qtd_atual+'_enquete" type="text" id="resposta'+qtd_atual+'_enquete" class="frmCampoTexto" value="" size="45" maxlength="100" > <input name="excluir_resposta'+qtd_atual+'_enquete" id="excluir_resposta'+qtd_atual+'_enquete" type="button" class="frmBotao" value=" X " onclick="excluirFormItemResposta('+qtd_atual+');" /></p></div>');

}

function excluirFormItemResposta(ID){
	jQuery('#resposta'+ID+'_enquete').remove();
	jQuery('#excluir_resposta'+ID+'_enquete').remove();
	jQuery('#div_resposta_'+ID).remove();
}

function testaEnquete() {
	
	var pergunta_enquete  	 = document.getElementById('pergunta_enquete').value;
	var qtd_itens=document.getElementById('qtd_resposta_enquete').value;	
	var indice=1;
	
	while(indice<=qtd_itens){
		
		var resposta_enquete = document.getElementById('resposta'+indice+'_enquete').value;
		
		if (resposta_enquete == ""){
			
			if(indice==1||indice==2){
				alert ('Digite a resposta '+indice+'!');
			}else{
				alert ('Digite a resposta adicinoal!');
			}
			
			document.getElementById('resposta'+indice+'_enquete').focus();
			return false;
		}
		
		indice=indice+1;
	}	
	
	if (pergunta_enquete == ""){
		alert ("Digite uma pergunta!");
		document.getElementById('pergunta_enquete').focus();
		return false;
	}

	
	var testaAdm = confirm("Confirma o cadastro?");

	if(testaAdm){
		return true;
	}else{
		return false;
	}
}

//classificados

function testaClassificados() {
	var valido=true;			
	var arrayErros = new Array();
	
	var id_associado = document.getElementById('id_associado').value;
	var id_categoria = document.getElementById('id_categoria').value;
	var titulo = document.getElementById('titulo').value;
	var texto = document.getElementById('texto').value;
	
	
	if (id_associado == ""){
		valido=false;
		arrayErros.push("Escolha um associado!");
	}

	if (id_categoria == ""){
		valido=false;
		arrayErros.push("Escolha uma categoria!");
	}
	
	titulo=Trim(titulo);
	if (titulo == ""){
		valido=false;
		arrayErros.push("Campo titulo em branco!");
	}
	
	texto=Trim(texto);
	if (texto == ""){
		valido=false;
		arrayErros.push("Campo texto em branco!");
	}
	
	
	if(valido==true){
		return confirm("Confirma o cadastro?");
    }else{
    	window.alert(arrayErros.join(" \n "));
    	return false;
    }
	
}


function listaClassificados(ID_ASSOCIADO) {
	$.ajax(
		{
			type: "POST",
			url: "classificados/classificadoListar.php",
			data: "id_associado="+ID_ASSOCIADO,
			beforeSend: function() {},
			success: function(txt) {
				$('#divExibirClassificado').html(txt);
			},
			error: function(txt) {
			}
		}
	);
}


//CATEGORIA

function testaCategoria() {
	var valido=true;			
	var arrayErros = new Array();
	
	var nome = document.getElementById('nome').value;
	
	if (nome == ""){
		valido=false;
		arrayErros.push("Digite o nome!");
	}
	
	if(valido==true){
		return confirm("Confirma o cadastro?");
    }else{
    	window.alert(arrayErros.join(" \n "));
    	return false;
    }
	
}

