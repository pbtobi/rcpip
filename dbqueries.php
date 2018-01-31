<?php require_once('connections/rcpip.php');
//require_once('connections/rcpip000.php');
/*
 * dbqueries.php
 *
 * Accesos a la base de datos (conexión PDO, autenticación al sistema y peticiones).
 * RCPIyP INCMNSZ 2017
 *
 **********************************************************************************************
 **********************************************************************************************/


// enable error reporting
\error_reporting(\E_ALL);
\ini_set('display_errors', 'stdout');

// enable assertions
\ini_set('assert.active', 1);
@\ini_set('zend.assertions', 1);
\ini_set('assert.exception', 1);

\header('Content-type: text/html; charset=utf-8');
require __DIR__.'/vendor/autoload.php';
$db = new \PDO('mysql:dbname=rcpip;host=localhost;charset=utf8', $dbuser_rcpip, $dbpass_rcpip);
//$db = new \PDO('mysql:dbname=id4324054_rcpip;host=localhost;charset=utf8', $dbuser_rcpip, $dbpass_rcpip);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

/*
 * Procesa todas las variables $_POST de los formularios y gestiona el ingreso al sistema
 * La función principal al ingresar al sistema.
 */
function processRequestData(\Delight\Auth\Auth $auth) {
	if (isset($_POST)) {
		if (isset($_POST['action'])) {
			if ($_POST['action'] === 'login') {
				if ($_POST['remember'] == 1) {
					// keep logged in for one year
					$rememberDuration = (int) (60 * 60 * 24 * 365.25);
				}
				else {
					// do not keep logged in after session ends
					$rememberDuration = null;
				}

				try {
					if (isset($_POST['email'])) {
						$auth->login($_POST['email'], $_POST['password'], $rememberDuration);
					}
					elseif (isset($_POST['username'])) {
						$auth->loginWithUsername($_POST['username'], $_POST['password'], $rememberDuration);
					}
					else {
						return 'either email address or username required';
					}

					return 'ok';
				}
				catch (\Delight\Auth\InvalidEmailException $e) {
					return 'wrong email address';
				}
				catch (\Delight\Auth\UnknownUsernameException $e) {
					return 'unknown username';
				}
				catch (\Delight\Auth\AmbiguousUsernameException $e) {
					return 'ambiguous username';
				}
				catch (\Delight\Auth\InvalidPasswordException $e) {
					return 'wrong password';
				}
				catch (\Delight\Auth\EmailNotVerifiedException $e) {
					return 'email address not verified';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'register') {
				try {
					if ($_POST['require_verification'] == 1) {
						$callback = function ($selector, $token) {
							echo '<pre>';
							echo 'Email confirmation';
							echo "\n";
							echo '  >  Selector';
							echo "\t\t\t\t";
							echo \htmlspecialchars($selector);
							echo "\n";
							echo '  >  Token';
							echo "\t\t\t\t";
							echo \htmlspecialchars($token);
							echo '</pre>';
						};
					}
					else {
						$callback = null;
					}

					if (!isset($_POST['require_unique_username'])) {
						$_POST['require_unique_username'] = '0';
					}

					if ($_POST['require_unique_username'] == 0) {
						return $auth->register($_POST['email'], $_POST['password'], $_POST['username'], $callback);
					}
					else {
						return $auth->registerWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username'], $callback);
					}
				}
				catch (\Delight\Auth\InvalidEmailException $e) {
					return 'invalid email address';
				}
				catch (\Delight\Auth\InvalidPasswordException $e) {
					return 'invalid password';
				}
				catch (\Delight\Auth\UserAlreadyExistsException $e) {
					return 'email address already exists';
				}
				catch (\Delight\Auth\DuplicateUsernameException $e) {
					return 'username already exists';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'confirmEmail') {
				try {
					if (isset($_POST['login']) && $_POST['login'] > 0) {
						if ($_POST['login'] == 2) {
							// keep logged in for one year
							$rememberDuration = (int) (60 * 60 * 24 * 365.25);
						}
						else {
							// do not keep logged in after session ends
							$rememberDuration = null;
						}
						$auth->confirmEmailAndSignIn($_POST['selector'], $_POST['token'], $rememberDuration);
					}
					else {
						$auth->confirmEmail($_POST['selector'], $_POST['token']);
					}

					return 'ok';
				}
				catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
					return 'invalid token';
				}
				catch (\Delight\Auth\TokenExpiredException $e) {
					return 'token expired';
				}
				catch (\Delight\Auth\UserAlreadyExistsException $e) {
					return 'email address already exists';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'resendConfirmationForEmail') {
				try {
					$auth->resendConfirmationForEmail($_POST['email'], function ($selector, $token) {
						echo '<pre>';
						echo 'Email confirmation';
						echo "\n";
						echo '  >  Selector';
						echo "\t\t\t\t";
						echo \htmlspecialchars($selector);
						echo "\n";
						echo '  >  Token';
						echo "\t\t\t\t";
						echo \htmlspecialchars($token);
						echo '</pre>';
					});

					return 'ok';
				}
				catch (\Delight\Auth\ConfirmationRequestNotFound $e) {
					return 'no request found';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'resendConfirmationForUserId') {
				try {
					$auth->resendConfirmationForUserId($_POST['userId'], function ($selector, $token) {
						echo '<pre>';
						echo 'Email confirmation';
						echo "\n";
						echo '  >  Selector';
						echo "\t\t\t\t";
						echo \htmlspecialchars($selector);
						echo "\n";
						echo '  >  Token';
						echo "\t\t\t\t";
						echo \htmlspecialchars($token);
						echo '</pre>';
					});

					return 'ok';
				}
				catch (\Delight\Auth\ConfirmationRequestNotFound $e) {
					return 'no request found';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'forgotPassword') {
				try {
					$auth->forgotPassword($_POST['email'], function ($selector, $token) {
						echo '<pre>';
						echo 'Password reset';
						echo "\n";
						echo '  >  Selector';
						echo "\t\t\t\t";
						echo \htmlspecialchars($selector);
						echo "\n";
						echo '  >  Token';
						echo "\t\t\t\t";
						echo \htmlspecialchars($token);
						echo '</pre>';
					});

					return 'ok';
				}
				catch (\Delight\Auth\InvalidEmailException $e) {
					return 'invalid email address';
				}
				catch (\Delight\Auth\EmailNotVerifiedException $e) {
					return 'email address not verified';
				}
				catch (\Delight\Auth\ResetDisabledException $e) {
					return 'password reset disabled';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'resetPassword') {
				try {
					$auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['password']);

					return 'ok';
				}
				catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
					return 'invalid token';
				}
				catch (\Delight\Auth\TokenExpiredException $e) {
					return 'token expired';
				}
				catch (\Delight\Auth\ResetDisabledException $e) {
					return 'password reset disabled';
				}
				catch (\Delight\Auth\InvalidPasswordException $e) {
					return 'invalid password';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'reconfirmPassword') {
				try {
					return $auth->reconfirmPassword($_POST['password']) ? 'correct' : 'wrong';
				}
				catch (\Delight\Auth\NotLoggedInException $e) {
					return 'not logged in';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'changePassword') {
				try {
					$auth->changePassword($_POST['oldPassword'], $_POST['newPassword']);

					return 'ok';
				}
				catch (\Delight\Auth\NotLoggedInException $e) {
					return 'not logged in';
				}
				catch (\Delight\Auth\InvalidPasswordException $e) {
					return 'invalid password(s)';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'changePasswordWithoutOldPassword') {
				try {
					$auth->changePasswordWithoutOldPassword($_POST['newPassword']);

					return 'ok';
				}
				catch (\Delight\Auth\NotLoggedInException $e) {
					return 'not logged in';
				}
				catch (\Delight\Auth\InvalidPasswordException $e) {
					return 'invalid password';
				}
			}
			else if ($_POST['action'] === 'changeEmail') {
				try {
					$auth->changeEmail($_POST['newEmail'], function ($selector, $token) {
						echo '<pre>';
						echo 'Email confirmation';
						echo "\n";
						echo '  >  Selector';
						echo "\t\t\t\t";
						echo \htmlspecialchars($selector);
						echo "\n";
						echo '  >  Token';
						echo "\t\t\t\t";
						echo \htmlspecialchars($token);
						echo '</pre>';
					});

					return 'ok';
				}
				catch (\Delight\Auth\InvalidEmailException $e) {
					return 'invalid email address';
				}
				catch (\Delight\Auth\UserAlreadyExistsException $e) {
					return 'email address already exists';
				}
				catch (\Delight\Auth\EmailNotVerifiedException $e) {
					return 'account not verified';
				}
				catch (\Delight\Auth\NotLoggedInException $e) {
					return 'not logged in';
				}
				catch (\Delight\Auth\TooManyRequestsException $e) {
					return 'too many requests';
				}
			}
			else if ($_POST['action'] === 'setPasswordResetEnabled') {
				try {
					$auth->setPasswordResetEnabled($_POST['enabled'] == 1);

					return 'ok';
				}
				catch (\Delight\Auth\NotLoggedInException $e) {
					return 'not logged in';
				}
			}
			else if ($_POST['action'] === 'logOut') {
				$auth->logOut();

				return 'ok';
			}
			else if ($_POST['action'] === 'logOutAndDestroySession') {
				$auth->logOutAndDestroySession();

				return 'ok';
			}
			else if ($_POST['action'] === 'admin.createUser') {
				try {
					if (!isset($_POST['require_unique_username'])) {
						$_POST['require_unique_username'] = '0';
					}

					if ($_POST['require_unique_username'] == 0) {
						return $auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
					}
					else {
						return $auth->admin()->createUserWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username']);
					}
				}
				catch (\Delight\Auth\InvalidEmailException $e) {
					return 'invalid email address';
				}
				catch (\Delight\Auth\InvalidPasswordException $e) {
					return 'invalid password';
				}
				catch (\Delight\Auth\UserAlreadyExistsException $e) {
					return 'email address already exists';
				}
				catch (\Delight\Auth\DuplicateUsernameException $e) {
					return 'username already exists';
				}
			}
			else if ($_POST['action'] === 'admin.deleteUser') {
				if (isset($_POST['id'])) {
					try {
						$auth->admin()->deleteUserById($_POST['id']);
					}
					catch (\Delight\Auth\UnknownIdException $e) {
						return 'unknown ID';
					}
				}
				elseif (isset($_POST['email'])) {
					try {
						$auth->admin()->deleteUserByEmail($_POST['email']);
					}
					catch (\Delight\Auth\InvalidEmailException $e) {
						return 'unknown email address';
					}
				}
				elseif (isset($_POST['username'])) {
					try {
						$auth->admin()->deleteUserByUsername($_POST['username']);
					}
					catch (\Delight\Auth\UnknownUsernameException $e) {
						return 'unknown username';
					}
					catch (\Delight\Auth\AmbiguousUsernameException $e) {
						return 'ambiguous username';
					}
				}
				else {
					return 'either ID, email address or username required';
				}

				return 'ok';
			}
			else if ($_POST['action'] === 'admin.addRole') {
				if (isset($_POST['role'])) {
					if (isset($_POST['id'])) {
						try {
							$auth->admin()->addRoleForUserById($_POST['id'], $_POST['role']);
						}
						catch (\Delight\Auth\UnknownIdException $e) {
							return 'unknown ID';
						}
					}
					elseif (isset($_POST['email'])) {
						try {
							$auth->admin()->addRoleForUserByEmail($_POST['email'], $_POST['role']);
						}
						catch (\Delight\Auth\InvalidEmailException $e) {
							return 'unknown email address';
						}
					}
					elseif (isset($_POST['username'])) {
						try {
							$auth->admin()->addRoleForUserByUsername($_POST['username'], $_POST['role']);
						}
						catch (\Delight\Auth\UnknownUsernameException $e) {
							return 'unknown username';
						}
						catch (\Delight\Auth\AmbiguousUsernameException $e) {
							return 'ambiguous username';
						}
					}
					else {
						return 'either ID, email address or username required';
					}
				}
				else {
					return 'role required';
				}

				return 'ok';
			}
			else if ($_POST['action'] === 'admin.removeRole') {
				if (isset($_POST['role'])) {
					if (isset($_POST['id'])) {
						try {
							$auth->admin()->removeRoleForUserById($_POST['id'], $_POST['role']);
						}
						catch (\Delight\Auth\UnknownIdException $e) {
							return 'unknown ID';
						}
					}
					elseif (isset($_POST['email'])) {
						try {
							$auth->admin()->removeRoleForUserByEmail($_POST['email'], $_POST['role']);
						}
						catch (\Delight\Auth\InvalidEmailException $e) {
							return 'unknown email address';
						}
					}
					elseif (isset($_POST['username'])) {
						try {
							$auth->admin()->removeRoleForUserByUsername($_POST['username'], $_POST['role']);
						}
						catch (\Delight\Auth\UnknownUsernameException $e) {
							return 'unknown username';
						}
						catch (\Delight\Auth\AmbiguousUsernameException $e) {
							return 'ambiguous username';
						}
					}
					else {
						return 'either ID, email address or username required';
					}
				}
				else {
					return 'role required';
				}

				return 'ok';
			}
			else if ($_POST['action'] === 'admin.hasRole') {
				if (isset($_POST['id'])) {
					if (isset($_POST['role'])) {
						try {
							return $auth->admin()->doesUserHaveRole($_POST['id'], $_POST['role']) ? 'yes' : 'no';
						}
						catch (\Delight\Auth\UnknownIdException $e) {
							return 'unknown ID';
						}
					}
					else {
						return 'role required';
					}
				}
				else {
					return 'ID required';
				}
			}
			else if ($_POST['action'] === 'admin.logInAsUserById') {
				if (isset($_POST['id'])) {
					try {
						$auth->admin()->logInAsUserById($_POST['id']);

						return 'ok';
					}
					catch (\Delight\Auth\UnknownIdException $e) {
						return 'unknown ID';
					}
					catch (\Delight\Auth\EmailNotVerifiedException $e) {
						return 'email address not verified';
					}
				}
				else {
					return 'ID required';
				}
			}
			else if ($_POST['action'] === 'admin.logInAsUserByEmail') {
				if (isset($_POST['email'])) {
					try {
						$auth->admin()->logInAsUserByEmail($_POST['email']);

						return 'ok';
					}
					catch (\Delight\Auth\InvalidEmailException $e) {
						return 'unknown email address';
					}
					catch (\Delight\Auth\EmailNotVerifiedException $e) {
						return 'email address not verified';
					}
				}
				else {
					return 'Email address required';
				}
			}
			else if ($_POST['action'] === 'admin.logInAsUserByUsername') {
				if (isset($_POST['username'])) {
					try {
						$auth->admin()->logInAsUserByUsername($_POST['username']);

						return 'ok';
					}
					catch (\Delight\Auth\UnknownUsernameException $e) {
						return 'unknown username';
					}
					catch (\Delight\Auth\AmbiguousUsernameException $e) {
						return 'ambiguous username';
					}
					catch (\Delight\Auth\EmailNotVerifiedException $e) {
						return 'email address not verified';
					}
				}
				else {
					return 'Username required';
				}
			}
			// Agregando las acciones de los formularios del médico y/o administrador 
			else if ($_POST['action'] === 'addMedico') {
				//try {					
					if (empty($_POST['Nombre_medico'])) {
						$nombreErr = "El nombre es obligatorio";
					}
					
					if (empty($_POST['Cel_medico'])) {
						$celularErr = "El celular es obligatorio";
					}

					if (empty($_POST['Email_medico'])) {
						$emailErr = "El correo electrónico es obligatorio";
					}

					if (!empty($_POST['Nombre_medico']) && !empty($_POST['Cel_medico']) && !empty($_POST['Email_medico'])) {
						if (!filter_var($_POST['Email_medico'], FILTER_VALIDATE_EMAIL)) {
							$emailErr = "El formato del correo es inválido";
						} 
						else {
							addMedico($_POST['Nombre_medico'], $_POST['Especialidad'],$_POST['Cel_medico'], $_POST['Email_medico']);						
						}
					} 
				//}
				//catch (PDOException $ex) {
				//	return "Error al ingresar un nuevo Médico";
				//	echo $ex->getMessage();
				//	echo "error";
				//}
			}
			else if ($_POST['action'] === 'addUsuario') {				
				if (empty($_POST['Nombre'])) {
					$nombreErr = "El nombre es obligatorio";
				}
				
				if (empty($_POST['Celular'])) {
					$celularErr = "El celular es obligatorio";
				}

				if (empty($_POST['Email'])) {
					$emailErr = "El correo electrónico es obligatorio";
				}

				if (!empty($_POST['Nombre']) && !empty($_POST['Celular']) && !empty($_POST['Email'])) {
					if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
						$emailErr = "El formato del correo es inválido";
					} 
					else {
						$roleUsuario = '';
						if ($_POST['rol'] == '1') {
							$roleUsuario = '';
						}
						if ($_POST['rol'] == '2') {
							$roleUsuario = '';
						}
						if ($_POST['rol'] == '3') {
							$roleUsuario = '8193';
						}
						if ($_POST['Sexo'] == 'Hombre' || $_POST['Sexo'] == 'Mujer') {
							$last_id = addUsuario($_POST['Nombre'], $_POST['Sexo'],$_POST['Ocupacion'], $_POST['Domicilio'], $_POST['Lugar_nacimiento'],
							$_POST['Fecha_nacimiento'], $_POST['Estado_civil'],$_POST['Escolaridad'], $_POST['Edad'], $_POST['Tel_casa'],
							$_POST['Celular'], $_POST['Tel_trabajo'],$_POST['Email'], $roleUsuario, $_POST['FolioID'],
							$_POST['IDUIEM']);
							return $last_id;
						} else {
							$nombreErr = "Datos incorrectos";
						}
					}
				} 
			}
			else if ($_POST['action'] === 'addProtocolo') {			
				if (empty($_POST['Protocolo'])) {
					$nombreErr = "El nombre del protocolo es obligatorio";
				}
				else {
					addProtocolo($_POST['Protocolo']);						
				} 
			}
			else if ($_POST['action'] === 'selectMedico') {
				global $medicoID;
				$medicoID = $_POST['MedicosID'];
			}
			else if ($_POST['action'] === 'selectUsuario') {
				global $usuarioID;
				$usuarioID = $_POST['PeopleID'];
			}
			else if ($_POST['action'] === 'selectProtocolo') {
				global $protocoloID;
				$protocoloID = $_POST['ProtocoloID'];
			}
			else if ($_POST['action'] === 'updateMedico') {
				if (isset($_POST['MedicosID'])) {
					if (empty($_POST['Nombre_medico'])) {
						$nombreErr = "El nombre es obligatorio";
					}
					
					if (empty($_POST['Email_medico'])) {
						$emailErr = "El correo electrónico es obligatorio";
					}

					if (!empty($_POST['Nombre_medico']) && !empty($_POST['Email_medico'])) {
						if (!filter_var($_POST['Email_medico'], FILTER_VALIDATE_EMAIL)) {
							$emailErr = "El formato del correo es inválido";
						} 
						else {
							updateMedico($_POST['MedicosID'], $_POST['Nombre_medico'], $_POST['Especialidad'],$_POST['Cel_medico'], $_POST['Email_medico']);
							// regresa al estado incial (sin médico seleccionado)
							$medicoID = "";
						}
					}
				}
			}
			else if ($_POST['action'] === 'updateUsuario') {
				if (isset($_POST['PeopleID'])) {
					$campos_correctos = 1;
					if (empty($_POST['Nombre'])) {
						$nombreErr = "El nombre es obligatorio";
					}
					
					if (empty($_POST['Celular'])) {
						$celularErr = "El celular es obligatorio";
					}

					if (empty($_POST['Email'])) {
						$emailErr = "El correo electrónico es obligatorio";
					}

					if (empty($_POST['Sexo'])) {
						$sexoErr = "El sexo es obligatorio";
					}

					if (empty($_POST['Fecha_nacimiento'])) {
						$fechaErr = "La fecha es obligatoria";
					}

					if (empty($_POST['Estado_civil'])) {
						$ecivilErr = "El estado civil es obligatorio";
					}

					if (empty($_POST['Escolaridad'])) {
						$escolarErr = "La escolaridad es obligatoria";
					}

					if (empty($_POST['Sexo']) || empty($_POST['Fecha_nacimiento']) || empty($_POST['Estado_civil']) || empty($_POST['Escolaridad']) ) {
						$campos_correctos = 0;
					}

					if (!empty($_POST['Nombre']) && !empty($_POST['Celular']) && !empty($_POST['Email']) && $campos_correctos == 1) {
						if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
							$emailErr = "El formato del correo es inválido";
						} 
						else {
							updateUsuario($_POST['PeopleID'], $_POST['Nombre'], $_POST['Sexo'],$_POST['Ocupacion'], $_POST['Domicilio'],
								$_POST['Lugar_nacimiento'], $_POST['Fecha_nacimiento'], $_POST['Estado_civil'],$_POST['Escolaridad'], $_POST['Edad'],
								$_POST['Tel_casa'], $_POST['Celular'], $_POST['Tel_trabajo'],$_POST['Email'], $_POST['role'],
								$_POST['FolioID'], $_POST['IDUIEM']);
							// regresa al estado incial (sin usuario seleccionado)
							$usuarioID = "";
						}
					}
				}
			}
			else if ($_POST['action'] === 'updateProtocolo') {
				if (isset($_POST['ProtocoloID'])) {
					if (empty($_POST['Protocolo'])) {
						$nombreErr = "El nombre del protocolo es obligatorio";
					}
					else {
						updateProtocolo($_POST['ProtocoloID'], $_POST['Protocolo']);
						// regresa al estado incial (sin protocolo seleccionado)
						$protocoloID = "";
					}
				}
			}
			else if ($_POST['action'] === 'updateConsInfo') {
				global $ci_acepta;
				$ci_entrevista = "";
				if (isset($_POST['consentimiento'])) {
					if (empty($_POST['consentimiento'])) {
						# do nothing
						$ci_acepta = NULL;
					}
					else {
						$mivar = setConsInfo($_POST['PeopleID'], $_POST['PeopleID'], $_POST['consentimiento'], $ci_entrevista);
						// regresa al estado incial (sin protocolo seleccionado)
						$ci_acepta = $_POST['consentimiento'];
					}
				}
			}
			else {
				throw new Exception('Unexpected action: ' . $_POST['action']);
			}
		}
	}
	return null;
}

//	$datosProtocolo = getDataProtocolo($protocoloID);

/*
 * Peticiones a la base de datos (SELECT, INSERT, UPDATE)
 * Todas las funciones devuelven un objeto PDO o actúan modificando la base de datos
 ***********************************************************************************************
 */
/// Peticiones
//
function getPeopleID() {
	global $PeopleID;
	return $PeopleID;
}

function getDataProtocolo($protocoloID) {
	global $db;
	if ($protocoloID) {
		$stmt = $db->query("SELECT * FROM protocolo WHERE ProtocoloID='".$protocoloID."'");
	} else {
		$stmt = $db->query("SELECT * FROM protocolo");
	}
	return $stmt;
}

function getDataMedicos($medicosID) {
	global $db;
	if ($medicosID) {
		$stmt = $db->query("SELECT * FROM Medicos WHERE MedicosID='".$medicosID."'");
	} else {
		$stmt = $db->query("SELECT * FROM Medicos");
	}
	return $stmt;
}

function getDataUsers($usuarioID, $role) {
	global $db;
	//$role = 0;
	if ($usuarioID) {
		$stmt = $db->query("SELECT * FROM users WHERE id='".$usuarioID."'");
	} else if ($role == 0) {
		$stmt = $db->query("SELECT * FROM users WHERE roles_mask='".$role."'");
	} else {
		$role = 0;
		$stmt = $db->query("SELECT * FROM users WHERE roles_mask!='".$role."'");
	}
	return $stmt;
}

function getDataUsersRoles($role) {
	global $db;
	//$role = 0;
	if ($role == 0) {
		$stmt = $db->query("SELECT * FROM users WHERE roles_mask='".$role."'");
	} else {
		$stmt = "No hay dato";
		//$stmt = $db->query("SELECT * FROM users");
	}
	return $stmt;
}

function getDataPeople($usuarioID) {
	global $db;
	if ($usuarioID) {
		$stmt = $db->query("SELECT * FROM people WHERE PeopleID='".$usuarioID."'");
	} else {
		$stmt = $db->query("SELECT * FROM people");
	}
	return $stmt;
}

<<<<<<< HEAD
function getDataCI($PeopleID){
	global $db;
	if ($PeopleID) {
		$stmt = $db->query("SELECT * FROM ci WHERE ci_id='".$PeopleID."'");
	} else {
		$stmt = $db->query("SELECT * FROM ci");
	}
	return $stmt;
}

function getDataR24hrs($PeopleID, $FechaR24) {
	global $db;
	if ($PeopleID && $FechaR24) {
		$stmt = $db->query("SELECT * FROM R24hrs WHERE PeopleID='".$PeopleID."' AND FechaR24='".$FechaR24."'");
	} else {
		$stmt = $db->query("SELECT * FROM R24hrs");
	}
	return $stmt;
}

function getFechasR24hrs($PeopleID){
	global $db;
	if ($PeopleID) {
		# code...
		$stmt = $db->query("SELECT `FechaR24`,`R24hrsID` FROM R24hrs WHERE PeopleID='".$PeopleID."'");
	} else {
		$stmt = $db->query("SELECT * FROM R24hrs");
=======
function getDataR24hrs($usuarioID, $fecha) {
	global $db;
	if ($usuarioID) {
		$stmt = $db->query("SELECT * FROM R24hrs WHERE PeopleID='".$usuarioID."'");
	} if ($fecha) {
		$stmt = $db->query("SELECT * FROM R24hrs WHERE PeopleID='".$usuarioID."' AND FechaR24='".$fecha."'");
	} else {
	$stmt = $db->query("SELECT * FROM R24hrs");
>>>>>>> bf7783abc5fbf8a97b2d4d14965d463833ebf214
	}
	return $stmt;
}

/// Modificaciones (agrega y actualiza registros)
//
function updateMedico($field1, $field2, $field3, $field4, $field5) {
	global $db;
	// Prepare statement
	//$sql = "UPDATE `medicos` SET `MedicosID`='".$field1."',`Nombre_medico`='".$field2."',`Especialidad`='".$field3."',`Cel_medico`='".$field4."',`Email_medico`='".$field5."' WHERE ".$reg;
	$stmt = $db->prepare("UPDATE Medicos SET Nombre_medico=:field2, Especialidad=:field3, Cel_medico=:field4, Email_medico=:field5 WHERE MedicosID=:field1");
	$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4, ':field5' => $field5));
}

function updateUsuario($field1, $field2, $field3, $field4, $field5, $field6, $field7, $field8, $field9, $field10, $field11, $field12, $field13, $field14, $field15, $field16, $field17) {
	// falta validar Fecha_nacimiento, Sexo, Estado_civil, rol, FolioID, IDUIEM
	global $db;
	if ($field3 == "Hombre") {
		$field3 = "H";
	} else if ($field3 == "Mujer") {
		$field3 = "M";
	}
	if ($field15 != "Médico" && $field15 != "Administrador" && $field15 != "Paciente") {
		$field15 = "Sin asignar";
	}
	$stmt = $db->prepare("UPDATE People SET Nombre=:field2, Sexo=:field3, Ocupacion=:field4, Domicilio=:field5, Lugar_nacimiento=:field6, Fecha_nacimiento=:field7, Estado_civil=:field8, Escolaridad=:field9, Edad=:field10,
		Tel_casa=:field11, Celular=:field12, Tel_trabajo=:field13, Email=:field14, rol=:field15, FolioID=:field16, IDUIEM=:field17 WHERE PeopleID=:field1");
	$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4, ':field5' => $field5, ':field6' => $field6, ':field7' => $field7,
		 ':field8' => $field8, ':field9' => $field9, ':field10' => $field10, ':field11' => $field11, ':field12' => $field12, ':field13' => $field13, ':field14' => $field14, ':field15' => $field15,
		 ':field16' => $field16, ':field17' => $field17));
}

function updateProtocolo($field1, $field2) {
	global $db;
	$stmt = $db->prepare("UPDATE Protocolo SET Protocolo=:field2 WHERE ProtocoloID=:field1");
	$stmt->execute(array(':field1' => $field1, ':field2' => $field2));
}

<<<<<<< HEAD
function setConsInfo($field1, $field2, $field3, $field4){
	# field1 es PeopleID := CIID
	global $db, $PeopleID;
	$return = getDataCI($field1);
	$data_exists = ($return->fetchColumn() > 0) ? true : false;
	# Convierte en la base de datos ci_acepta := 0|1
	if ($field3 == "true") {
		$field3 = 1;
	} else {
		$field3 = 0;
	}
	if ($data_exists == false) {
		#return $data_exists;
		# Inserta nuevo registro (Insert)
		$stmt = $db->prepare("INSERT INTO ci(ci_id,ci_peopleID,ci_acepta,ci_entrevista) VALUES (:field1,:field2,:field3,:field4)");
		$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4));
	} else {
		# Modifica (Update)
		$stmt = $db->prepare("UPDATE ci SET ci_acepta=:field3 WHERE ci_id=:field1");
		$stmt->execute(array(':field1' => $field1, ':field3' => $field3));
=======
function addR24hrs($field1, $field2, $field3, $field4, $field5, $field6, $field7, $field8, $field9, $field10, $field11, $field12, $field13, $field14, $field15, $field16, $field17) {
	global 	$dateErr, $db;
	$empty_user = 0;
	$return = getDataPeople($field1);
	$data_exists = ($return->fetchColumn() > 0) ? true : false;
	if ($data_exists == false) {
		$empty_user = 1;
	}
	if (!filter_var($field14, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "El correo electrónico no es válido";
      return $emailErr;
    } else if ($empty_user == 1) {
    	// no existe el usuario (vacío = true = 1)
    	$field3 = $field4 = $field5 = $field6 = $field7 = $field8 = $field9 = $field10 = $field11 = $field12 = $field13 = $field15 = $field16 = $field17 = NULL;
		$stmt = $db->prepare("INSERT INTO People(PeopleID,Nombre,Sexo,Ocupacion,Domicilio,Lugar_nacimiento,Fecha_nacimiento,Estado_civil,Escolaridad,Edad,Tel_casa,Celular,Tel_trabajo,Email,rol,FolioID,IDUIEM) 
			VALUES (:field1,:field2,:field3,:field4,:field5,:field6,:field7,:field8,:field9,:field10,:field11,:field12,:field13,:field14,:field15,:field16,:field17)");
		$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4, ':field5' => $field5, ':field6' => $field6, ':field7' => $field7, ':field8' => $field8,
			':field9' => $field9, ':field10' => $field10, ':field11' => $field11, ':field12' => $field12, ':field13' => $field13, ':field14' => $field14, ':field15' => $field15, ':field16' => $field16, ':field17' => $field17));
		$LAST_ID = $db->lastInsertId();
		return $LAST_ID;
	} else {
		// ya existe el usuario
		$usuarioID = $field1;
		return "<p id='registro_usuario'>".$data_exists." <i>Registro ".$usuarioID."</i></p>";
>>>>>>> bf7783abc5fbf8a97b2d4d14965d463833ebf214
	}
}

function addMedico($field1, $field2, $field3, $field4) {
	global 	$emailErr, $db;
	if (!filter_var($field4, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "dbqueries.php: El correo electrónico no es válido";
      return $emailErr;
    }
    else {
		$stmt = $db->prepare("INSERT INTO Medicos(Nombre_medico,Especialidad,Cel_medico,Email_medico) VALUES (:field1,:field2,:field3,:field4)");
		$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4));
	}
}

function addUsuario($field1, $field2, $field14) {
	global 	$emailErr, $db;
	$empty_user = 0;
	$return = getDataPeople($field1);
	$data_exists = ($return->fetchColumn() > 0) ? true : false;
	if ($data_exists == false) {
		$empty_user = 1;
	}
	if (!filter_var($field14, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "El correo electrónico no es válido";
      return $emailErr;
    } else if ($empty_user == 1) {
    	// no existe el usuario (vacío = true = 1)
    	$field3 = $field4 = $field5 = $field6 = $field7 = $field8 = $field9 = $field10 = $field11 = $field12 = $field13 = $field15 = $field16 = $field17 = NULL;
		$stmt = $db->prepare("INSERT INTO People(PeopleID,Nombre,Sexo,Ocupacion,Domicilio,Lugar_nacimiento,Fecha_nacimiento,Estado_civil,Escolaridad,Edad,Tel_casa,Celular,Tel_trabajo,Email,rol,FolioID,IDUIEM) 
			VALUES (:field1,:field2,:field3,:field4,:field5,:field6,:field7,:field8,:field9,:field10,:field11,:field12,:field13,:field14,:field15,:field16,:field17)");
		$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4, ':field5' => $field5, ':field6' => $field6, ':field7' => $field7, ':field8' => $field8,
			':field9' => $field9, ':field10' => $field10, ':field11' => $field11, ':field12' => $field12, ':field13' => $field13, ':field14' => $field14, ':field15' => $field15, ':field16' => $field16, ':field17' => $field17));
		$LAST_ID = $db->lastInsertId();
		return $LAST_ID;
	} else {
		// ya existe el usuario
		$usuarioID = $field1;
		return "<p id='registro_usuario'>".$data_exists." <i>Registro ".$usuarioID."</i></p>";
	}
}

function addProtocolo($field1) {
	global 	$nombreErr, $db;
	if (!$field1) {
      $nombreErr = "El nombre del protocolo es necesario";
      return $nombreErr;
    }
    else {
		$stmt = $db->prepare("INSERT INTO Protocolo (Protocolo) VALUES (:field1)");
		$stmt->execute(array(':field1' => $field1));
	}
}

?>