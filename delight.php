<?php require_once('dbqueries.php');
require_once('formularios.php');
/*
 * PHP-Auth (https://github.com/delight-im/PHP-Auth)
 * Copyright (c) delight.im (https://www.delight.im/)
 * Licensed under the MIT License (https://opensource.org/licenses/MIT)
 */
/*mysql_select_db($dbname_rcpip, $rcpip);
$query_getEnfermera = sprintf("SELECT nombre, siglas FROM Enfermeras WHERE siglas = %s", GetSQLValueString($colname_getEnfermera, "text"));
$getEnfermera = mysql_query($query_getEnfermera, $xoxo) or die(mysql_error());
$row_getEnfermera = mysql_fetch_assoc($getEnfermera);
$totalRows_getEnfermera = mysql_num_rows($getEnfermera);*/

/// Funciones para formater la página HTML
/////////////////////////////////////////////////////////////////////////////
function showHtmlLoginHead() {
    echo '
    <html>
    <head>
    	<!--<meta http-equiv="content-type" content="text/html">-->
    	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/signin.css">
		<link rel="stylesheet" href="css/custom.css">	
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <script src="js/jquery-2.2.4.min.js"></script>	

				
	</head>
	<body id="loginpage" >
	';
}

function showHtmlHead() {
    echo '
    <html>
    <head>
    	<!--<meta http-equiv="content-type" content="text/html">-->
    	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/forms.css">
		<link rel="stylesheet" href="css/custom.css">
		<script src="js/jquery-2.2.4.min.js"></script>
		<script src="js/caleandar.js"></script>	
		<script src="js/fscreen.js"></script>
		<!-- JS Forms -->
    	<script type="text/javascript" src="js/forms.js"></script>
		<!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">	
	</head>
	<body id="page">
	<div class="wrapper">
	';
}

function showHeader() {
	echo '

		';
}

function showSidebarNav($role) {
	echo '
	        <!-- Sidebar Holder -->
	        <!-- Sidebar/menu -->
            <nav id="sidebar">
                <div class="sidebar-header">
                	
					<h3><a href="rcpip-incmnsz.html"><img src="imgs/incmnsz.png"></a><br>
					Unidad de Investigación en enfermedades metabólicas</h3>
                    <!--<strong>INCMNSZ</strong>-->
                </div>';
			menuNivel2();
		if ($role == "ADMIN") {
			# code...
		echo '

                		<div id="myNavbar">
								<div class="menuDinamico">
								<button id="link2" data-page="page2">Ingreso de Usuarios</button>
								<button id="link3" data-page="page3">Protocolos</button>
								</div>
						</div>';
		}
		echo '
            </nav>

		<!-- Page Content Holder -->
            <div id="content">
            	<nav class="navbar navbar-default navbar-fixed-top">
					<div class="container-fluid">

						<div class="navbar-header">
							<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Menú</span>
                            </button>
                            <form accept-charset="utf-8" method="post" action="rcpip-incmnsz.php">
								<input type="hidden" value="logOut" name="action">
								<button type="submit" id="sidebarSalir" class="btn btn-info navbar-btn pull-right">
									<span>Salir</span>
	                                <i class="fa fa-sign-out fa-fw"></i>
	                            </button>   
	                        </form>                         
						</div>
						<div  class="collapse navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active" id="ico-r"><a href="#">Registro</a></li>
								<li id="ico-f"><a href="#">Actividad Física</a></li>
								<li id="ico-a"><a href="#">Alimentación</a></li>
								<li id="ico-v"><a href="#">Calidad de Vida</a></li>
								<li id="ico-d"><a href="#">DT2</a></li>
								<li id="ico-c"><a href="#">Conducta</a></li>
							</ul>
						</div>
			</div>
	</nav>
<<<<<<< HEAD
';
}
=======
	<nav>
		<div class="menuDinamico">
		<!--<button id="link1" data-page="page1" class="w3-button w3-orange"><i class="fa fa-stethoscope   w3-margin-right"></i>Recordatorio de alimentos 24hrs</button>-->
			<button id="link2" data-page="page2" class="w3-button w3-purple"><i class="fa fa-user-o w3-margin-right"></i>Ingreso de Usuarios</button>
			<button id="link3" data-page="page3" class="w3-button w3-blue"><i class="fa fa-file-text-o w3-margin-right"></i>Protocolos</button>
		</div>
	</nav>
		<!-- Header -->
		<header id="portfolio">
			<span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
			<div class="w3-container">
				<!--<h1 class="titulo"><b>Registro clínico para proyectos de investigación y protocolos</b></h1>-->
