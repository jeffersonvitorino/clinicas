// Função para Adicionar Campo para Foto
var n_Foto = 0;

function addFoto() {
	var DivFoto = document.getElementById('FotoDiv');

	var DivNovoFoto = document.createElement('div');
		DivNovoFoto.setAttribute("id","DivFoto"+n_Foto);
		DivNovoFoto.innerHTML = '<p style="padding: 3px; border: 1px dashed #333; background-color: #ececec;">Foto:* <input type="file" class="frmCampoTexto" name="foto['+n_Foto+']" id="foto['+n_Foto+']" width="300" /> <br /> Legenda: <input name="legenda['+n_Foto+']" type="text" class="frmCampoTexto" id="legenda['+n_Foto+']" width="300" />  <input type="button" value="X" onClick="delFoto(\'DivFoto'+n_Foto+'\')" class="frmBotao"></p>';

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
		DivNovoArquivo.innerHTML = '<p style="padding: 3px; border: 1px dashed #333; background-color: #ececec;">Arquivo:* <input type="file" class="frmCampoTexto" name="arquivo['+n_Arquivo+']" id="arquivo['+n_Arquivo+']" width="300" /> <br /> Nome:* <input name="descricao['+n_Arquivo+']" type="text" class="frmCampoTexto" id="descricao['+n_Arquivo+']" width="300" /> <input type="button" value="X" onClick="delArquivo(\'DivArquivo'+n_Arquivo+'\')" class="frmBotao"></p>';

	DivArquivo.appendChild(DivNovoArquivo);

	n_Arquivo++;
}

// Função para Remover Campo para Arquivo
function delArquivo(divNum){
	var d      = document.getElementById('ArquivoDiv');
	var olddiv = document.getElementById(divNum);

	d.removeChild(olddiv);
}