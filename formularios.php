<?php require_once('dbqueries.php');
/*
 * formularios.php
 *
 * Accediendo a la base de datos construye los menús y formularios.
 * RCPIyP INCMNSZ 2017
 *
 **********************************************************************************************
 **********************************************************************************************/


/*
* Menú lateral izquierdo (nivel 2).
* Contiene las secciones principales de la cuenta de cada usuario.
*/
function menuNivel2() {
	echo '
			<div id="menu_nivel_2" class="w3-bar-block">
				<form accept-charset="utf-8" method="post" action="">
				  <a class="w3-bar-item w3-button w3-padding w3-text-teal" onclick="w3_close()" href="#portfolio">
				    <i class="fa fa-th-large fa-fw w3-margin-right"></i>Datos Generales</a> 
				  <a class="w3-bar-item w3-button w3-padding" onclick="w3_close()" href="#about">
				    <i class="fa fa-user-md fa-fw w3-margin-right"></i>Antecedentes médicos</a> 
				  <a class="w3-bar-item w3-button w3-padding" onclick="w3_close()" href="#contact">
				    <i class="fa fa-heart fa-fw w3-margin-right"></i>Hábitos de vida</a>
				  <a class="w3-bar-item w3-button w3-padding" onclick="w3_close()" href="#contact">
				    <i class="fa fa-calendar fa-fw w3-margin-right"></i>Recordatorio de 24 hrs</a>
				  <a class="w3-bar-item w3-button w3-padding" onclick="w3_close()" href="#contact">
				    <i class="fa fa-hand-peace-o fa-fw w3-margin-right"></i>Consentimiento Informado</a>
				  <a class="w3-bar-item w3-button w3-padding" onclick="w3_close()" href="#contact">
				    <i class="fa fa-sign-out fa-fw w3-margin-right"></i>
				    <input type="hidden" value="logOut" name="action">
				    <button type="submit">Salir</button></a>
				</form>
			</div>';
}

/*
* Tarjeta de los Datos Generales de los Médicos.
* Incluye Registro de Médicos (Ingreso), Medicos Registrados (Listado) y Actualización (Update).
*/
function tarjetaMedicos() {
	global $nameErr;
	echo '
		<div id="page1" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaMedicos">
				<h4>Registro de médicos</h4>
				<div class="w3-container w3-whitegray">
					<h2>Ingresar médico</h2>
					<div class="w3-row-padding" style="margin:8 -16px">
						<form action="" method="post" accept-charset="utf-8">
							<div class="w3-third w3-margin-bottom">
								<label for="doctorName">Nombre del médico</label>
								<input type="text" id="dname" name="Nombre_medico" placeholder="Su nombre completo..">    
							</div>
							<div class="w3-third w3-margin-bottom">
								<label for="especialidad">Especialidad</label>
								<input type="text" id="darea" name="Especialidad" placeholder="Su área de especialidad..">   
							</div>
							<div class="w3-third w3-margin-bottom">
								<label for="celular">Celular</label>
								<input type="text" id="dcel" name="Cel_medico" placeholder="Su teléfono de celular..">
							</div>
							<div class="w3-third">
								<label for="celular">Correo electrónico</label>
								<input type="text" id="email" name="Email_medico" placeholder="Su correo electrónico..">
							</div>
							<input type="hidden" name="action" value="addMedico" />
							<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Registro nuevo">
							<span class="error">'.$nameErr.'</span>
						</form>
					</div>
				</div>	
				<div class="lista">		
				<h4> Médicos registrados:</h4>	';
				writeMedicosTable();
				echo '
				</div>
				<div class="w3-container w3-whitegray">';
				medicosUpdateForm();
				echo '
				</div>
			</div>
		</div>';
}

