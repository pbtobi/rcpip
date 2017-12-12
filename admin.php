<html>
<?php require_once('connections/rcpip.php'); 
require_once('delight.php');

$auth = new \Delight\Auth\Auth($db);
$result = \processRequestData($auth);

/* define variables and set to empty values
  Formularios (Medicos) para recuperar las variables (globales)
***************************************************************/
$usuarioID = $protocoloID = $medicoID = "";
$nombreErr = $especialErr = $sexoErr = $fechaErr = $edadErr = $celularErr = $emailErr = $roleErr = "";
$Nombre = $Sexo = $Edad = $Email = $especialidad = $celular = "";
// Estrategia de prueba para pasar variables de los formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Nombre"])) {
    $nombreErr = "El nombre es obligatorio";
  } else {
    $Nombre = test_input($_POST["Nombre"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$Nombre)) {
      $nombreErr = "";
    }
  }
  
  if (empty($_POST["Sexo"])) {
    $sexoErr = "El sexo es obligatorio";
  } else {
    $Sexo = test_input($_POST["Sexo"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$Sexo)) {
      $sexoErr = "";
    }
  }

  if (empty($_POST["Fecha_nacimiento"])) {
    $fechaErr = "La fecha es obligatoria";
  } else {
    $Fecha_nacimiento = test_input($_POST["Fecha_nacimiento"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9 ]*$/",$Fecha_nacimiento)) {
      $fechaErr = "";
    }
  }

  if (empty($_POST["Edad"])) {
    $edadErr = "La edad es obligatoria";
  } else {
    $Edad = test_input($_POST["Edad"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9 ]*$/",$Edad)) {
      $edadErr = "";
    }
  }

  if (empty($_POST["celular"])) {
    $celularErr = "El celular es obligatorio";
  } else {
    $celular = test_input($_POST["celular"]);
  }

  if (empty($_POST["Email"])) {
    $emailErr = "El correo para contactarlo";
  } else {
    $Email = test_input($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "El correo electrónico no es válido";
    }
  }

  if (empty($_POST["especialidad"])) {
    $especialidad = "";
  } else {
    $especialidad = test_input($_POST["especialidad"]);
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
  // elige un usuario en particular
  if (empty($_POST["usuarioID"])) {
    // echo 'do nothing';
    // $usuarioID es vacía cuando no hay formulario que la genere (evita undefined error)
    $usuarioID = "";
  }
  else {
    $usuarioID = ($_POST["usuarioID"]);
  }
  // elige un protocolo en particular
  if (empty($_POST["protocoloID"])) {
    // echo 'do nothing';
    // $protocoloID es vacía cuando no hay formulario que la genere (evita undefined error)
    $protocoloID = "";
  }
  else {
    $protocoloID = ($_POST["protocoloID"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

\showHtmlHead();
echo '
  <body id="page" class=" w3-light-grey w3-content">
';


//\showDebugData($auth, $result);

if ($auth->check()) {
  //\showAuthenticatedUserForm($auth);

  showSidebarNav();
  showHeader();
  showViewChanges(); 
  //\tarjetaMedicos();
  //writePeopleDatos();
  //echo $medicoID;

  //\header("Location: ". "admin.php" );
}
else {
  \showGuestUserForm();
}

if ($auth->hasAnyRole(\Delight\Auth\Role::DEVELOPER, \Delight\Auth\Role::MANAGER)) {
    // the user is either a developer, or a manager, or both
  \tarjetaProtocolos();
  \tarjetaUsuarios($auth);
    echo '
    </div>
      ';

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
        <!-- jQuery -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="Hello World"></script>-->
    <!-- JS Forms -->
    <script type="text/javascript" src="js/forms.js"></script>

  </body>
</html>
