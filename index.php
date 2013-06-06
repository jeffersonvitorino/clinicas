<?php
$area = $_REQUEST["area"];

if (($area == "") or ($area == "home")) {
	$exibir_pagina = 'frontEnd/home.php';
	$titulo = 'F&oacute;rum do Consumidor | Home';
} elseif ($area == "quem_somos") {
	$exibir_pagina = 'frontEnd/quem_somos.php';
	$titulo = 'F&oacute;rum do Consumidor | Quem somos';
} elseif ($area == "principios_eticos") {
	$exibir_pagina = 'frontEnd/principios_eticos.php';
	$titulo = 'F&oacute;rum do Consumidor | Princ&iacute;pios &Eacute;ticos';
} elseif ($area == "entidades_filiadas") {
	$exibir_pagina = 'modulos/entidade/frontEnd/lst_entidade.php';
	$titulo = 'F&oacute;rum do Consumidor | Entidades Filiadas';
} else if($area == "entidade_exb"){
        $exibir_pagina = 'modulos/entidade/frontEnd/entidade_exb.php';
	$titulo = 'F&oacute;rum do Consumidor | Entidades Filiadas';
} elseif ($area == "como_se_filiar") {
	$exibir_pagina = 'frontEnd/como_se_filiar.php';
	$titulo = 'F&oacute;rum do Consumidor | Como se Filiar';
} elseif ($area == "noticias_lst") {
	$exibir_pagina = 'modulos/noticia/frontEnd/noticias_lst.php';
	$titulo = 'F&oacute;rum do Consumidor | Not&iacute;cias - Lista';
} elseif ($area == "noticias_exb") {
	$exibir_pagina = 'modulos/noticia/frontEnd/noticias_exb.php';
	$titulo = 'F&oacute;rum do Consumidor | Not&iacute;cias - Detalhe';              
} elseif ($area == "galeria_de_imagens") {
	$exibir_pagina = 'modulos/galeriaFotos/frontEnd/list_galeria_de_imagens.php';
	$titulo = 'F&oacute;rum do Consumidor | Galeria de Imagens';    
} elseif ($area == "galeria_fotos_exb") {
	$exibir_pagina = 'modulos/galeriaFotos/frontEnd/galeria_fotos_exb.php';
	$titulo = 'F&oacute;rum do Consumidor | Galeria de Imagens';      
} elseif ($area == "colunas") {
	$exibir_pagina = 'frontEnd/colunas.php';
	$titulo = 'F&oacute;rum do Consumidor | Colunas';
} elseif ($area == "contato") {
	$exibir_pagina = 'modulos/contato/frontEnd/contato_frm.php';
	$titulo = 'F&oacute;rum do Consumidor | Contato';
} elseif ($area == "newsLetter") {
	$exibir_pagina = 'modulos/newsLetter/frontEnd/cadastro_frm.php';
	$titulo = 'F&oacute;rum do Consumidor | NewsLetter';
} elseif ($area == "enquete_exb") {
        $exibir_pagina = 'modulos/enquete/frontEnd/enquete_exb.php';
        $titulo = 'F&oacute;rum do Consumidor | Enquete';
} elseif ($area == "enquete_exe") {
        $exibir_pagina = 'modulos/enquete/frontEnd/enquete_exe.php';
        $titulo = 'F&oacute;rum do Consumidor | Enquete';
} elseif ($area == "coluna_exb") {
        $exibir_pagina = 'modulos/coluna/frontEnd/coluna_exb.php';
        $titulo = 'F&oacute;rum do Consumidor | Coluna';
} elseif ($area == "coluna_lst") {  
        $exibir_pagina = 'modulos/coluna/frontEnd/coluna_lst.php';
        $titulo = 'F&oacute;rum do Consumidor | Coluna';
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $titulo; ?></title>
<link href="design/css/frontEnd.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.9.0.min.js"></script>
</head>

<body>

<div id="topo">
    <div id="topo_logo"></div>
    <div id="topo_img"></div>
</div>

<div id="conteudo">
	<div id="menu">
        <ul>
            <li><a href="?area=home">Home</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li>Sobre o F&oacute;rum
                <ul>
                    <li><a href="?area=quem_somos">Quem somos</a></li>
                    <li><a href="?area=principios_eticos">Princ&iacute;pios &Eacute;ticos</a></li>
                </ul>
            </li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=entidades_filiadas">Entidades Filiadas</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=como_se_filiar">Como se Filiar</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=noticias">Not&iacute;cias</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=galeria_de_imagens">Galeria de Imagens</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=colunas">Colunas</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=enquete_exb">Enquete</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=contato">Contato</a></li>
            <li><img src="design/layout/frontEnd/menu_linha.png" width="199" height="1" alt="Linha Divis&oacute;ria"></li>
            <li><a href="?area=newsLetter">Receber news letter</a></li>
        </ul>
    </div>

    <div id="conteudo_area">
        <?php @include($exibir_pagina); ?>
    </div>
</div>

<footer>
    <div id="rodape">
        <ul>
            <li><p>&copy; Copyright 2008, F&oacute;rum Nacional das Entidades Civis de Defesa do Consumidor
             <br />Rua do Riachuelo, 105, segundo andar, sala 219 | CEP: 50.050-913 | Recife | PE | Telefone: (81) 3034-6056</p></li>
            <li><a href="http://www.algconsultoria.com.br/" target="_blank" title="ALG Consultoria em TI"><img src="design/layout/frontEnd/logo_alg.png" width="80" height="80" alt="ALG Consultoria em TI" title="ALG Consultoria em TI"></a></li>
        </ul>
    </div>
</footer>

</body>
</html>