            <?php
			 session_start();
			?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Aerolinea Rustics</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
<script type="text/javascript" src="../js/validar_index_vuelo.js"></script>
 <link type="text/css" rel="stylesheet" href="../js/jquery-ui.css" />
<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#tabs_vuelos" ).tabs();
	$( "#tabs_vuelos_2" ).tabs();
	$( "#tabs_vuelos" ).tabs({ active:3 });
	$( "#tabs_vuelos_2" ).tabs({ active:3 });
  });
 
  </script>
  
  <?php
   include("../clases/funcionFecha.php");
   include("../clases/funcion_evaluar_tipos.php");
   include("../clases/DataBase.php");
   $baseDatos = new DataBase();
   $partida = $_POST['partida'];
   $categoria = $_POST['categoria'];
   $tipo_viaje=$_POST['tipoViaje'];
   echo($tipo_viaje);
   $llegada =$_POST['destino'];
   $fecha_ida =$_POST['fechaPartida'];
   $fecha_vuelta =$_POST['fechaDestino'];
   
   $fecha_ida_invertir = fechaDma($fecha_ida);
   $fecha_vuelta_invertir = fechaDma($fecha_vuelta);
  
   $lista_vuelta = $baseDatos->resultToArray($baseDatos->consulta("select * from vuelo where lugar_partida='$llegada' and lugar_llegada='$partida'"));
 
   $dias = array('nada','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
   $dia_ida=$dias[date('N', strtotime($_POST['fechaPartida']))];
   $dia_vuelta=$dias[date('N', strtotime($_POST['fechaDestino']))];
   $nfilas_vuelta=count($lista_vuelta);
	
   $_SESSION['clase'] = $_POST['categoria'];
   $_SESSION['fecha_ida'] =  $fecha_ida_invertir ;
   $_SESSION['fecha_vuelta'] = $fecha_vuelta_invertir ;
   
						

?>
</head>
<body>
 <div id="general">
     <div id="encabezado">
	   <div id="formulario">
        <form action="usuario.html" method="post">
		<p><label>Usuario:</label><input type="text" name="usuario"/>
		<label>Contrase&ntilde;a:</label><input type="text" name="usuario"/></p>
		<p><input type="image" src="../img/boton_enviar.png" /></p>
        </form>
		</div>
	</div>
    <div id="encabezado_medio_vuelos">
	<img src="../img/logotipo_chico.png" id="logotipo" alt="logotipo aerolinea rutics" width="242" height="100"/>
	<img src="../img/chica_vuelos.png" class="aeromoza" alt="azafata" width="227" height="280"/>
	<ul>
	  <li><a href="pag/empresa.html">LA EMPRESA</a></li>
	  <li><a href="pag/reservas.html">RESERVAS </a></li>
	  <li><a href="pag/informacion.html">INFORMACION</a></li>
	  <li><a href="pag/corporativo.html">CORPORATIVO</a></li>
	</ul>
    </div>
	
   <div id="contenido">
     <div id="menu_lateral">
	    <div id="menu_contenedor_li">
		   <p>01</p>
		  <div id="contenedor_li">
		  <div class="blanco_columna_li">
		  </div>
		     <a href="vuelos.html">Selecciona tu vuelo</a>
			 <a href="verificacion.html">Verifica tu elecci&oacute;n</a>
			 <a href="datos.html">Completa tus datos</a>
			 <a href="confirmacion.html">Compra tu pasaje</a>
			 <a href="reserva.html">Reserva tu asiento</a>
		   </div>
		</div>
	 </div>
	 <div id="columna_contenido">
	   <div id="barra_titulo">
	   <div class="espacio_arriba"></div>
	   <img src="../img/cuadradito.gif" alt="cuadradito" width="16" height="16"/>
	   <h4>SELECCIONA TU VUELO</h4>
	   </div>
	   <form action="verificacion.php" method="POST" onSubmit="return validar_vuelos()" id="formulario_vuelos">
	   <p>La tarifa informada en este paso corresponde a una tarifa base para pasajero
	   oculto y no incluye tasas ni impuestos. En el pr&oacute;ximo paso podr&aacute;s ver la tarifa
	   total a abonar. Al combinar tarifas con diferentes condiciones, las regulaciones m&aacute;
	   restrictivas ser&aacute;n aplicadas para todos el billete.</p>
	    <img src="../img/chica_vuelos_chico.gif" alt="imagen de recepcionista" width="137" height="179"/>
		
			 <p><img src="../img/cuadradito.gif" alt="cuadradito" width="16" height="16" class="cuadradito" /><span class="titulito">IDA</span></p>
			 <div class="espacio_blanco"></div>
			 <div id="tabs_vuelos">
	            <ul>
                  <li><a href="#tabs-1">Fecha 1</a></li>
                  <li><a href="#tabs-2">Fecha 2</a></li>
	              <li><a href="#tabs-3">Fecha 3</a></li>
				  <li><a href="#tabs-4"><?php echo($dia_ida); ?></a></li>
                  <li><a href="#tabs-5">Fecha 5</a></li>
	              <li><a href="#tabs-6">Fecha 6</a></li>
				  <li><a href="#tabs-7">Fecha 7</a></li>
                </ul>
				<div id='tabs-4'>
	           <?php
			        $value="vuelo_ida";
				    include("../clases/busqueda_include.php");	
				 ?>
				   </div>
				 
			
			 <div id="tabs-2">
			  <h1>Natalia soledad Tocci tab 2</h1>
			 </div>
			 <div id="tabs-3">
			 <h1>Natalia soledad Tocci tab 3</h1>
			 </div>
			  <div id="tabs-1">
			  <h1>Natalia soledad Tocci tab 4</h1>
			 </div>
			  <div id="tabs-5">
			 <h1>Natalia soledad Tocci tab 5</h1>
			 </div>
			   <div id="tabs-6">
			 <h1>Natalia soledad Tocci tab 6</h1>
			 </div>
			   <div id="tabs-7">
			 <h1>Natalia soledad Tocci tab 7</h1>
			 </div>
			 </div>
			 <div class="espacio_blanco"></div>
		       <?php 
			 if($tipo_viaje == "idaVuelta"){
			   echo('<p><img src="../img/cuadradito.gif" alt="cuadradito" width="16" height="16" class="cuadradito" /><span class="titulito">VUELTA</span></p>
				 <div class="espacio_blanco"></div>
			     <div id="tabs_vuelos_2">
	                <ul>
                  <li><a href="#tabs-1-a">Fecha 1</a></li>
                  <li><a href="#tabs-2-a">Fecha 2</a></li>
	              <li><a href="#tabs-3-a">Fecha 3</a></li>
				  <li><a href="#tabs-4-a">'.$dia_vuelta.'</a></li>
                  <li><a href="#tabs-5-a">Fecha 5</a></li>
	              <li><a href="#tabs-6-a">Fecha 6</a></li>
				  <li><a href="#tabs-7-a">Fecha 7</a></li>
                </ul>
	           <div id="tabs-4-a">');
			           $dia_ida=$dia_vuelta;
			           $fecha_ida_invertir=$fecha_vuelta_invertir;
                       $auxiliar=$partida;
			           $partida=$llegada;
					   $llegada =$auxiliar;
					   $value="vuelo_vuelta";
		               include("../clases/busqueda_include.php");
				echo("</div>
				</div><input type='hidden' value='$tipo_viaje' id='tipo_viaje'/>");
				
				}
				echo("<input type='hidden' value='$tipo_viaje' id='tipo_viaje'/>");
				?>

				<p><a href="../index.php"><img src="../img/volver.png" alt="boton volver" id="boton_volver" width="99" height="37"/></a></p>
		        <p id="boton_continuar"><input type="image" src="../img/continuar.png"  alt="boton continuar"/></p>
				</form>
	   </div>
	</div>
    <div id="pie">
     <img src="../img/logotipo_pie.png" alt="logotipo Aerolineas Rutics" width="251" height="76"/>
	 <div class="espacio_blanco_pie"></div>
	 <h2>(011)4667-8907 / 011)4667-8907 </h2>
	 <p>aerolineasRustics.com Sitio Oficial de Aerolineas. © 1996 - 2014 Aerolíneas Rustics S.A.
      Legales | Condiciones Generales de Transporte | Mapa del Sitio | Ud. est&aacute; en un SITIO SEGURO</p>
     </div>
</div>
</body>
</html>