/*
* Tarjeta de los Datos Generales de los Usuarios.
* Registra y modifica los Usuarios (Registro, Listado y Actualización).
*/
function tarjetaUsuarios() {
	echo '
		<div id="page2" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaPacientes">	
			  	<h4>Ingreso de pacientes</h4>
				<div class="w3-container w3-whitegray">
					<h2>Ingresar usuario</h2>
					<form action="/action_page.php">
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorNombre">Nombre del usuario</label>
					  <input type="text" id="dname" name="doctorNombre" placeholder="Su nombre completo">
						</div>
						<div class="w3-third w3-margin-bottom"> 
					  <label for="doctorArea">Sexo</label>
					  <input type="text" id="darea" name="doctorArea" placeholder="Sexo">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorCel">Ocupacion</label>
					  <input type="text" id="dcel" name="doctorCel" placeholder="Ocupacion">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorNombre">Domicilio</label>
					  <input type="text" id="dname" name="doctorNombre" placeholder="Domicilio completo">
						</div>
						<div class="w3-third w3-margin-bottom">  
					  <label for="doctorArea">Lugar de nacimiento</label>
					  <input type="text" id="darea" name="doctorArea" placeholder="Estado y localidad">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorCel">Fecha de nacimiento</label>
					  <input type="text" id="dcel" name="doctorCel" placeholder="Su fecha de nacimiento">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorNombre">Estado civil</label>
					  <input type="text" id="dname" name="doctorNombre" placeholder="Su estado civil">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorArea">Escolaridad</label>
					  <input type="text" id="darea" name="doctorArea" placeholder="Nivel terminado">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorCel">Edad</label>
					  <input type="text" id="dcel" name="doctorCel" placeholder="Su edad en anos">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorNombre">Telefono de casa</label>
					  <input type="text" id="dname" name="doctorNombre" placeholder="Incluyendo lada">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorArea">Celular</label>
					  <input type="text" id="darea" name="doctorArea" placeholder="Su telefono de celular">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorCel">Telefono del trabajo</label>
					  <input type="text" id="dcel" name="doctorCel" placeholder="Telefono del trabajo (extension)">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorNombre">Correo electronico</label>
					  <input type="text" id="dname" name="doctorNombre" placeholder="Su e-mail">
						</div>
						<div class="w3-third w3-margin-bottom">
					  <label for="doctorArea">FolioID</label>
					  <input type="text" id="darea" name="doctorArea" placeholder="Folio ID">
						</div>
						<div class="w3-third">
					  <label for="doctorCel">IDUIEM</label>
					  <input type="text" id="dcel" name="doctorCel" placeholder="IDUIEM">
						</div>
						<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Registro nuevo  ">
					</form>
				</div>
				<div class="lista">
				<h4>Usuarios registrados:</h4>	';
				writePeopleTable();
				echo '
				</div>				
			</div>	
		</div>';
}

/*
* Tarjeta de los Datos Generales de los Protocolos.
* Registra y modifica los Protocolos (Registro, Listado y Actualización).
*/
function tarjetaProtocolos() {
	echo '
		<div id="page3" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjeta_protocolos">
				<h4>Protocolos de investigacion</h4>
				<div class="w3-container w3-whitegray">
					<h2>Registro de protocolos</h2>
					<div class="w3-row-padding" style="margin:8 -16px">
						<form action="/action_page.php">
							<div class="w3-third">
								<label for="protocoloName">Nombre del protocolo</label>
								<input type="text" id="fname" name="firstname" placeholder="Nombre del protocolo..">
							</div>
							<div class="w3-row-padding" style="margin:8 -16px">    
								<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Registrar protocolo">
							</div>
						</form>	
					</div>
				</div>
				<div class="lista">	
				<h4>Protocolos registrados:</h4>	';
				writeProtocoloTable();
				echo '
				</div>			
			</div>	
		</div>';
}

