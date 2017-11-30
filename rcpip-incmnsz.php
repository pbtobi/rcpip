<?php require_once('connections/rcpip.php'); 
require_once('delight.php');

$auth = new \Delight\Auth\Auth($db);
$result = \processRequestData($auth);

/* define variables and set to empty values
  Formularios (Medicos) para recuperar las variables (globales)
***************************************************************/
$medicoID = $nameErr = $emailErr = $especialErr = $celularErr = "";
$doctorName = $doctorEmail = $especialidad = $celular = "";
// Estrategia de prueba para pasar variables de los formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["doctorName"])) {
    $nameErr = "El nombre es obligatorio";
  } else {
    $doctorName = test_input($_POST["doctorName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$doctorName)) {
      $nameErr = "";
    }
  }
  
  if (empty($_POST["doctorEmail"])) {
    $emailErr = "El correo electrónico es obligatorio";
  } else {
    $doctorEmail = test_input($_POST["doctorEmail"]);
    // check if e-mail address is well-formed
    if (!filter_var($doctorEmail, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "El correo electrónico no es válido";
    }
  }

  if (empty($_POST["especialidad"])) {
    $especialidad = "";
  } else {
    $especialidad = test_input($_POST["especialidad"]);
  }

  if (empty($_POST["celular"])) {
    $celularErr = "El celular es obligatorio";
  } else {
    $celular = test_input($_POST["celular"]);
  }
  // elige un médico en particular
  if (empty($_POST["medicoID"])) {
    // echo 'do nothing';
    // $medicoID es vacía cuando no hay formulario que la genere (evita undefined error)
    $medicoID = "";
  }
  else {
    $medicoID = ($_POST["medicoID"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

\showHtmlHead();
//\showDebugData($auth, $result);

if ($auth->check()) {
  //\showAuthenticatedUserForm($auth);

  showSidebarNav();
  showHeader();
  showViewChanges();

  \tarjetaMedicos();
  \tarjetaProtocolos();
  \tarjetaUsuarios();
    echo '
    </div>
      ';
  //writePeopleDatos();
  //echo $medicoID;

  //\header("Location: ". "rcpip-incmnsz.php" );
}
else {
  \showGuestUserForm();
}

if ($auth->hasAnyRole(\Delight\Auth\Role::DEVELOPER, \Delight\Auth\Role::MANAGER)) {
    // the user is either a developer, or a manager, or both
  //\showDebugData($auth, $result);
  //\showAdminUserForm($auth);
}

try {
  /*
  writeProtocoloTable();
  writeProtocoloDatos();
  echo '<b>Total de registros: </b>';
  writeProtocoloTotalRegistros();
  echo '<br><br>';
  */

} catch(PDOException $ex) {
    echo "An Error occured my friend!"; //user friendly message
   //handle me.
}

?>

    <!-- Footer -->
    <div class="footer w3-black w3-center w3-padding-24">
      Derechos Reservados 2017 &copy; INCMNSZ
      <a href="http://www.innsz.mx/" title="Nutrición" target="_blank" class="w3-hover-opacity"></a>
    </div>
    <!-- End page content -->
    <script>
      // Script to open and close sidebar
      function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
      }
      
      function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
      }
    </script>
  </body>
</html>