>>>>>>> bf7783abc5fbf8a97b2d4d14965d463833ebf214



/* 
 * Agrega el estilo (authenticated) al body para manipular la vista cuando esta authenticado
 * Crea el menu dinamico (hide/show) segun se seleccione
 */
function showViewChanges(){
	echo '
		<script>
			var bodyClasses = document.querySelector("body").className;
			var myClass = new RegExp("authenticated");
			var trueOrFalse = myClass.test( bodyClasses );

			if (trueOrFalse == false) {
				var elemento = document.getElementById("page");
				elemento.className += " authenticated";
			} 


			$(function() {
				var curPage="";
				$(".menuDinamico button").click(function() {
				        if (curPage.length) { 
				            $("#"+curPage).hide();
				        }
				        curPage=$(this).data("page");
				        $("#"+curPage).show();
				    });





			});

         </script>
         ';
}


////////////////////////////////////////////////////////////////////////////////
/// Funciones para el Formateo de los datos y Tablas de la Base de Datos
//  (Temporales por actualizar e implementar en el sistema)
/////////////////////////////////////////////////////////////////////////////
// Protocolo
function writeProtocoloDatos() {
	$datos = getDataProtocolo();
	foreach($datos as $row) {
    	echo $row['ProtocoloID'].'  &emsp;'.$row['Protocolo'].'<br>'; //etc...
  	}
}

function writeProtocoloTotalRegistros() {
	global $datosProtocolo;
	echo $datosProtocolo->rowCount();
}

function writeMedicosDatos() {
	$datos = getDataMedicos();
	foreach($datosProtocolo as $row) {
    	echo $row['ProtocoloID'].'  &emsp;'.$row['Protocolo'].'<br>'; //etc...
  	}
}

/*
// People
function writePeopleDatos {
	$datos = getDataPeople();
	foreach($datos as $row) {
      echo $row['Nombre'].' &emsp;'.$row['Sexo'].' &emsp;'.$row['Ocupacion'].' &emsp;'.$row['Domicilio'].' &emsp;'.$row['Lugar_nacimiento'].' &emsp;'.$row['Fecha_nacimiento'].' &emsp;'.$row['Estado_civil'].' &emsp;'.$row['Escolaridad'].$row['Edad'].' &emsp;'.$row['Tel_casa'].' &emsp;'.$row['Celular'].' &emsp;'.$row['Tel_trabajo'].' &emsp;'.$row['Email'].' &emsp;'.$row['rol'].' &emsp;'.$row['FolioID'].' &emsp;'.$row['IDUIEM'].' &emsp;'; //etc...
  	}
}
*/

////////////////// OTRAS FUNCIONES

function showDebugData(\Delight\Auth\Auth $auth, $result) {
	echo '<pre>';

	echo 'Last operation' . "\t\t\t\t";
	\var_dump($result);
	echo 'Session ID' . "\t\t\t\t";
	\var_dump(\session_id());
	echo "\n";

	echo '$auth->isLoggedIn()' . "\t\t\t";
	\var_dump($auth->isLoggedIn());
	echo '$auth->check()' . "\t\t\t\t";
	\var_dump($auth->check());
	echo "\n";

	echo '$auth->getUserId()' . "\t\t\t";
	\var_dump($auth->getUserId());
	echo '$auth->id()' . "\t\t\t\t";
	\var_dump($auth->id());
	echo "\n";

	echo '$auth->getEmail()' . "\t\t\t";
	\var_dump($auth->getEmail());
	echo '$auth->getUsername()' . "\t\t\t";
	\var_dump($auth->getUsername());

	echo '$auth->getStatus()' . "\t\t\t";
	echo \convertStatusToText($auth);
	echo ' / ';
	\var_dump($auth->getStatus());

	echo "\n";

	echo 'Roles (super moderator)' . "\t\t\t";
	\var_dump($auth->hasRole(\Delight\Auth\Role::SUPER_MODERATOR));

	echo 'Roles (developer *or* manager)' . "\t\t";
	\var_dump($auth->hasAnyRole(\Delight\Auth\Role::DEVELOPER, \Delight\Auth\Role::MANAGER));

	echo 'Roles (developer *and* manager)' . "\t\t";
	\var_dump($auth->hasAllRoles(\Delight\Auth\Role::DEVELOPER, \Delight\Auth\Role::MANAGER));

	echo "\n";

	echo '$auth->isRemembered()' . "\t\t\t";
	\var_dump($auth->isRemembered());
	echo '$auth->getIpAddress()' . "\t\t\t";
	\var_dump($auth->getIpAddress());
	echo "\n";

	echo 'Session name' . "\t\t\t\t";
	\var_dump(\session_name());
	echo 'Auth::createRememberCookieName()' . "\t";
	\var_dump(\Delight\Auth\Auth::createRememberCookieName());
	echo "\n";

	echo 'Auth::createCookieName(\'session\')' . "\t";
	\var_dump(\Delight\Auth\Auth::createCookieName('session'));
	echo 'Auth::createRandomString()' . "\t\t";
	\var_dump(\Delight\Auth\Auth::createRandomString());
	echo 'Auth::createUuid()' . "\t\t\t";
	\var_dump(\Delight\Auth\Auth::createUuid());

	echo '</pre>';
}