/*
* Formulario HTML para modificar los datos de los Médicos.
* Actualiza la información y sólo se construye si es seleccionado un médico en particular.
* @ Recibe $medicoID a partir de writeMedicosTable().
*/
function medicosUpdateForm() {
	global $nameErr, $emailErr, $celularErr, $medicoID;
	$datos = getDataMedicos($medicoID);
	$MedicosID = $Nombre_medico = $Especialidad = $Cel_medico = $Email_medico = "";
	foreach($datos as $row) {
		$MedicosID = $row['MedicosID'];
		$Nombre_medico = $row['Nombre_medico'];
		$Especialidad = $row['Especialidad'];
		$Cel_medico = $row['Cel_medico'];
		$Email_medico = $row['Email_medico'];
	}
	if ($medicoID) {
			echo '
		<!--<div class="w3-row-padding" style="margin:8 -16px">-->
			<form id="update_medicos" action="" method="post" accept-charset="utf-8">
				<div class="w3-third w3-margin-bottom">
					<label for="doctorName">Nombre del médico</label>
					<input type="text" id="dname" name="Nombre_medico" placeholder="Su nombre completo.." value="'.$Nombre_medico.'"><span class="error"> * '.$nameErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="especialidad">Especialidad</label>
					<input type="text" id="darea" name="Especialidad" placeholder="Su área de especialidad.." value="'.$Especialidad.'">
				</div>
				<div class="w3-third">
					<label for="doctorCel">Celular</label>
					<input type="text" id="doctorCel" name="Cel_medico" placeholder="Su teléfono de celular.." value="'.$Cel_medico.'"><span class="error"> * '.$celularErr.'</span>
				</div>
				<div class="w3-third">
					<label for="doctorEmail">Correo electrónico</label>
					<input type="text" id="doctorEmail" name="Email_medico" placeholder="Su correo electrónico.." value="'.$Email_medico.'"><span class="error"> * '.$emailErr.'</span>
				</div>
					<input type="hidden" name="MedicosID" value="'.$MedicosID.'" />
					<input type="hidden" name="action" value="updateMedico" />
					<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Aceptar" name="submit">
			</form>
		<!--</div>-->';
	}
	else {
		echo 'no update Form';
	}
}

/*
* Tabla HTML de los Medicos.
* Genera la lista completa de los médicos y permite seleccionar sólo un médico ($medicoID).
* @ $medicoID se define en el main (rcpip-incmnsz.php).
*/
function writeMedicosTable() {
	// Escribe la Tabla de Médicos
	global $medicoID;
	$datos = getDataMedicos($medicoID);
	echo '
		<table id="Medicos">
		';
	foreach($datos as $row) {
		echo '
		<form action="" method="post" accept-charset="utf-8">
			<tr>
				<td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
				<td>'.$row['MedicosID'].'</td>
				<td>'.$row['Nombre_medico'].'</td>
				<td>'.$row['Especialidad'].'</td>
				<td>'.$row['Cel_medico'].'</td>
				<td>'.$row['Email_medico'].'</td>
				<td>
					<input type="hidden" name="medicoID" value="'.$row['MedicosID'].'">
					<!--<input type="hidden" name="action" value="selectMedico" />-->
					<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Modificar">
				</td>
			</tr>
		</form>';
  	}
	echo '
		
		</table>';
}

