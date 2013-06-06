function validarLocal() {
	
	var testarValidacao;
	
	var botaoAcao        = document.getElementById('botaoAcao').value;
	var nome             = document.getElementById('nome').value;
	var qnt            = document.getElementById('qnt').value;
	
	
	if (nome == ""){
		alert ("Informe o nome!");
		document.getElementById('nome').focus();
		return false;
	}
	
	if ((qnt <= 0)||(qnt == "")){
		alert("Informe a quantidade de pessoas!")
		document.getElementById('qnt').focus();
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
	var id_local = document.formLocal.id_local.value;
	var testarExcluir  = confirm("Deseja confirmar a exclusão?");

	if(testarExcluir)
		location.href = "index.php?area=" + encode64("local/localEventoLst.php");
		
}

