function validarUsuario() {
	
	var testarValidacao;
	
	var botaoAcao        = document.getElementById('botaoAcao').value;
	var nome             = document.getElementById('nome').value;
	var email            = document.getElementById('email').value;
	var senha            = document.getElementById('senha').value;
	var id_usuario_nivel = document.getElementById('id_usuario_nivel').value;
	
	if (nome == ""){
		alert ("Informe o nome!");
		document.getElementById('nome').focus();
		return false;
	}
	
	if ((email == null)||(email == "")){
		alert("Informe o e-mail!")
		document.getElementById('email').focus();
		return false;
	}
	
	if (validaEmail(email) == false){
		document.getElementById('email').focus();
		return false;
	}
	
	if (senha == ""){
		alert ("Informe a senha!");
		document.getElementById('senha').focus();
		return false;
	}
	
	if (id_usuario_nivel == "XXXXX"){
		alert ("Selecione o nível!");
		document.getElementById('nome').focus();
		return false;
	}
	
	if (trim(botaoAcao) == "Cadastrar")
		testarValidacao = confirm("Deseja confirmar o cadastro?");
	else
		if (trim(botaoAcao) == "Alterar")
			testarValidacao = confirm("Deseja confirmar a alteração dos dados?");

	if(testarValidacao)
		return true;
	else
		return false;
}

function excluirUsuario(){
	var id_usuario = document.formUsuario.id_usuario.value;
	var testarExcluir  = confirm("Deseja confirmar a exclusão?");

	if(testarExcluir)
		location.href = "index.php?area=" + encode64("seguranca/usuario/usuario_exe.php") + "&id_usuario=" + id_usuario + "&botaoAcao=Excluir";
		
}