/*
* Construye el HTML de incio al sistema.
* Muestra la vista de ingreso cuando no se autentica.
*/
function showGuestUserForm() {
    echo '
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
    <title>Ingreso al sistema RCPIP</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/bootstrap2.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/signin.css" rel="stylesheet">
  	</head>
  	<body id="page" class="w3-light-grey w3-content" style="max-width:1600px">
  		<div class="container">
  		<div id="logo">
  			<img src="imgs/incmnsz.png">
  		</div>
  			<form class="form-signin" action="" method="post" accept-charset="utf-8">
  			  <h2 class="form-signin-heading">Bienvenido</h2>
  				<input type="hidden" name="action" value="login" />
  				<input type="hidden" name="remember" value="0" />
  				<label for="inputEmail" class="sr-only">Correo electrónico</label>
  				<input type="text" class="form-control" name="email" placeholder="Dirección de correo-e" />
  				<label for="inputPassword" class="sr-only">Contraseña</label>
  				<input type="password" class="form-control" name="password" placeholder="Contraseña" />
  				<div class="checkbox">
					<label>
						<input default:0 checked value="1" name="remember" type="checkbox"> Recordarme
					</label>
        		</div>
        		<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        	</form>
        </div>';
	/*	echo '<h1>Public</h1>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="login" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<input type="text" name="password" placeholder="Password" /> ';
	echo '<select name="remember" size="1">';
	echo '<option value="0">Remember (keep logged in)? — No</option>';
	echo '<option value="1">Remember (keep logged in)? — Yes</option>';
	echo '</select> ';
	echo '<button type="submit">Log in with email address</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="login" />';
	echo '<input type="text" name="username" placeholder="Username" /> ';
	echo '<input type="text" name="password" placeholder="Password" /> ';
	echo '<select name="remember" size="1">';
	echo '<option value="0">Remember (keep logged in)? — No</option>';
	echo '<option value="1">Remember (keep logged in)? — Yes</option>';
	echo '</select> ';
	echo '<button type="submit">Log in with username</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="register" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<input type="text" name="password" placeholder="Password" /> ';
	echo '<input type="text" name="username" placeholder="Username (optional)" /> ';
	echo '<select name="require_verification" size="1">';
	echo '<option value="0">Require email confirmation? — No</option>';
	echo '<option value="1">Require email confirmation? — Yes</option>';
	echo '</select> ';
	echo '<select name="require_unique_username" size="1">';
	echo '<option value="0">Username — Any</option>';
	echo '<option value="1">Username — Unique</option>';
	echo '</select> ';
	echo '<button type="submit">Register</button>';
	echo '</form>';

	\showConfirmEmailForm();

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="forgotPassword" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<button type="submit">Forgot password</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="resetPassword" />';
	echo '<input type="text" name="selector" placeholder="Selector" /> ';
	echo '<input type="text" name="token" placeholder="Token" /> ';
	echo '<input type="text" name="password" placeholder="New password" /> ';
	echo '<button type="submit">Reset password</button>';
	echo '</form>';
	*/
}

/*
// R24hrs
function writeR24hrsTable() {
	// Escribe la Tabla de Protocolo
	$datos = getDataR24hrs();
	echo '
		<table id="R24hrs">';
	foreach($datos as $row) {
		echo '
			<tr>
				<td>'.$row['R24hrsID'].'</td>
				<td>'.$row['PeopleID'].'</td>
				<td>'.$row['A1'].'</td>
				<td>'.$row['A1_lugar'].'</td>
				<td>'.$row['A1_prep'].'</td>
				<td>'.$row['C1'].'</td>
				<td>'.$row['C1_lugar'].'</td>
				<td>'.$row['C1_prep'].'</td>
				<td>'.$row['A2'].'</td>
				<td>'.$row['A2_lugar'].'</td>
				<td>'.$row['A2_prep'].'</td>
				<td>'.$row['C2'].'</td>
				<td>'.$row['C2_lugar'].'</td>
				<td>'.$row['C2_prep'].'</td>
				<td>'.$row['A3'].'</td>
				<td>'.$row['A3_lugar'].'</td>
				<td>'.$row['A3_prep'].'</td>
				<td><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a></td>
			</tr>';
  	}
	echo '
		</table>';
}*/

///////////////////   Otras no utilizadas   //////////////////////////////////////////////////////
function showConfirmEmailForm() {
	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="confirmEmail" />';
	echo '<input type="text" name="selector" placeholder="Selector" /> ';
	echo '<input type="text" name="token" placeholder="Token" /> ';
	echo '<select name="login" size="1">';
	echo '<option value="0">Sign in automatically? — No</option>';
	echo '<option value="1">Sign in automatically? — Yes</option>';
	echo '<option value="2">Sign in automatically? — Yes (and remember)</option>';
	echo '</select> ';
	echo '<button type="submit">Confirm email</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="resendConfirmationForEmail" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<button type="submit">Re-send confirmation</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="resendConfirmationForUserId" />';
	echo '<input type="text" name="userId" placeholder="User ID" /> ';
	echo '<button type="submit">Re-send confirmation</button>';
	echo '</form>';
}

