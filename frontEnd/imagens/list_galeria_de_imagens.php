<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('biblioteca/class_mysql.php');
include_once('biblioteca/funcoesDiversas.php');
include_once('modulos/galeriaFotos/biblioteca/class_bdGaleriaFoto.php');
include_once('modulos/galeriaFotos/biblioteca/class_bdGaleriaDeFoto.php');





$palavra = $_REQUEST["palavra"];
$pagina  = $_REQUEST["pagina"];

$total_reg = "16"; // n�mero de registros por p�gina

if (!$pagina)
	$pc = "1";
else
	$pc = $pagina;

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

$acaoGaleriaDeFotos = new bdGaleriaDeFoto();

$exeTotalDeGaleriaDeFotos = $acaoGaleriaDeFotos->consultarTotalDeGaleriaDeFotos($palavra);
$infTotalDeGaleriaDeFotos = mysql_fetch_assoc($exeTotalDeGaleriaDeFotos);

$tr = $infTotalDeGaleriaDeFotos["total"]; // verifica o número total de registros
$tp = ceil($tr / $total_reg); // verifica o número total de páginas




?>

<h1>Galeria de Imagens</h1>

<form name="form1" id="form1" action="index.php?area=galeria_de_imagens" method="post" style="width: 760; text-align: left;">

    <p>Digite a palavra-chave referente a galeria que esta procurando. <br />
    Para que apareça a listagem completa, deixe o campo em branco e clique em "Procurar".</p>
    
    <p>Palavra-Chave: <br />
    <input name="palavra" type="text" class="frmCampoTexto" id="palavra" size="40" maxlength="100" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="Submit" type="submit" class="frmBotao" value="  Procurar  " /></p>

</form>

<table width="600" border="0" align="left" cellspacing="0">

    
    
    
    
    
<?php
$cont = 0;
$exeGaleriaDeFotosParaPaginacao = $acaoGaleriaDeFotos->listarGaleriaDeFotosParaPaginacao($palavra, $inicio, $total_reg);
while ($infGaleriaDeFotosParaPaginacao = mysql_fetch_assoc($exeGaleriaDeFotosParaPaginacao)) {
	
        $id_galeria = $infGaleriaDeFotosParaPaginacao["id_galeria"];
	
	$exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = $acaoGaleriaDeFotos->consultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto($id_galeria);
	$infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_assoc($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto);
	
	if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
		$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
	else
		$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
	
	if ($cont % 2 == 0)
		$cor = "#FFFFFF";
	else
		$cor = "#5E8CBE";

	$cont++;
?>
	<tr>
		<td width="415">
                        <div style="padding: 5px;">
                            
                            
                            <div style="float:left">
                                <h4><?php echo $infGaleriaDeFotosParaPaginacao["titulo_galeria"];?></h4>                            
                                <h6><?php echo 'Data do cadastro: '.formatodata($infGaleriaDeFotosParaPaginacao["datacad_galeria"]);?></h6>
                            </div>
                            
                            <div style="clear: both;"></div>
                            
                            <div style="float:left; padding: 5px;" >
                                <a href="?area=galeria_fotos_exb&id_galeria=<?php echo $id_galeria;?>&pagina=<?php echo $pagina;?>&palavra=<?php echo $palavra;?>">                               
                                    <img src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" align="left" />	
                                </a>
                            </div>
                            
                            <div style="clear: both;"></div>
                            
                            <div style="float:left">
                                <h6><?php echo 'Descrição: ' .nl2br($infGaleriaDeFotosParaPaginacao["descricao_galeria"]);?></h6>
                            </div>
                            
                            
			</div>
		</td>
		<td width="30"></td>
		<td width="415">
			<?php
			if ($infGaleriaDeFotosParaPaginacao = mysql_fetch_assoc($exeGaleriaDeFotosParaPaginacao)) {
				$id_galeria = $infGaleriaDeFotosParaPaginacao["id_galeria"];
				
				$exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = $acaoGaleriaDeFotos->consultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto($id_galeria);
				$infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto = mysql_fetch_array($exeConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto);
				
				if ($infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"] == "")
					$legenda = $infConsultarGaleriaDeFoto["titulo_galeria"];
				else
					$legenda = $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["legenda_galeria_foto"];
			?>
			<div style="padding: 5px;">
                            
                            
                            <div style="float:left">
                                <h4><?php echo $infGaleriaDeFotosParaPaginacao["titulo_galeria"];?></h4>                            
                                <h6><?php echo 'Data do cadastro: '.formatodata($infGaleriaDeFotosParaPaginacao["datacad_galeria"]);?></h6>
                            </div>
                            
                            <div style="clear: both;"></div>
                            
                            <div style="float:left; padding: 5px;"  >
                                <a href="?area=galeria_fotos_exb&id_galeria=<?php echo $id_galeria;?>&pagina=<?php echo $pagina;?>&palavra=<?php echo $palavra;?>">                               
                                    <img src="modulos/galeriaFotos/backEnd/fotos/<?php echo $infConsultarFotosDaGaleriaDeFotoPorIdGaleriaDeFoto["foto_galeria_foto"];?>" style="border: 2px solid #CCCCCC; padding: 1px;" alt="<?php echo $legenda;?>" width="80" height="80" align="left" />	
                                </a>
                            </div>
                            
                            <div style="clear: both;"></div>
                            
                            <div style="float:left">
                                <h6><?php echo 'Descrição: ' .nl2br($infGaleriaDeFotosParaPaginacao["descricao_galeria"]);?></h6>
                            </div>
                            
                            
			</div>
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="20"> </td>
	</tr>
<?php } ?>    
    
    
    
    
    
    
    
</table>

<br clear="all" />
<p>
<?php 
$anterior = $pc - 1; 
$proximo = $pc + 1; 
if ($pc > 1) { 
echo "<a href='?area=galeria_fotos_lst&pagina=$anterior&palavra=$palavra'><< Anterior</a>"; 
} 
if ($tr > $total_reg) { 
?>
(
<?php 
for ($d=1;$d <= $tp; $d++) { 
if ($pc == $d) { $pages = $pages . $d . " "; } 
else { $pages = $pages . "<a href=\"?area=galeria_fotos_lst&pagina=$d&palavra=$palavra\">$d</a>" . " "; } 
} 
echo $pages; 
?>
)
<?php 
} 
if ($pc < $tp) { 
echo "<a href='?area=galeria_fotos_lst&pagina=$proximo&palavra=$palavra'>Próxima >></a>"; 
} 
echo "<BR>Página $pc de $tp página(s)";
?>
</p>
<script type="text/javascript">
	document.getElementById('palavra').focus();
</script>