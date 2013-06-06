<section id="home_conteudo">

  <div id="slide_home">
        <div id="slideshow">
        
       <a href="#">
       <img src="design/layout/frontEnd/slide/ft01.jpg" width="960" height="400">
       <span>
       <h3>Valores éticos e morais</h3>
       <p>Costa, Campello & Medeiros Advogados Associados é uma sociedade de advogados que foi sedimentada por valores éticos e morais como princípios fundamentais, que vêm sendo transmitidos a novas gerações de profissionais.</p>
       </span>
       </a>
       
       <a href="#">
       <img src="design/layout/frontEnd/slide/ft02.jpg" width="960" height="400">
       <span>
       <h3>Moderna infraestrutura</h3>
       <p>O escritório dispõe de uma moderna infraestrutura, biblioteca atualizada, e sistema informatizado de gerenciamento de processos, além de investir regularmente para capacitação e especialização contínua de seus profissionais.</p>
       </span>
       </a>
       
       <a href="#">
       <img src="design/layout/frontEnd/slide/ft03.jpg" width="960" height="400">
       <span>
       <h3>Atendimento personalizado</h3>
       <p>Atender as necessidades de seus clientes com alicerce e respeito aos valores éticos e morais, de forma personalizada, profissional, transparente, comprometida e eficiente, identificando soluções criativas nas questões fundamentais de seus negócios.</p>
       </span>
       </a>
       
       <script type="text/javascript">
        $(document).ready(function() {
        $('#slideshow').coinslider({ width: 640, navigation: true, delay: 5000 });
        });
       </script>

       
      </div>
    </div>

<?php
include_once("biblioteca/class_mysql.php");
include_once("modulos/noticia/biblioteca/class_noticia.php");

$acaoNoticia = new noticia();
?>

    <div id="drops_home">
    
<?php
$tipoNoticia = 4;
$numNoticias = 4;

$exeListarNoticiaPorTipo = $acaoNoticia -> listarNoticiaPorTipo($tipoNoticia, $numNoticias);
while ($infListarNoticiaPorTipo = mysql_fetch_array($exeListarNoticiaPorTipo)) {
?>
		<article>
            <h3><?php echo $infListarNoticiaPorTipo["titulo"];?></h3>
            <!-- <p><?php echo $infListarNoticiaPorTipo["chamada"];?></p> -->
            <a href="?area=noticias_exb&id_noticia=<?php echo $infListarNoticiaPorTipo["id_noticia"];?>">Leia Mais...</a>
            <br>
            <hr>
        </article>
<?php } ?>
        
    </div>
    
</section>