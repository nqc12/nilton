<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/vistas.js"></script>
	<link rel="stylesheet" href="css/hoja_index.css">
	<link rel="stylesheet" href="iconos/fonts.css">
	<title>Sistema Library</title>


	<script type="text/javascript">

		function AbrirVentaLogin(){
			document.forms['formingreso'].reset();
			$("#ventanalogin").slideDown("slow");
			$('#ErrorUsuario').hide('fast');
		}

		function CerrarVentaLogin(){
			document.forms['formingreso'].reset();
			$("#ventanalogin").slideUp("fast");
			$('#ErrorUsuario').hide('fast');
		}
		

	</script>


</head>
<body onload="VistaInicio()">
	<div id="contenedor">

		<div id="ventanalogin">
			

			<div id="formlogin">

				<div id="cerrar"><a href="javascript:CerrarVentaLogin();">Cerrar X</a></div>

				<h1>Ingresar al Sistema</h1>
				<hr><br>

				<form method="POST" name="formingreso">
	
					<input type="text" name="txtnrcarnet" placeholder="Nro. Carnet..." required>
					<input type="password" name="txtclave" placeholder="Contraseña..." required>
					<button type="submit" name="btnEntrar">Entrar</button>
					<button type="button" onclick="javascript:CerrarVentaLogin();">Cancelar</button>
					<div id='ErrorUsuario'><strong>Error!</strong>Usuario No Encontrado</div>
					<?php
						include('dbconexion.php');

						if (isset($_POST['btnEntrar'])){

							$nrcarnet = $_POST['txtnrcarnet'];
							$clave = $_POST['txtclave'];

							$query_b = "SELECT CodBibliotecario, Nro_Carnet FROM bibliotecario WHERE Nro_Carnet='$nrcarnet' AND Contrasena ='$clave'";
							$query_l = "SELECT CodLector, Nro_Carnet FROM lector WHERE Nro_Carnet='$nrcarnet' AND Contrasena ='$clave'";

							$result_b = $cnmysql->query($query_b);
							$result_l = $cnmysql->query($query_l);

							$num_row_b = mysqli_num_rows($result_b);
							$num_row_l = mysqli_num_rows($result_l);
							


							if( $num_row_b > 0 ){
								
								$row = mysqli_fetch_array($result_b);

								/*$idb = $row['CodBibliotecario'];*/

								session_start();
								$_SESSION["idb"]= $row['CodBibliotecario'];

								/*header("location: biblioteca/indexbibliotecario.php?id=$idb");*/
								header("location: biblioteca/indexbibliotecario.php");

							}elseif ($num_row_l > 0 ) {
								
								$row = mysqli_fetch_array($result_l);

								/*$idl = $row['CodLector'];*/

								session_start();
								$_SESSION["idl"] = $row['CodLector'];

								/*header("location: biblioteca/indexlector.php?id=$idl");*/
								header("location: biblioteca/indexlector.php");

							}else{ 


								echo "<script>";
								echo "$('#ventanalogin').slideDown('slow');";
								echo "$('#ErrorUsuario').slideDown('slow');";
								echo "</script>";
							}

						}else{

						}
					?>


				</form>
			</div>

		</div>

		<header>

			<div id="titulo">
				<h1>SISTEMA LIBRARY V1</h1>
			</div>	

			<div id="captura">
				<div><img src="img/captura.png" width="1000" height="300"></div>	
			</div>

		</header>

		<br>
		<hr>

		<nav>
		<center>
			<ul>
				<li><a onclick="VistaInicio();"><span class="icon-home"></span>INICIO</a></li>
				<li><a onclick="VistaLibros();"><span class="icon-stack"></span>LIBLOS</a></li>
				<li><a onclick="VistaAcercaDe();"><span class="icon-home2"></span>ACERCA DE</a></li>
				<li><a href="javascript:AbrirVentaLogin();"><span class="icon-key2"></span>ENTRAR</a></li>
			</ul>

		</center>
		</nav>
		<section>
			<div id="contenido">
			
			</div>
		</section>

		<footer>
			<p>AUTOR: QUINTO CONTRERAS NILTON | Proyecto SISTEMA LIBRARY V1 © | MPT</p>
		</footer>
		
	</div>
</body>
</html>