function convertStatusToText(\Delight\Auth\Auth $auth) {
	if ($auth->isLoggedIn() === true) {
		if ($auth->getStatus() === \Delight\Auth\Status::NORMAL && $auth->isNormal()) {
			return 'normal';
		}
		elseif ($auth->getStatus() === \Delight\Auth\Status::ARCHIVED && $auth->isArchived()) {
			return 'archived';
		}
		elseif ($auth->getStatus() === \Delight\Auth\Status::BANNED && $auth->isBanned()) {
			return 'banned';
		}
		elseif ($auth->getStatus() === \Delight\Auth\Status::LOCKED && $auth->isLocked()) {
			return 'locked';
		}
		elseif ($auth->getStatus() === \Delight\Auth\Status::PENDING_REVIEW && $auth->isPendingReview()) {
			return 'pending review';
		}
		elseif ($auth->getStatus() === \Delight\Auth\Status::SUSPENDED && $auth->isSuspended()) {
			return 'suspended';
		}
	}
	elseif ($auth->isLoggedIn() === false) {
		if ($auth->getStatus() === null) {
			return 'none';
		}
	}

	throw new Exception('Invalid status `' . $auth->getStatus() . '`');
}

function showAuthenticatedUserForm(\Delight\Auth\Auth $auth) {
	/*
	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="reconfirmPassword" />';
	echo '<input type="text" name="password" placeholder="Password" /> ';
	echo '<button type="submit">Reconfirm password</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="changePassword" />';
	echo '<input type="text" name="oldPassword" placeholder="Old password" /> ';
	echo '<input type="text" name="newPassword" placeholder="New password" /> ';
	echo '<button type="submit">Change password</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="changePasswordWithoutOldPassword" />';
	echo '<input type="text" name="newPassword" placeholder="New password" /> ';
	echo '<button type="submit">Change password without old password</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="changeEmail" />';
	echo '<input type="text" name="newEmail" placeholder="New email address" /> ';
	echo '<button type="submit">Change email address</button>';
	echo '</form>';

	\showConfirmEmailForm();

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="setPasswordResetEnabled" />';
	echo '<select name="enabled" size="1">';
	echo '<option value="0"' . ($auth->isPasswordResetEnabled() ? '' : ' selected="selected"') . '>Disabled</option>';
	echo '<option value="1"' . ($auth->isPasswordResetEnabled() ? ' selected="selected"' : '') . '>Enabled</option>';
	echo '</select> ';
	echo '<button type="submit">Control password resets</button>';
	echo '</form>';
	*/
	/*
	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="logOutAndDestroySession" />';
	echo '<button type="submit">Log out and destroy session</button>';
	echo '</form>';
	*/

	echo '
	';

}

function createRolesOptionsOld() {
	$roleReflection = new ReflectionClass(\Delight\Auth\Role::class);

	$out = '';

	foreach ($roleReflection->getConstants() as $roleName => $roleValue) {
		$out .= '<option value="' . $roleValue . '">' . $roleName . '</option>';
	}

	return $out;
}

function createRolesOptions() {
	$roleReflection = new ReflectionClass(\Delight\Auth\Role::class);

	$out = '';

	foreach ($roleReflection->getConstants() as $roleName => $roleValue) {
		if ($roleName == 'ADMIN' || $roleName == 'PACIENTE' || $roleName == 'DOCTOR') {
			$out .= '<option value="' . $roleValue . '">' . $roleName . '</option>';
		}
	}

	return $out;
}
?>