/*
function include(file_path){
	var j = document.createElement("script");
	j.type = "text/javascript";
	j.src = file_path;
	document.body.appendChild(j);
}

include("js_funcoes_diversas.js");
*/

function validarAlterarSenha() {
	
	var testarValidacao;
	
	var senha_atual        = document.getElementById('senha_atual').value;
	var senha_nova         = document.getElementById('senha_nova').value;
	var senha_nova_repetir = document.getElementById('senha_nova_repetir').value;
	
	if (senha_atual == ""){
		alert ("Informe sua senha atual!");
		document.getElementById('senha_atual').focus();
		return false;
	}
	
	if (senha_nova == ""){
		alert ("Informe a nova senha!");
		document.getElementById('senha_nova').focus();
		return false;
	}
	
	if (senha_nova_repetir == ""){
		alert ("Repita a nova senha!");
		document.getElementById('senha_nova_repetir').focus();
		return false;
	}
	
	if (senha_nova != senha_nova_repetir){
		alert ("Repida a nova senha igual ao campo acima!");
		document.getElementById('senha_nova_repetir').focus();
		return false;
	}
	
	testarValidacao = confirm("Deseja confirmar a alteração dos dados?");

	if(testarValidacao)
		return true;
	else
		return false;
}