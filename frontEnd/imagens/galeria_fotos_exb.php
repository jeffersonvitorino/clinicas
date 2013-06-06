<?php
include_once('biblioteca/class_mysql.php');
include_once('biblioteca/funcoesDiversas.php');
include_once('modulos/galeriaFotos/biblioteca/class_bdGaleriaFoto.php');
include_once('modulos/galeriaFotos/biblioteca/class_bdGaleriaDeFoto.php');

$id_galeria = $_REQUEST["id_galeria"];
$palavra    = $_REQUEST["palavra"];
$pagina     = $_REQUEST["pagina"];


$acaoGaleriaDeFotos = new bdGaleriaDeFoto();

$exeConsultarGaleriaDeFoto = $acaoGaleriaDeFotos->consultarGaleriaDeFoto($id_galeria);
$infConsultarGaleriaDeFoto = mysql_fetch_assoc($exeConsultarGaleriaDeFoto);


?>

<script src="modulos/galeriaFotos/js/lightbox/js/jquery-1.7.2.min.js"></script>
<script src="modulos/galeriaFotos/js/lightbox/js/lightbox.js"></script>
<script src="js/funcoes.js"></script>


<link href="modulos/galeriaFotos/js/lightbox/css/lightbox.css" rel="stylesheet" />





<h1>Galeria de Imagem</h1>

<p><i>Publicado em: <?php echo formatodata($infConsultarGaleriaDeFoto["datacad_galeria"]);?></i></p>
<h2><?php echo $infConsultarGaleriaDeFoto["titulo_galeria"];?></h2>
<p><?php echo nl2br($infConsultarGaleriaDeFoto["descricao_galeria"]);?></p>

<table width="450" border="0" align="left" cellspacing="0">
<?php
$exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = $acaoGaleriaDeFotos->consultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto($id_galeria);
while ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
		if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
			$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
		else
			$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
  <tr>
    <td width="80">
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>    </td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_assoc($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>    </td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>    </td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>    </td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>
	</td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>
	</td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>
	</td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;" src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>
	</td>
    <td width="80">
<?php
if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto)) {
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
?>
    <a rel="lightbox[album]" href="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" rel="lightbox[<?php echo $infConsultarGaleriaDeFoto["id_galeria"];?>]" title="<?php echo $legenda;?>">
    <img style="border: 2px solid #CCCCCC; padding: 1px; margin: 10px;"  src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" />    </a>
<?php } ?>
	</td>
  </tr>
<?php } ?>
</table>

<br clear="all" />
<br clear="all" />
<br clear="all" />
<?php if ($palavra == "") { ?>
	<input name="button" type="button" class="frmBotao" id="button" onclick="javascript:history.back();" value="    Voltar    " />
<?php } else { ?>
	<input name="button" type="button" class="frmBotao" id="button" onclick="MM_goToURL('parent','index.php?area=galeria_de_imagens&palavra=<?php echo $palavra;?>&pagina=<?php echo $pagina;?>');return document.MM_returnValue" value="    Voltar    " />
<?php } ?>

        
        
