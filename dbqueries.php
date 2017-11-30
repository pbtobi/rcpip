<?php require_once('connections/rcpip.php');
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
$db = new \PDO('mysql:dbname=rcpip;host=localhost;charset=utf8mb4', $dbuser_rcpip, $dbpass_rcpip);
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
					
					if (empty($_POST['Email_medico'])) {
						$emailErr = "El correo electrónico es obligatorio";
					}

					if (!empty($_POST['Nombre_medico']) && !empty($_POST['Email_medico'])) {
						if (!filter_var($_POST['Email_medico'], FILTER_VALIDATE_EMAIL)) {
							$emailErr = "El formato del correo es inválido";
						} 
						else {
							addMedico('', $_POST['Nombre_medico'], $_POST['Especialidad'],$_POST['Cel_medico'], $_POST['Email_medico']);
							echo "Ingreso satisfactorio";							
						}
					} 
				//}
				//catch (PDOException $ex) {
				//	return "Error al ingresar un nuevo Médico";
				//	echo $ex->getMessage();
				//	echo "error";
				//}
			}
			else if ($_POST['action'] === 'selectMedico') {
				global $medicoID;
				$medicoID = $_POST['MedicosID'];
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
			else {
				throw new Exception('Unexpected action: ' . $_POST['action']);
			}
		}
	}
	return null;
}

$datosProtocolo = getDataProtocolo();

/*
 * Peticiones a la base de datos (SELECT, INSERT, UPDATE)
 * Todas las funciones devuelven un objeto PDO o actúan modificando la base de datos
 ***********************************************************************************************
 */
/// Peticiones
//
function getDataProtocolo() {
	global $db;
	$stmt = $db->query("SELECT * FROM Protocolo");
	return $stmt;
}

function getDataMedicos($medicosID) {
	global $db;
	if ($medicosID) {
		$stmt = $db->query("SELECT * FROM Medicos WHERE medicosID='".$medicosID."'");
	} else {
		$stmt = $db->query("SELECT * FROM Medicos");
	}
	return $stmt;
}

function getDataPeople() {
	global $db;
	$stmt = $db->query("SELECT * FROM People");
	return $stmt;
}

function getDataR24hrs() {
	global $db;
	$stmt = $db->query("SELECT * FROM R24hrs");
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

function addMedico($field1,$field2,$field3,$field4) {
	global $db;
	$stmt = $db->prepare("INSERT INTO Medicos(Nombre_medico,Especialidad,Cel_medico,Email_medico) VALUES(:field1,:field2,:field3,:field4)");
	$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4));
}


?>