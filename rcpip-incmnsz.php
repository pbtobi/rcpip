<?php 
require_once('connections/rcpip.php'); 
//require_once('connections/rcpip000.php'); 
require_once('delight.php');
require_once('FirePHPCore/fb.php');
ob_start();
$auth = new \Delight\Auth\Auth($db);
$result = \processRequestData($auth);

/* define variables and set to empty values
  Formularios (Medicos) para recuperar las variables (globales)
***************************************************************/
$ci_acepta = $PeopleID = $usuarioID = $protocoloID = $medicoID = $nombreErr = $emailErr = $especialErr = $celularErr = "";
$doctorName = $doctorEmail = $especialidad = $celular = $role = "";
// Estrategia de prueba para pasar variables de los formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["doctorName"])) {
    $nombreErr = "El nombre es obligatorio";
  } else {
    $doctorName = test_input($_POST["doctorName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$doctorName)) {
      $nombreErr = "";
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
  if (empty($_POST["consentimiento"])) {
    // echo 'do nothing';
    // $protocoloID es vacía cuando no hay formulario que la genere (evita undefined error)
    $ci_acepta = NULL;
  }
  else {
    $ci_acepta = ($_POST["consentimiento"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
  $role = "ADMIN";
}

//\showDebugData($auth, $result);

if ($auth->check()) {
  $PeopleID = $auth->id();
  //\showAuthenticatedUserForm($auth);
  \showHtmlHead();
  showHeader();
  showSidebarNav($role);
  
  \tarjetaDatosGenerales($PeopleID);
  //\tarjetaAntecedentesMedicos();
  \tarjetaHabitosVida();
  \tarjetaRecordatorio24h($PeopleID);
  \tarjetaCalendario(); 
  #writeFechasR24hrs($PeopleID);
  \tarjetaConsentimiento($PeopleID, $ci_acepta);

  //\tarjetaMedicos();
  //writePeopleDatos();
  //echo $medicoID;
  showViewChanges(); 


}
else {
  \showHtmlLoginHead();
  \showGuestUserForm();
}

if ($auth->hasAnyRole(\Delight\Auth\Role::DEVELOPER, \Delight\Auth\Role::MANAGER)) {
    // the user is either a developer, or a manager, or both
  \tarjetaProtocolos();
  \tarjetaUsuarios();
    echo '
      </div>
    <!--end wrapper-->  
    </div>
    <div class="overlay"></div>
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
    </div>
    <!-- Footer -->
    <div class="footer w3-black w3-center w3-padding-24">
      Derechos Reservados 2017 &copy; INCMNSZ
      <a href="http://www.innsz.mx/" title="Nutrición" target="_blank" class="w3-hover-opacity"></a>
    </div>
    <!-- End page content -->
    <script>


     
    </script>
        <!-- jQuery -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="Hello World"></script>-->
    <script src="js/jquery-ui.js"></script>

    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });


        });
    </script>
  </body>
</html>
