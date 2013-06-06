function validarAcesso() {

	var email = document.getElementById('email').value;
	var senha = document.getElementById('senha').value;

	if (email == ""){
		alert ("Informe o e-mail!");
		document.getElementById('email').focus();
		return false;
	}

	if (senha == ""){
		alert ("Informe a senha!");
		document.getElementById('senha').focus();
		return false;
	}

	var testaAcesso = confirm("Deseja entrar no sistema?");

	if(testaAcesso)
		return true;
	else
		return false;

}

function validarLembrarSenha() {

	var email = document.getElementById('email').value;

	if ((email == null)||(email == "")){
		alert("Informe o e-mail!")
		document.getElementById('email').focus();
		return false;
	}
	
	if (validaEmail(email) == false){
		alert("E-mail inválido!")
		document.getElementById('email').focus();
		return false;
	}
	
}