function showAdminUserForm() {
	echo '<h1>Administration</h1>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.createUser" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<input type="text" name="password" placeholder="Password" /> ';
	echo '<input type="text" name="username" placeholder="Username (optional)" /> ';
	echo '<select name="require_unique_username" size="1">';
	echo '<option value="0">Username — Any</option>';
	echo '<option value="1">Username — Unique</option>';
	echo '</select> ';
	echo '<button type="submit">Create user</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.deleteUser" />';
	echo '<input type="text" name="id" placeholder="ID" /> ';
	echo '<button type="submit">Delete user by ID</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.deleteUser" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<button type="submit">Delete user by email</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.deleteUser" />';
	echo '<input type="text" name="username" placeholder="Username" /> ';
	echo '<button type="submit">Delete user by username</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.addRole" />';
	echo '<input type="text" name="id" placeholder="ID" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Add role for user by ID</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.addRole" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Add role for user by email</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.addRole" />';
	echo '<input type="text" name="username" placeholder="Username" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Add role for user by username</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.removeRole" />';
	echo '<input type="text" name="id" placeholder="ID" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Remove role for user by ID</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.removeRole" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Remove role for user by email</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.removeRole" />';
	echo '<input type="text" name="username" placeholder="Username" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Remove role for user by username</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.hasRole" />';
	echo '<input type="text" name="id" placeholder="ID" /> ';
	echo '<select name="role">' . \createRolesOptions() . '</select>';
	echo '<button type="submit">Does user have role?</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.logInAsUserById" />';
	echo '<input type="text" name="id" placeholder="ID" /> ';
	echo '<button type="submit">Log in as user by ID</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.logInAsUserByEmail" />';
	echo '<input type="text" name="email" placeholder="Email address" /> ';
	echo '<button type="submit">Log in as user by email address</button>';
	echo '</form>';

	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="action" value="admin.logInAsUserByUsername" />';
	echo '<input type="text" name="username" placeholder="Username" /> ';
	echo '<button type="submit">Log in as user by username</button>';
	echo '</form>';
}

function showGeneralForm() {
    //echo '<meta charset="utf-8">';

 //    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 //    <meta name="description" content="">
 //    <meta name="author" content="">
 //    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
 //    <title>Ingreso al sistema RCPIP</title>
 //    <!-- Bootstrap core CSS -->
 //    <link href="bootstrap/bootstrap2.css" rel="stylesheet">
 //    <!-- Custom styles for this template -->
 //    <link href="bootstrap/signin.css" rel="stylesheet">
 //  </head>';
 //  	echo '<div class="container">';
 //  	echo "\n";
 //  	echo '<form class="form-signin" action="" method="post" accept-charset="utf-8">';
	// echo '<h2 class="form-signin-heading">Bienvenido al sitio</h2>';
	// echo '<input type="hidden" name="action" value="login" />';
	// echo '<input type="hidden" name="remember" value="0" />';
	// echo '<label for="inputEmail" class="sr-only">Correo electrónico</label>';
	// echo '<input type="text" class="form-control" name="email" placeholder="Dirección de correo-e" /> ';
	// echo '<label for="inputPassword" class="sr-only">Contraseña</label>';
	// echo '<input type="password" class="form-control" name="password" placeholder="Contraseña" /> ';
	// echo '<select name="remember" size="1">';
	// echo '<option value="0">Recordarme (dentro del sitio)? — No</option>';
	// echo '<option value="1">Recordarme (dentro del sitio)? — Sí</option>';
	// echo '</select> ';
 //    echo '<div class="checkbox">
 //          <label>
 //            <input default:0 checked value="1" name="remember" type="checkbox"> Recordarme
 //          </label>
 //        </div>';
	// echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>';
	// echo '</form>';

	//echo '<form class="form-signin" action="" method="get" accept-charset="utf-8">';
	//echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Recargar página</button>';
	//echo '</form>';
	//echo '</div>';
}

?>