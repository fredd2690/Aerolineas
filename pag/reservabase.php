<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
$_SESSION['fila']= $_POST['fila'];
$_SESSION['asiento']= $_POST['asiento'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Aerolinea Rustics</title>
</head>
<body>
	
	<?php
		$cambiar =$_SESSION['cambiar'];
	
		if ($cambiar==0) /* determina que no se esta cambiando de asiento o reserva */
		{
		
			$link = mysql_connect('localhost','root','') or die("No se ha podido acceder");
			$db = mysql_select_db('aerolineas',$link);
			$sql = "SELECT asiento, fila FROM reserva WHERE tipo_viaje = $_SESSION[tipo] AND nro_vuelo = '$_SESSION[nro_vuelo]' AND codigo_reserva ='$_SESSION[codigo]'";
			$ubicacion = mysql_query($sql);
			while ($row = mysql_fetch_row($ubicacion))
			{
				if($_SESSION['asiento']=="Selec" && $_SESSION['fila']=="Selec")
				{
					die ("No ha ingresado un asiento o fila. Verifique.");
					mysql_close();
				}
				$row[0];
				$row[1];
				if ($row[0] == $_SESSION['asiento'] && $row[1] == $_SESSION['fila'])
				{
					die ("HA INGRESADO UN ASIENTO YA OCUPADO!!");
					mysql_close();
				}
			}
	/* En la base anterior se observa si hay asiento ocupado seleccionado o sino se selecciono nada.*/
	/* --------------------------------------------------Inserta el asiento y fila... ------------------------------------------------------- */
			$tipo =$_SESSION['tipo'];
			$clase =$_SESSION['clase'];
			$fila =$_SESSION['fila'];
			$asiento =$_SESSION['asiento'];
			echo "El tipo es: $tipo<br/>";
			echo "Clase: $clase<br/>";
			echo "Fila: $fila<br/>";
			echo "Asiento: $asiento<br/>";
			$req = (strlen($tipo)*strlen($clase)*strlen($fila)*strlen($asiento)) or die ("No se han llenado todos los campos");/* campos requeridos*/
			mysql_query("update reserva SET tipo_viaje='$tipo', clase='$clase',asiento='$asiento',fila='$fila' where nro_vuelo = '$_SESSION[nro_vuelo]' AND codigo_reserva='$_SESSION[codigo]'",$link)or die("Error de envio");
			// No,mysql_query("insert into reserva values ('','$clase','$asiento','$fila','','','','')where nro_vuelo = '$_SESSION[nro_vuelo]' AND codigo_reserva='$_SESSION[codigo]'",$link)or die("Error de envio");
			echo "<br>registro de datos completo";
	
	
			echo "<br/>Su codigo de reserva es: $_SESSION[codigo]";
			mysql_close();
			session_destroy();
			//echo "<input type=button name=continuar value=continuar onclick=location.href='datos.html'>";
		}
		if ($cambiar!=0)/* determina que se esta cambiando de asiento o reserva */
		{	
		$link = mysql_connect('localhost','root','') or die("No se ha podido acceder");
			$db = mysql_select_db('aerolineas',$link);
				$sql99 = "SELECT fecha_reserva FROM reserva WHERE codigo_reserva LIKE '$cambiar'" ; 
					$ubicacion99 = mysql_query($sql99);
						while ($row99 = mysql_fetch_row($ubicacion99))
						{
							$row99[0];
							$fechacambia=$row99[0];
						}
		mysql_close();
		
			$link = mysql_connect('localhost','root','') or die("No se ha podido acceder");
			$db = mysql_select_db('aerolineas',$link);
			$sql = "SELECT asiento, fila FROM reserva WHERE tipo_viaje = $_SESSION[tipo] AND nro_vuelo = $_SESSION[nro_vuelo] AND fecha_reserva ='$fechacambia'";
			$ubicacion = mysql_query($sql);
			while ($row = mysql_fetch_row($ubicacion))
			{
				if($_SESSION['asiento']=="Selec" && $_SESSION['fila']=="Selec")
				{
					die ("No ha ingresado un asiento o fila. Verifique.");
					mysql_close();
				}
				$row[0];
				$row[1];
				if ($row[0] == $_SESSION['asiento'] && $row[1] == $_SESSION['fila'])
				{
					die ("HA INGRESADO UN ASIENTO YA OCUPADO!!");
					mysql_close();
				}
			}
			/*---------------------- se actualizan los datos en el lugar correcto de la base -----------------------*/
			$link = mysql_connect('localhost','root','') or die("No se ha podido acceder");
			$db = mysql_select_db('aerolineas',$link);
			$sql6 = "SELECT codigo_reserva FROM reserva WHERE codigo_reserva = $cambiar";
			$ubicacion6 = mysql_query($sql6);
			while ($row = mysql_fetch_row($ubicacion6))
			{
				$row[0];
				if($cambiar==$row[0])
				{
					$tipo =$_SESSION['tipo'];
					$clase =$_SESSION['clase'];
					$fila =$_SESSION['fila'];
					$asiento =$_SESSION['asiento'];
					echo "El tipo es: $tipo<br>";
					echo "Clase: $clase<br>";
					echo "Fila: $fila<br>";
					echo "Asiento: $asiento<br>";
					$req = (strlen($cambiar)*strlen($tipo)*strlen($clase)*strlen($fila)*strlen($asiento)) or die ("No se han llenado todos los campos");

					mysql_query("update reserva SET tipo_viaje='$tipo', clase='$clase',asiento='$asiento',fila='$fila' where codigo_reserva = $cambiar",$link)or die("Error de envio");
					echo "<br>registro de datos completo";
			
					
					$sql2 = "SELECT codigo_reserva FROM reserva WHERE tipo_viaje = '$tipo' AND asiento = '$asiento' AND fila = '$fila 'AND nro_vuelo = '$_SESSION[nro_vuelo]' AND fecha_reserva ='$fechacambia'";
					$code = mysql_query($sql2);
					while ($row = mysql_fetch_row($code))
					{
						echo "<br>Su codigo de reserva es:".$row[0]."";
					}
					mysql_close();
					session_destroy();
				}
			}
			
		}
?>

</body>
</html>