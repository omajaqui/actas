<?php
$_SESSION['IpDefault']='127.0.0.1';
include_once("comun/cx.inc");
include("ComunNuevo/ClassPHP/fnSoap.php");
session_start();
if(!isset($_GET["hash"]))
{
	if(isset($_SESSION["codcol"]) and $_SESSION["codcol"]!='')
	{
		header('Location: ../www.comunmaster2000web.net/ComunPHP/MensajeSesionActiva.php');
		exit;
	}
}
date_default_timezone_set('America/Bogota');

/* hash para realizar la conexion con encuesta desde el panel*/
$_SESSION["hash"]=$_GET["hash"];
/*************************************************************/
if(isset($_GET["hash"]) and $_GET["hash"]!="")
{
	$ClassLoginMySql = new SoapClient(null, array('location' => 'http://'.$_SERVER['_Dlqsymnigol_'].'/www.Master2000ServiciosWeb.net/ServiceConsumer/ServiceConsumer.php?r=../LoginUnificado/LoginUnificado&c=ClassLoginUnificado', 'uri' => 'urn:webservices', ));
	$datos = $ClassLoginMySql -> ConsultarLoginAplicaiconesExternas($_GET["hash"]);
	if(isset($datos["continuar"]) and $datos["continuar"]=="S")
	{
		$observacion=explode("|",$datos["observaciones"]);
		/*VERIFICA EL ACCESO AL PANEL*/
		fnDenegarAccesoPanel($da, '0', $cu, $d, '', $_SERVER['_Dlqsymnigol_'],$_SERVER['REQUEST_URI']);
		/**/

		$_SESSION["Nombres"]			= ucwords($observacion[1]);
		$_SESSION["cedula"]				= $datos['login'];
		$cedula							= $datos['login'];
		$_SESSION["TipoUsuario"] 		= 4;
		$TipoUsuario 					= $observacion[0];
		$_SESSION["DaneSeleccionado"] 	= $datos['dane'];
		$_SESSION["codcol"]		 		= $datos['dane'];
		$DaneSeleccionado 				= $datos['dane'];
		$_SESSION['aplicacion']			= 'Master2000 web\Master2000';
		$_SESSION['aplicacionUnificada']= 1;
		$_SESSION['DominioConsumidorExterno']= $_GET['sc'];
		$_SESSION['DesdePanelAcademico']='S';
		$_SESSION['IdFilaRevision']=$observacion[3];

		$NombreEquipo 					= $_SERVER['REMOTE_ADDR'].'#'.$cedula;
		$_SESSION['ano']				=date('Y');
		$_SESSION['IpDefault']			=$datos['servidor'].'.master2000.net';
		$db = conectar_UTF8();
		RegistrarActividadDeUsuario($db,'0','0',$TipoUsuario,$NombreEquipo,$cedula,42,'INICIO','R');

		$nombre_carpeta="../Temporal/";
		if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0777);}
		$nombre_carpeta="../Temporal/Importados/";
		if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0777);}
		$nombre_carpeta="../Temporal/Exportados/";
		if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0777);}

		//Obtener el jwt y asignarlo en el localstorage
		if (isset($_GET['jwt'])) {
			$_SESSION['jwt'] = $_GET['jwt'];
		}

		if($TipoUsuario == 3 or $TipoUsuario == 22)
		{
			header("location: colegiosm.php?PASS=1");
		}
		else
		{
			$_SESSION['ListaAnoColegio']= $datoslista;
			header("location: colegios.php?PASS=1");

		}
			exit;
	}
	else
	{
		echo 'error 3: registro ya utilizados';
		exit;
	}
}
$d 		= $_GET['d'];/*arghash*/
$u 		= $_GET['u'];/*argcodlog*/
$da		= $_GET['da'];/*dane*/
$cu 	= $_GET['cu'];/*tipo usuario*/
$app 	= $_GET['app'];/*aplicacion*/

$ua						= getBrowser();
$UserNavegador			= $ua['name'];
$UserNavegadorVersion	= $ua['version'];
$ip 					= $_SERVER['REMOTE_ADDR'];

/* hash para realizar la conexion con encuesta desde el panel*/
$_SESSION["hash"]=$d;
/*************************************************************/

if(isset($d))
{
	//Creación del servicio en entorno de desarrollo
	$datos = '';
	try{
		$ClassLoginMySql = new SoapClient(null, array('location' => ''.$_SERVER['_Dlqsymnigolhttp_'].'://'.$_SERVER['_Dlqsymnigol_'].'/www.Master2000ServiciosWeb.net/ServiceConsumer/ServiceConsumer.php?r=../LoginUnificado/LoginUnificado&c=ClassLoginUnificado', 'uri' => 'urn:webservices', ));
		$datos = $ClassLoginMySql -> ValidarLoginUnificadoControl($u, $d, $ip, $UserNavegador, $UserNavegadorVersion);
	} catch (SoapFault $fault) {
		$error = str_replace ("'", '', "SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring}) ".$_SERVER['REQUEST_URI']);
		$r = fnRegistrarLogSoap($da, '0', $cu, $error, 'LOGIN', $d, '', $_SERVER['_Dlqsymnigol_']);
	}
	if ($datos['control'] == 'S')
	{
		/*validar app, tipo usuario y dane son iguales a los arrojados por le registro log*/
		if($datos['dane'] == $da && ( ($datos['tipousuario'] == $cu) || ($datos['tipousuario'] == 23 && $cu==6) ) && $datos['aplicacion'] == $app)
		{
			/**********************PERMISO SECRETARIA SOLO LECTURA********************************/
			$cu = $datos['tipousuario'];
			$_GET['cu']= $datos['tipousuario'];
			/*************************************************************************************/
			/*VERIFICA EL ACCESO AL PANEL*/
			fnDenegarAccesoPanel($da, '0', $cu, $d, '', $_SERVER['_Dlqsymnigol_'],$_SERVER['REQUEST_URI']);
			/**/
			
			//$_SESSION["Nombres"]			= ucwords($datos['nombrecompleto']);
			$_SESSION["cedula"]				= $datos['Cedula'];
			$cedula							= $datos['Cedula'];
			$_SESSION["cambiarpwd"]				= $datos['cambiarpwd'];
			$_SESSION["TipoUsuario"] 		= $_GET['cu'];
			$TipoUsuario 					= $_GET['cu'];
			$_SESSION["DaneSeleccionado"] 	= $_GET['da'];
			$_SESSION["codcol"]		 		= $_GET['da'];
			$DaneSeleccionado 				= $_GET['da'];
			$_SESSION['IdTipoArchivo']		= 14;
			$_SESSION['aplicacion']			= 'Master2000 web\Master2000';
			$_SESSION['aplicacionUnificada']= $datos['aplicacion'];
			$_SESSION['AnoInscripcionMunicipio']= $datos['AnoInscripcionMunicipio'];
			$NombreEquipo 					= $_SERVER['REMOTE_ADDR'].'#'.$cedula;
			$_SESSION['IpDefault']			= $datos['servidor'];
			$_SESSION['DaneDefaultMunicipio']= $datos['dane_ppal'];
			$_SESSION['IpDefaultMunicipio']= $datos['dane_ppal_servidor'];
			$_SESSION['pdtmunicipal']= $datos['pdtmunicipal'];
			$_SESSION['nomcolSIS']= $datos['nomcol'];

			//Obtener el jwt y asignarlo en el localstorage
			if (isset($_GET['jwt'])) {
				$_SESSION['jwt'] = $_GET['jwt'];
			}

			/*
				* $_SESSION["DaneSeccional"], CONTIENE OTRAS SEDES ASOCIADAS A LA SEDE PRINCIPAL
			*/
			if(trim($datos['DaneSeccional'])!='')
			{
				$_SESSION["DaneSeccional"]		= $datos['DaneSeccional'].','.$_SESSION["DaneSeleccionado"];
			}
			/***********************************************************************************/

			$db = conectar_UTF8();
			RegistrarActividadDeUsuario($db,'0','0',$TipoUsuario,$NombreEquipo,$cedula,42,'INICIO','R');

			$nombre_carpeta="../Temporal/";
			if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0777);}
			$nombre_carpeta="../Temporal/Importados/";
			if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0777);}
			$nombre_carpeta="../Temporal/Exportados/";
			if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0777);}

				########################################
				########################################
				###	VALIDAR AÑO CREADO BASE DE DATOS ###
				########################################
				########################################
				$sql="EXEC SP_VerificarBaseDatosCreada '".$_SESSION["codcol"]."'";
				$rs=SQL_query($db,$sql);
				$AnioPermitido=ResultadosVariasConsultas($rs);
				$AnoActual=$AnioPermitido[0]['ANIO'];
				$_SESSION["AnioActual"]=$AnoActual;
				#################################
				####	VALIDAR SI USUARIO 	 ####
				####	EXISTE AÑO ACTUAL	 ####
				####    CONSULTAR NOMBRES	 ####
				#################################
				/*VERIFICA EL ACCESO AL PANEL*/
				fnDenegarAccesoPanel($da, '0', $cu, $d, '', $_SERVER['_Dlqsymnigol_'],$_SERVER['REQUEST_URI']);
				$qry= "EXEC COLEGIOS.DBO.SP_ValidarUsuarioCreadoEnBD '".$DaneSeleccionado ."','".$AnoActual."','".$TipoUsuario."','".$cedula."'";
				$rs=SQL_query($db,$qry);
				$Existe=ResultadosVariasConsultas($rs);
				$_SESSION["Nombres"]= ucwords($Existe[0]['NombreCompleto']);
				if($Existe[0]['EXISTE']<>'S')
				{
					$qry= "EXEC COLEGIOS.DBO.SP_ValidarUsuarioCreadoEnBD '".$DaneSeleccionado ."','".($AnoActual-1)."','".$TipoUsuario."','".$cedula."'";
					$rs=SQL_query($db,$qry);
					$Existe=ResultadosVariasConsultas($rs);
					$_SESSION["Nombres"]= ucwords($Existe[0]['NombreCompleto']);
					/*if($Existe[0]['EXISTE']<>'S')
					{
						session_destroy();
						header("location: SistemasAdvertencia.php?MensajeAdvertencia=UsuarioNoExiste");
						exit;
					}*/
				}
				/*****************************/
				#####################################
				######	VALIDAR ENCUESTAS ###########
				######	  OBLIGATORIAS    ###########
				#####################################
				$_SESSION["GrupoEstudiante"]="";
				/* AQUI SE CONSULTARIA EL GRUPO DEL ESTUDIANTE Y ACUDINTE*/
				$db2 = conectar_UTF8('DatMasterColegios_'.$_SESSION["codcol"].'_'.$AnoActual);
				if( $_SESSION["codcol"]=="105079000015" ){
					$rs=SQL_query($db2,"Colegios.dbo.spEN_EncuestaValidarObligatorias '".$_SESSION["codcol"]."','".$AnoActual."','".$_SESSION["TipoUsuario"]."','".$_SESSION["cedula"]."'");
				}else{
					$rs=SQL_query($db2,"SP_EncuestaValidarObligatorias '".$_SESSION["TipoUsuario"]."','".$_SESSION["cedula"]."'");
				}

				$EncuestaObligatoria=ResultadosVariasConsultas($rs);
				$observaciones="";
				if(isset($EncuestaObligatoria[0]["OBLIGAR"]) and $EncuestaObligatoria[0]["OBLIGAR"]=="S")
				{
					$observaciones=$_SESSION["TipoUsuario"].'|'.$_SESSION["Nombres"].'|'.$_SESSION["GrupoEstudiante"].'|'.substr($_SESSION["GrupoEstudiante"], 1, 2);

					$datos=$ClassLoginMySql -> RegistrarLoginAplicaiconesExternas($_SESSION["cedula"],$d , $da, $observaciones);
					if(isset($datos["continuar"]) and $datos["continuar"]=="S")
					{
						if( $_SESSION["codcol"]=="105079000015" ){
							$_SESSION["LinkEncuesta"]="https://encuestas.master2000.net/encuestas_institucionales/entrar.php?hash=".$datos["arghash"];
						}else{
							$_SESSION["LinkEncuesta"]="https://encuestas.master2000.net/encuestas/entrar.php?hash=".$datos["arghash"];
						}
						 header("location: ComunNuevo/php/ObligarEncuesta.php");
						exit;
					}
				}
				####################################
				####################################
				####################################
			if($TipoUsuario == 3 or $TipoUsuario == 22)
			{
				header("location: colegiosm.php?PASS=1");
			}
			else
			{
				$datoslista = $ClassLoginMySql -> ListaAnoColegioLoginUnificado($cedula, $DaneSeleccionado, $TipoUsuario);
				if($datoslista != '')
				{


					$_SESSION['ListaAnoColegio']= $datoslista;
					header("location: colegios.php?PASS=1");
				}
				else
				{
					echo 'error 1: no se pudieron vincular años a su usuario.';
					exit;
				}
			}
			exit;
		}
		else
		{
			echo 'error 2: no coinciden los datos';
			exit;
		}
	}
	else
	{
		echo 'error 3: registro ya utilizados';
		exit;
	}
}
else
{
	echo 'error 4: no se cnose el indicador.';
	exit;
}
?>
