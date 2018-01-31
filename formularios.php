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
				<div class="menuDinamico">
					<button class=" active" data-page="page4" id="link4"><i class="fa fa-th-large fa-fw"></i>Datos Generales</button>	
					<!--<button class="w3-button" data-page="page5" id="link5"><i class="fa fa-user-md fa-fw"></i>Antecedentes médicos</button>-->
					<button class="w3-button" data-page="page6" id="link6"><i class="fa fa-heart fa-fw"></i>Hábitos de vida</button>
					<button class="w3-button" data-page="page7" id="link7"><i class="fa fa-cutlery fa-fw"></i>Recordatorio de 24 hrs</button>
					<button class="w3-button" data-page="page9" id="link9"><i class="fa fa-calendar fa-fw"></i>Calendario</button>
					<button class="w3-button" data-page="page8" id="link8"><i class="fa fa-hand-peace-o fa-fw"></i>Consentimiento Informado</button>
					<!--<form accept-charset="utf-8" method="post" action="rcpip-incmnsz.php">
					<input type="hidden" value="logOut" name="action">
					<button type="submit" class="w3-button"><i class="fa fa-sign-out fa-fw w3-margin-right"></i>Salir</button>
					</form>-->				
				</div>
			</div>';
}

/*
* Tarjeta de los Datos Generales de los Médicos.
* Incluye Registro de Médicos (Ingreso), Medicos Registrados (Listado) y Actualización (Update).
*/
function tarjetaMedicos() {
	global $emailErr, $nombreErr, $celularErr;
	echo '
		<div id="page1" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaMedicos">
				<h4>Registro de médicos</h4>
				<div class="w3-container w3-whitegray">
					<h2>Ingresar médico</h2>
					<form action="" method="post" accept-charset="utf-8">
						<div class="w3-third w3-margin-bottom">
							<label for="doctorName">Nombre del médico</label>
							<input type="text" id="dname" name="Nombre_medico" placeholder="Su nombre completo..">
							<span class="error">'.$nombreErr.'</span>
						</div>
						<div class="w3-third w3-margin-bottom">
							<label for="especialidad">Especialidad</label>
							<input type="text" id="darea" name="Especialidad" placeholder="Su área de especialidad..">   
						</div>
						<div class="w3-third w3-margin-bottom">
							<label for="celular">Celular</label>
							<input type="text" id="dcel" name="Cel_medico" placeholder="Su teléfono de celular..">
							<span class="error">'.$celularErr.'</span>
						</div>
						<div class="w3-third">
							<label for="email">Correo electrónico</label>
							<input type="text" id="demail" name="Email_medico" placeholder="Su correo electrónico..">
							<span class="error">'.$emailErr.'</span>
						</div>
						<input type="hidden" name="action" value="addMedico" />
						<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Registro nuevo">
					</form>
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
	global $emailErr, $nombreErr, $celularErr, $usuarioID;
	global $db;
	echo '
		<div id="page2" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaPacientes">
				<h4>Registro de nuevos médicos, pacientes o administradores</h4>
				<ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" href="#home1">Nuevo usuario</a></li>
				    <li><a data-toggle="tab" href="#menu12">Tipo de usuario</a></li>
				    <li><a data-toggle="tab" href="#menu13">Usuarios registrados</a></li>
				    <!--<li><a data-toggle="tab" href="#menu14">Menu 4</a></li>-->
				    <li class="right"><a>usuarioID: '.$usuarioID.'</a></li>
				</ul> 
				
				<div class="tab-content">
				    <div id="home1" class="tab-pane fade in active">
				      
				      	<div class="w3-container w3-whitegray">';
							showCreateUserForm();
							echo '
						</div>
				    </div>
				
				    <div id="menu12" class="tab-pane fade">
				      <h5>Médico, Paciente o Administrador</h5>
				      
				      	<div class="w3-container w3-whitegray">';
				      		$roles_mask = 0;
							writeUsersTable($roles_mask);
							showAddRoleForm();
							echo '
						</div>				      
				    </div>
				    <div id="menu13" class="tab-pane fade">
				      <h5>Modificar los datos del usuarios</h5>
				      
				      	<div class="w3-container w3-whitegray">';
							writeUsersTable();
							usuariosUpdateForm();
							echo '
						</div>      	
				    </div>
				    <div id="menu14" class="tab-pane fade">
				      <h3>Menu 3</h3>
				      
				    </div>
				</div>

			</div>	
		</div>';
}

/*
* Tarjeta de los Datos Generales de los Protocolos.
* Registra y modifica los Protocolos (Registro, Listado y Actualización).
*/
function tarjetaProtocolos() {
	global $nombreErr, $usuarioID;
	echo '
		<div id="page3" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaProtocolos">
			<h4>Registro de los protocolos de investigación</h4>
				<ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home2">Nuevo protocolo</a></li>
                    <li><a data-toggle="tab" href="#menu22">Protocolos registrados</a></li>
                    <li  class="right"> usuarioID: '.$usuarioID.'</li>
                </ul>
 
                <div class="tab-content">

                    <div id="home2" class="tab-pane fade in active">
                        
				<div class="w3-container w3-whitegray">
					<div class="row top-buffer"></div>
					<div class="row top-buffer"></div>
						<div class="col-md-1"></div>
						<div  class="col-md-10">
							<form action="" method="post" accept-charset="utf-8">
						<div class="w3-margin-bottom" >
							<!--<label for="protocoloName">Nombre del protocolo</label>-->
							<input type="text" id="Protocolo" name="Protocolo" placeholder="Nombre del protocolo..">
							<span class="error">'.$nombreErr.'</span>
						</div>
						<div class="">
							<input type="hidden" name="action" value="addProtocolo" />
							<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Registrar protocolo">
						</div>
							</form>							
						</div>
						<div  class="col-md-1"></div>

					</div>
				</div>
				<div id="menu22" class="tab-pane fade">                      
                        <div class="w3-container w3-whitegray">
                        <h5>Protocolos registrados:</h5>';
                            writeProtocoloTable();
                            protocolosUpdateForm();
                            echo '
                        </div>
                    </div>
				</div>
			</div>	
		</div>';
}

/*
* Tarjeta de los Datos Generales.
* Registra y modifica los Datos Generales del Registro de usuario (Registro, Listado y Actualización).
*/
function tarjetaDatosGenerales($PeopleID) {
	$datosPeople = getDataPeople($PeopleID);
		foreach($datosPeople as $row) {
		$PeopleID = $row['PeopleID'];
		$Nombre = $row['Nombre'];
		$Sexo = $row['Sexo'];
		$Ocupacion = $row['Ocupacion'];
		$Domicilio = $row['Domicilio'];
		$Lugar_nacimiento = $row['Lugar_nacimiento'];
		$Fecha_nacimiento = $row['Fecha_nacimiento'];
		$Estado_civil = $row['Estado_civil'];
		$Escolaridad = $row['Escolaridad'];
		$Edad = $row['Edad'];
		$Tel_casa = $row['Tel_casa'];
		$Celular = $row['Celular'];
		$Tel_trabajo = $row['Tel_trabajo'];
		$Email = $row['Email'];
		$rol = $row['rol'];
		$FolioID = $row['FolioID'];
		$IDUIEM = $row['IDUIEM'];
	}
	$selecTrue = $selecFalse = "";
	if ($Sexo == "H") {
		# code...
		$selecTrue = "checked";
	} else if ($Sexo == "M") {
		# code...
		$selecFalse = "checked";
	} else {
		# code...
		$selecTrue = "";
		$selecFalse = "";
	}
	$escolArray = array("Preprimaria", "Primaria", "Secundaria", "Bachillerato", "Licenciatura", "Maestría", "Doctorado");
	$edoCivilArray = array("Soltero", "Unión Libre", "Casado", "Divorciado", "Viudo");
	$sexArray = array("Hombre", "Mujer");
	echo '
		<div id="page4" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaDatosGenerales">
                <div>
			        <div class="row">
			            <div class="col-md-12">
			                <form role="form" class="registration-form" action="javascript:void(0);">
			                    <fieldset id="datosgrales">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-th-large fa-fw w3-margin-right"></i></span>Datos Generales</h3>
			                                <p>Datos Personales</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
	                                        		<!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-3 control-label" for="nombre">Nombre:</label>
	                                            		<div class="col-md-9">
	                                              			<input type="text" id="nombre" placeholder="Nombre Completo" name="nombre" class="form-control" value="'
	                                              			.$Nombre.'">
	                                            		</div>					                                    
					                            	</div>

					                            	<!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<div class="col-md-12">
                                          				    <label class="control-label" for="genero">Sexo:</label>
				                                        	<input type="radio" id="" name="genero" value="H" '.$selecTrue.'> Hombre
  															<input type="radio" id="" name="genero" value="M" '.$selecFalse.'> Mujer
  															<input type="radio" id="" name="genero" value="otro"> Otro
                                          				</div>
						                            </div>

	                                        		<!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-3 control-label" for="Lugar_nacimiento">Lugar de Nacimiento:</label>
	                                            		<div class="col-md-9">
	                                              			<input type="text" id="lugar_nacimiento" placeholder="Estado y localidad" name="Lugar_nacimiento" class="form-control" value="'.$Lugar_nacimiento.'">
	                                            		</div>					                                    
					                            	</div>

					                              	<!-- Text input-->
					                              	<div class="form-group col-md-12">
                                            			<label class="col-md-3 control-label" for="ocupacion">Fecha de nacimiento:</label>
                                            			<div class="col-md-9">
					                                    	<input type="text" id="datepicker-fn" class="datepicker" name="Fecha_nacimiento" placeholder="Su fecha de Nacimiento"
					                                    	value="'.$Fecha_nacimiento.'">
                                            			</div>
					                              	</div>


                                           			                            		
			                            		</div>
			                            	</div>

			                            	<div class="col-md-6">
			                            		<div class="row">
 					                            	

						                            <!-- Text input-->
					                              	<div class="form-group col-md-12">
                                            			<label class="col-md-3 control-label" for="Estado_civil">Estado civil:</label>
                                            			<div class="col-md-9">
					                                    	<select type="text" id="Estado_civil" name="Estado_civil" placeholder="Su estado civil">';
															if ($Estado_civil == "") {
																echo '
																<option disabled selected>Su estado civil</option>
																<option>Soltero</option>
																<option>Unión libre</option>
																<option>Casado</option>
																<option>Divorciado</option>
																<option>Viudo</option>';
															} else {
																foreach ($edoCivilArray as $row) {
																	if ($row == $Estado_civil) {
																		echo '
																		<option selected>'.$row.'</option>';
																	} else {
																		echo '
																		<option>'.$row.'</option>';
																	}
																}
															}
															echo '
															</select>
                                            			</div>
					                              	</div>					                              	

					                              	<!-- Text input-->
					                              	<div class="form-group col-md-12">
                                            			<label class="col-md-3 control-label" for="Escolaridad">Escolaridad:</label>
                                            			<div class="col-md-9">
					                                    	<select type="text" id="Escolaridad" name="Escolaridad">';
															if ($Escolaridad == "") {
																echo '
																<option disabled selected>Nivel terminado</option>
																<option>Preprimaria</option>
																<option>Primaria</option>
																<option>Secundaria</option>
																<option>Bachillerato</option>
																<option>Licenciatura</option>
																<option>Maestría</option>
																<option>Doctorado</option>';
															} else {
																foreach ($escolArray as $row) {
																	if ($row == $Escolaridad) {
																		echo '
																		<option selected>'.$row.'</option>';
																	} else {
																		echo '
																		<option>'.$row.'</option>';
																	}
																}					
															}
															echo '	
															</select>
                                            			</div>
					                              	</div> 

						                            <!-- Text input-->
					                              	<div class="form-group col-md-12">
                                            			<label class="col-md-3 control-label" for="ocupacion">Ocupación:</label>
                                            			<div class="col-md-9">
					                                    	<input type="text" id="ocupacion" placeholder="Ocupación" class="form-control" name="ocupacion" value="'.$Ocupacion.'">
                                            			</div>
					                              	</div>

			                            		</div>
			                            	</div>
			                            </div>	
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="datospersonales">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Datos Generales</h3>
			                                <p>Datos de Contacto</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">

					                              	<!-- Text input-->
					                              	<div class="form-group col-md-12">
                                            			<label class="col-md-3 control-label" for="direccion">Domicilio:</label>
                                            			<div class="col-md-9">
					                                    	<input type="text" id="direccion" placeholder="Domicilio Completo" class="form-control" name="direccion" value="'.$Domicilio.'">
                                            			</div>
					                              	</div>

					                                <!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-3 control-label" for="telcasa">Teléfono de casa:</label value="'.$Tel_casa.'">
	                                            		<div class="col-md-9">
	                                              			<input type="text" id="tel_casa" placeholder="Incluyendo lada" name="telcasa" class="form-control">
	                                            		</div>					                                    
					                            	</div>

					                                <!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-3 control-label" for="teltrabajo">Teléfono del trabajo:</label>
	                                            		<div class="col-md-9">
	                                              			<input type="text" id="tel_trabajo" placeholder="Teléfono del trabajo (extensión)" name="teltrabajo" class="form-control" value="'.$Tel_trabajo.'">
	                                            		</div>					                                    
					                            	</div>
				                            						                                			


			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">

					                                <!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-3 control-label" for="celular">Celular:</label>
	                                            		<div class="col-md-9">
	                                              			<input type="text" id="celular" placeholder="Su teléfono celular" name="celular" class="form-control" value="'.$Celular.'">
	                                            		</div>					                                    
					                            	</div>	

													<!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-3 control-label" for="email">Correo electrónico:</label>
	                                            		<div class="col-md-9">
	                                              			<input type="text" id="email" placeholder="Su e-mail" name="email" class="form-control" value="'.$Email.'">
	                                            		</div>					                                    
					                            	</div>


			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="preguntas_de_parentesco">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Datos generales</h3>
			                                <p>Preguntas de Parentesco</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-12">
			                            		<div class="row">

					                            	<!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="protocolo">¿Algún familiar ha participado en este protocolo?</label>
                                          				<div class="col-md-7">
				                                        	<input type="radio" id="" name="protocolo" value="true"> Sí
  															<input type="radio" id="" name="protocolo" value="false"> No
                                          				</div>
						                            </div>

													<!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-5 control-label" for="nombreFamiliar">Nombre de familiar(es):</label>
	                                            		<div class="col-md-7">
	                                              			<input type="text" id="nombre_Familiar" placeholder="Nombre de familiar" name="nombreFamiliar" class="form-control">
	                                            		</div>					                                    
					                            	</div>							                            

													<!-- Select input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="parentesco">Parentesco:</label>
                                          				<div class="col-md-7">
				                                        	
				                                        		<input type="radio" id="" name="parentesco" value="1"> Papa/Mamá
  																<input type="radio" id="" name="parentesco" value="2"> Hermano(a)
  																<input type="radio" id="" name="parentesco" value="3"> Primo(a)
  																<input type="radio" id="" name="parentesco" value="4"> Tio(a)
  																<input type="radio" id="" name="parentesco" value="5"> Abuel(a)
				                                        	
                                          				</div>
						                            </div>


													<!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-5 control-label" for="tipoUsuario">Tipo de usuario:</label>
	                                            		<div class="col-md-7">
	                                              			<input type="text" id="tipoUsuario" placeholder="Tipo de usuario" name="tipoUsuario" class="form-control" value="'.$rol.'">
	                                            		</div>					                                    
					                            	</div>	

													<!-- Text input-->
						                            <div class="form-group col-md-12">
						                            
	                                            		<div class="col-md-6 inputright">
	                                            			<label class="col-md-3 control-label" for="folioID">Folio ID:</label>
	                                              			<input type="text" id="folioID" placeholder="Folio ID" name="folioID" class="form-control" value="'.$FolioID.'">
	                                            		</div>					                                    

	                                            		<div class="col-md-6 inputright">
	                                            			<label class="col-md-3 control-label" for="iduem">IDUIEM:</label>
	                                              			<input type="text" id="iduiem" placeholder="IDUIEM" name="iduiem" class="form-control" value="'.$IDUIEM.'">
	                                            		</div>					                                    
					                            	</div>							                            

			                            		</div>
			                            	</div>


			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset>   
			                </form>
			            </div>	
			        </div>
			    </div>
			</div>
		</div>';
}

/*
* Tarjeta de los Antecedentes Médicos.
* Registra y modifica los Antecedentes Médicos del usuario (Registro, Listado y Actualización).
*/
function tarjetaAntecedentesMedicos() {
	echo '
		<div id="page5" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaAntecedentesMedicos">
                <div>
			        <div class="row">
			            <div class="col-md-12">
			                <form role="form" class="registration-form" action="javascript:void(0);">
			                    <fieldset id="matutino">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-user-md fa-fw w3-margin-right"></i></span>Antecedentes Médicos</h3>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Desayuno - Huevos (2)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Colación - Fruta (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Colación</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>
						                            </div>
						                            <div class="form-group col-md-12 col-sm-12">
						                                <select class="form-control">
						                                    <option>Preparación Colación</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            </div>	
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="mediodia">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Recordatorio de 24 horas</h3>
			                                <p>En la Tarde</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Comida - Pollo con Mole (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Colación - Manzana (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Colación</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>
						                            </div>
						                            <div class="form-group col-md-12 col-sm-12">
						                                <select class="form-control">
						                                    <option>Preparación Colación</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="nocturno">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Recordatorio de 24 horas</h3>
			                                <p>En la Noche</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Cena - Vaso con Leche (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <label for="Fecha_recordatorio24h">Día en que Consumió sus alimentos</label>
														<input type="text" id="datepicker-hc" class="datepicker" name="fechaRecordatorio" placeholder="Su fecha de Recordatorio">
					                                </div>				                                			                            		
			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset>   
			                </form>
			            </div>	
			        </div>
			    </div>
			</div>
		</div>';
}

/*
* Tarjeta de los Hábitos de Vida.
* Registra y modifica los Hábitos de Vida del usuario (Registro, Listado y Actualización).
*/
function tarjetaHabitosVida() {
	echo '
		<div id="page6" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaHabitosVida">
                <div>
			        <div class="row">
			            <div class="col-md-12">
			                <form role="form" class="registration-form" action="javascript:void(0);">
			                    <fieldset id="tabaco_fieldset">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-heart fa-fw w3-margin-right"></i></span>Hábitos de Vida</h3>
			                                <p>Consumo de Tabaco</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">

					                                <!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="fuma">¿Actualmente fuma?</label>
                                          				<div class="col-md-7">
				                                        	<input type="radio" id="" name="fuma" value="Sí"> Sí
  															<input type="radio" id="" name="fuma" value="No"> No
  															<input type="radio" id="" name="fuma" value="Nunca"> Nunca
                                          				</div>
						                            </div>

						                            <!-- Select input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="frecuencia">¿Con qué frecuencia fuma/fumaba?</label>
                                          				<div class="col-md-7">	
                                          						<select class="form-control" name="frecuencia">
				                                        			<option>Diario</option>
  																	<option>Semanal</option>
  																	<option>Mensual</option>
  																	<option>Ocasional</option>
  																</select>
                                          				</div>
						                            </div>
						                        				                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">

													<!-- Select input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="cigarros">¿Cuántos cigarros fuma/fumaba?</label>
                                          				<div class="col-md-7">	
				                                        		<input type="text" id="numero_cigarros" placeholder="Cantidad" name="cigarros" class="form-control">
                                          				</div>
						                            </div>						                            

					                                <!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-5 control-label" for="tiempo_fuma">¿Durante cuanto tiempo ha fumado regularmente?</label>
	                                            		<div class="col-md-7">
	                                              			<select class="form-control" name="tiempo_fuma">
				                                        			<option>Menos de 1 mes</option>
  																	<option>Menos de 1 año</option>
  																	<option>Más de un año</option>
  																</select>
  																<input type="text" id="year_cigarros" placeholder="Años fumando" name="year_cigarros" class="form-control">
	                                            		</div>					                                    
					                            	</div>

			                            		</div>
			                            	</div>
			                            </div>	
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="alcohol_fieldset">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-heart fa-fw w3-margin-right"></i></span>Hábitos de Vida</h3>
			                                <p>Consumo de Alcohol</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">

					                                <!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="fuma">¿Actualmente toma alcohol?</label>
                                          				<div class="col-md-7">
				                                        	<input type="radio" id="" name="fuma" value="Sí"> Sí
  															<input type="radio" id="" name="fuma" value="No"> No
  															<input type="radio" id="" name="fuma" value="Nunca"> Nunca
                                          				</div>
						                            </div>

						                            <!-- Select input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="frecuencia_alcohol">¿Aproximadamente con qué frecuencia tomaba?</label>
                                          				<div class="col-md-7">	
                                          						<select class="form-control" name="frecuencia_alcohol">
				                                        			<option>Diario</option>
  																	<option>Semanal</option>
  																	<option>Mensual</option>
  																	<option>Ocasional</option>
  																</select>
                                          				</div>
						                            </div>
						                        				                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">

													<!-- Select input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-5 control-label" for="copas">¿Cuántas copas toma/tomaba?</label>
                                          				<div class="col-md-7">	
				                                        		<input type="text" id="numero_copas" placeholder="Cantidad de copas" name="copas" class="form-control">
                                          				</div>
						                            </div>						                            

					                                <!-- Text input-->
						                            <div class="form-group col-md-12">
						                            <label class="col-md-5 control-label" for="tipo_copa">¿Durante cuanto tiempo toma/tomaba y que tipo de bebida?</label>
	                                            		<div class="col-md-7">
	                                              			<select class="form-control" name="tipo_copa">
				                                        			<option>Cerveza</option>
  																	<option>Vino</option>
  																	<option>Licores</option>
  																	<option>Destilado</option>
  																</select>
  																<input type="text" id="year_copas" placeholder="Años/meses tomando" name="year_copas" class="form-control">
	                                            		</div>					                                    
					                            	</div>

			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="actividad-1_fieldset">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Hábitos de Vida</h3>
			                                <p>Actividad Física 1/2</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-12">
			                            		<div class="row">

					                                <!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-12 control-label" for="ejercicio">¿Qué tipo de actividad física realiza durante el día?</label>
                                          				<H5>(1) Cocinar, trabajo de oficina, ventas (sentado), mostrador, trabajo general de casa, manejar</H5>
                                          				<H5>(2) Trabajar de pie llevando cosas, mesero, viajar en camión a pie, cargar pilas ligeras, caminar variando el peso</H5>
                                          				<H5>(3) Repartidos, lavar pisos o ropa con máquinas, ventas a pie</H5>
                                          				<H5>(4) Trabajo en el campo, carga de bultos pesados, lavar ropa o pisos a mano, trabajar en construcción</H5>
                                          				<div class="col-md-12">
				                                        	<input type="radio" id="" name="ejercicio" value="Sí"> (1) LIGERA O SEDENTARIA
  															<input type="radio" id="" name="ejercicio" value="No"> (2) MODERADA
  															<input type="radio" id="" name="ejercicio" value="No"> (3) ACTIVA
  															<input type="radio" id="" name="ejercicio" value="No"> (4) VIGOROSA

                                          				</div>
						                            </div>

					                                <!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-12 control-label" for="ejercicio">¿Realiza algún tipo de ejercicio físico habitual?</label>
                                          				<div class="col-md-12">
				                                        	<input type="radio" id="" name="ejercicio" value="Sí"> Sí
  															<input type="radio" id="" name="ejercicio" value="No"> No
  															<input type="text" id="tiempo_ejercicio" placeholder="Durante cuanto tiempo en minutos" name="tiempo_ejercicio" class="form-control">
                                          				</div>
						                            </div>

						                        				                                			                            		
			                            		</div>
			                            	</div>
			                            	
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset> 
			                    <fieldset id="actividad-2_fieldset">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Hábitos de Vida</h3>
			                                <p>Actividad Física 2/2</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-12">
			                            		<div class="row">
						                            

						                            <!-- Select input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-12 control-label" for="frecuencia_actividad">¿Aproximadamente con qué frecuencia?</label>
                                          				<div class="col-md-12">	
                                          						<select class="form-control" name="frecuencia_actividad">
				                                        			<option>Diario</option>
  																	<option>1-2 días por semana</option>
  																	<option>3-4 días por semana</option>
  																	<option>5-6 días por semana</option>
  																	<option>Ocasional</option>
  																</select>
                                          				</div>
						                            </div>

					                                <!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-12 control-label" for="ejercicio">¿Qué tipo de ejercicio realiza?</label>
                                          				<H5>(1) Caminar 4km/hr, Bicicleta (15km/hr), Baile de salón, Ejercicios aeróbicos acuáticos</H5>
                                          				<H5>(2) Trotar o correr, Natación, Baile aeróbico, Bicicleta (>15km/hr), Brincar la cuerda</H5>
                                          				
                                          				<div class="col-md-12">
  															<input type="radio" id="" name="ejercicio" value="No"> (1) MODERADO
  															<input type="radio" id="" name="ejercicio" value="No"> (2) VIGOROSA

                                          				</div>
						                            </div>

			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset>   
			                </form>
			            </div>	
			        </div>
			    </div>
			</div>
		</div>';
}

function writeFechasR24hrs($PeopleID) {
	$id = $PeopleID;
	$datos = getFechasR24hrs($id);
	$leyenda = "";
	# echo $datos->rowCount();
	if ($datos) {
	foreach ($datos as $row) {
		# code...
		$leyenda = " | <a fecha-pid='";
		$leyenda .= $row['R24hrsID'];
		$leyenda .= "' class='' href='javascript:void(0)'>";
		$leyenda .= $row['FechaR24'];
		$leyenda .= "</a> | ";
	}
	} else {
		$leyenda = '| No hay datos |';
	}
	echo $leyenda;
}

/*
* Tarjeta de los Datos Generales de los Protocolos.
* Registra y modifica los Protocolos (Registro, Listado y Actualización).
*/
function tarjetaRecordatorio24h($PeopleID) {
	$id = $PeopleID;
	$leyenda = "";
	echo '
		<div id="page7" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaRecordatorio24h">
                <div>
			        <div class="row">
			            <div class="col-md-12">
			                <form role="form" class="registration-form" action="javascript:void(0);">
			                    <fieldset id="matutino">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-cutlery fa-fw"></i></span>Recordatorio de 24 horas</h3>
			                                <p>En la Mañana</p>
			                                <strong>'.$leyenda.'</strong>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Desayuno - Huevos (2)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Colación - Fruta (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Colación</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>
						                            </div>
						                            <div class="form-group col-md-12 col-sm-12">
						                                <select class="form-control">
						                                    <option>Preparación Colación</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            </div>	
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="mediodia">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-cutlery fa-fw"></i></span>Recordatorio de 24 horas</h3>
			                                <p>En la Tarde</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Comida - Pollo con Mole (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Colación - Manzana (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Colación</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>
						                            </div>
						                            <div class="form-group col-md-12 col-sm-12">
						                                <select class="form-control">
						                                    <option>Preparación Colación</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="nocturno">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-cutlery fa-fw"></i></span>Recordatorio de 24 horas</h3>
			                                <p>En la Noche</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Cena - Vaso con Leche (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <label for="Fecha_recordatorio24h">Día en que Consumió sus alimentos</label>
														<input type="text" id="datepicker-fa" class="datepicker" name="fechaRecordatorio" placeholder="Su fecha de Recordatorio">
					                                </div>				                                			                            		
			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset>   
			                </form>
			            </div>	
			        </div>
			        <div class="row">
			        	<div class="col-md-12">
			        	'.$id.'
			        	</div>
			        </div>
			    </div>
			</div>
		</div>';
}


/*
* Tarjeta de los Datos Generales de los Protocolos.
* Registra y modifica los Protocolos (Registro, Listado y Actualización).
*/
function tarjetaCalendario() {
	echo '
		<div id="page9" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaCalendario">
                <div>
			        <div class="row">
			            <div class="col-md-12">
			                <form role="form" class="registration-form" action="javascript:void(0);">
			                    <fieldset id="calendario-mes">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Calendario</h3>
			                                <p>Mensual</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-12">
			                            		<div class="row">
			                            			<div class="col-md-12">
			                            				<div id="caleandar"></div>
			                            			</div>
			                            		</div>	
			                            	</div>
			                            </div>	
			                            <!--<button type="button" class="btn btn-next">Siguiente</button>-->
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset>
			                    <!--<fieldset id="calendario_dia">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Calendario</h3>
			                                <p>Diario</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Comida - Pollo con Mole (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Colación - Manzana (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Colación</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>
						                            </div>
						                            <div class="form-group col-md-12 col-sm-12">
						                                <select class="form-control">
						                                    <option>Preparación Colación</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="button" class="btn btn-next">Siguiente</button>
			                        </div>
			                    </fieldset>
			                    <fieldset id="calendario_año">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Calendario</h3>
			                                <p>Anual</p>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-6">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                    <input type="text" class="form-control" placeholder="Cena - Vaso con Leche (1)" id="fname">
					                                </div>
						                            <div class="form-group col-md-12">
				                                        <select class="form-control">
				                                            <option>Lugar Desayuno</option>
				                                            <option>Casa</option>
				                                            <option>Calle</option>
				                                            <option>Restaurante</option>
				                                        </select>         
						                            </div>
						                            <div class="form-group col-md-12">
						                                <select class="form-control">
						                                    <option>Preparación Desayuno</option>
						                                    <option>Frito</option>
						                                    <option>Dorado</option>
						                                    <option>Asado</option>
						                                    <option>Cocido</option>
						                                    <option>Crudo</option>
						                                    <option>Guisado</option>
						                                </select>
						                            </div>					                                			                            		
			                            		</div>
			                            	</div>
			                            	<div class="col-md-6">
			                            		<div class="row">
													<div class="form-group col-md-12">
					                                    <label for="Fecha_recordatorio24h">Día en que Consumió sus alimentos</label>
														<input type="text" id="datepicker" name="" placeholder="Su fecha de Recordatorio">
					                                </div>				                                			                            		
			                            		</div>
			                            	</div>
			                            </div>
			                            <button type="button" class="btn btn-previous">Anterior</button>
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset> -->  
			                </form>
			            </div>	
			        </div>
			    </div>
			</div>
		</div>';
}

/*
* Tarjeta de Consentimiento.
* Registra Consentimiento del usuario (Registro, Listado y Actualización).
*/
function tarjetaConsentimiento($PeopleID, $ci_acepta) {
	$datos = getDataCI($PeopleID);
	$selecTrue = $selecFalse = "";
	foreach ($datos as $row) {
		# code...
		if ($row['ci_acepta'] == 1) {
			# code...
			$selecTrue = "checked";
			$selecFalse = "";
		} else if ($row['ci_acepta'] == 0) {
			$selecFalse = "checked";
			$selecTrue = "";
		} else {
			$selecFalse = "";
			$selecTrue = "";
		}
	}
	#global $db, $ci_acepta;
	#$selecTrue = $selecFalse = NULL;
	echo '
		<div id="page8" class="tarjeta w3-container w3-padding-large" style="margin-bottom:32px">
			<div id="tarjetaConsentimiento">
                <div>	
			        <div class="row">
			            <div class="col-md-12">
			                <form role="form" class="registration-form" action="" method="post">
			                    <fieldset id="consentimiento_fieldset">
			                        <div class="form-top">
			                            <div class="form-top-left">
			                                <h3><span><i class="fa fa-hand-peace-o fa-fw w3-margin-right"></i></span>Consentimiento Informado</h3>
			                                <br>
			                            </div>
			                        </div>
			                        <div class="form-bottom">
			                            <div class="row">
			                            	<div class="col-md-12">
			                            		<div class="row">
					                                <div class="form-group col-md-12">
					                                	<div class="col-md-12">
					                                    <h5>El paciente fue informado sobre los beneficios y los riesgos de su participación dentro de este protocolo y ha aceptado ser parte de éste de manera libre y sin presiones ni estímulos económicos.</h5>
					                                    </div>
					                                </div>


					                                <!-- Radio input-->
						                            <div class="form-group col-md-12">
                                          				<label class="col-md-7 control-label" for="consentimiento">El paciente firmó carta de consentimiento informado:</label>
                                          				<div class="col-md-5">
				                                        	<input type="radio" id="" name="consentimiento" value="true" '.$selecTrue.'> Sí
  															<input type="radio" id="" name="consentimiento" value="false" '.$selecFalse.'> No
                                          				</div>
						                            </div>
						                           					                                			                            		
			                            		</div>
			                            	</div>
			                            	
			                            </div>
			                            <input type="hidden" name="PeopleID" value="'.$PeopleID.'" />
			                            <input type="hidden" name="action" value="updateConsInfo" />
			                            <button type="submit" class="btn btn-save">Guardar</button>
			                        </div>
			                    </fieldset>
			                   
			                </form>
			            </div>	
			        </div>
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
	global $nombreErr, $emailErr, $celularErr, $medicoID;
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
					<input type="text" id="dname" name="Nombre_medico" placeholder="Su nombre completo.." value="'.$Nombre_medico.'"><span class="error"> * '.$nombreErr.'</span>
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
					<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Aceptar">
			</form>
		<!--</div>-->';
	}
	else {
		echo $emailErr;
	}
}

/*
* Formulario HTML para modificar los datos de los Usuarios.
* Actualiza la información y sólo se construye si es seleccionado un usuario en particular.
* @ Recibe $usuarioID a partir de writePeopleTable().
*/
function usuariosUpdateForm($roles = NULL) {
	// hace falta validar Nombre, Fecha_nacimiento, Edad, Celular, Email, rol, FolioID, IDUIEM
	global $sexoErr, $fechaErr, $edadErr, $roleErr, $nombreErr, $emailErr, $celularErr, $usuarioID;
	$datosPeople = getDataPeople($usuarioID);
	$datosUsers = getDataUsers($usuarioID, $roles);
	$email = $username = "";
	$id = $roles_mask = 0;
	foreach ($datosUsers as $row) {
		$id = $row['id'];
		$email = $row['email'];
		$username = $row['username'];
		$roles_mask = $row['roles_mask'];
	}
	$role = $roles_mask;
	$PeopleID = $Nombre = $Sexo = $Ocupacion = $Domicilio = $Lugar_nacimiento = $Fecha_nacimiento = $Estado_civil = $Escolaridad = $Edad = $Tel_casa = $Celular = $Tel_trabajo = $Email = $rol = $FolioID = $IDUIEM = "";
	foreach($datosPeople as $row) {
		$PeopleID = $row['PeopleID'];
		$Nombre = $row['Nombre'];
		$Sexo = $row['Sexo'];
		$Ocupacion = $row['Ocupacion'];
		$Domicilio = $row['Domicilio'];
		$Lugar_nacimiento = $row['Lugar_nacimiento'];
		$Fecha_nacimiento = $row['Fecha_nacimiento'];
		$Estado_civil = $row['Estado_civil'];
		$Escolaridad = $row['Escolaridad'];
		$Edad = $row['Edad'];
		$Tel_casa = $row['Tel_casa'];
		$Celular = $row['Celular'];
		$Tel_trabajo = $row['Tel_trabajo'];
		$Email = $row['Email'];
		$rol = $row['rol'];
		$FolioID = $row['FolioID'];
		$IDUIEM = $row['IDUIEM'];
	}
	$escolArray = array("Preprimaria", "Primaria", "Secundaria", "Bachillerato", "Licenciatura", "Maestría", "Doctorado");
	$edoCivilArray = array("Soltero", "Unión Libre", "Casado", "Divorciado", "Viudo");
	$sexArray = array("Hombre", "Mujer");
	if ($Sexo == "H") {
		$sex = "Hombre";
	}
	if ($Sexo == "M") {
		$sex = "Mujer";
	}
	if ($roles_mask == "8193") {
		$role = "Administrador";
	}
	if ($roles_mask == "1024") {
		$role = "Médico";
	}
	if ($roles_mask == "16") {
		$role = "Paciente";
	}
	if ($roles_mask == "0") {
		$role = "sin asignar";
	}
	if (!$IDUIEM) {
		$IDUIEM = 0;
	}
	if (!$FolioID) {
		$FolioID = 0;
	}
	if (!$username) {
		$username = "Sin asignar";
	} else {
		$username = $username;
	}
	if ($usuarioID) {
			echo '
			<script>
                </script>
		<!--<div class="w3-row-padding" style="margin:8 -16px">-->
		<div class="w3-container w3-whitegray">
			<h2>'.$email.' '.$id.'</h2>
			<form id="update_usuarios" action="" method="post" accept-charset="utf-8">
				<div class="w3-third w3-margin-bottom">
					<label for="Nombre">Nombre del usuario</label>
					<input type="text" id="uname" name="Nombre" placeholder="Su nombre completo" value="'.$username.'" readonly>
					<span class="error">'.'</span>
				</div>
				<div class="w3-third w3-margin-bottom"> 
					<label for="Sexo">Sexo</label>
					<select type="text" id="Sexo" name="Sexo">';
					if ($Sexo == "") {
						echo '
						<option disabled selected>Elija el sexo</option>
						<option>Hombre</option>
						<option>Mujer</option>';
					} else {
						foreach ($sexArray as $row) {
						 	if ($row == $sex) {
						 		echo '
						 		<option selected>'.$row.'</option>';
						 	} else {
						 		echo '
						 		<option>'.$row.'</option>';
						 	}
						}
					}
					echo '
					</select>
					<span class="error">'.$sexoErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Ocupacion">Ocupación</label>
					<input type="text" id="Ocupacion" name="Ocupacion" placeholder="Ocupacion" value="'.$Ocupacion.'">
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Domicilio">Domicilio</label>
					<input type="text" id="Domicilio" name="Domicilio" placeholder="Domicilio completo" value="'.$Domicilio.'">
				</div>
				<div class="w3-third w3-margin-bottom">  
					<label for="Lugar_nacimiento">Lugar de nacimiento</label>
					<input type="text" id="Lugar_nacimiento" name="Lugar_nacimiento" placeholder="Estado y localidad" value="'.$Lugar_nacimiento.'">
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Fecha_nacimiento">Fecha de nacimiento</label>
					<input type="text" id="datepicker-fnupdate" class="datepicker" name="Fecha_nacimiento" placeholder="Su fecha de nacimiento" value="'.$Fecha_nacimiento.'">
					<span class="error">'.$fechaErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Estado_civil">Estado civil</label>
					<select type="text" id="Estado_civil" name="Estado_civil" placeholder="Su estado civil">';
					if ($Estado_civil == "") {
						echo '
						<option disabled selected>Su estado civil</option>
						<option>Soltero</option>
						<option>Unión libre</option>
						<option>Casado</option>
						<option>Divorciado</option>
						<option>Viudo</option>';
					} else {
						foreach ($edoCivilArray as $row) {
							if ($row == $Estado_civil) {
								echo '
								<option selected>'.$row.'</option>';
							} else {
								echo '
								<option>'.$row.'</option>';
							}
						}
					}
					echo '
					</select>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Escolaridad">Escolaridad</label>
					<select type="text" id="Escolaridad" name="Escolaridad">';
					if ($Escolaridad == "") {
						echo '
						<option disabled selected>Nivel terminado</option>
						<option>Preprimaria</option>
						<option>Primaria</option>
						<option>Secundaria</option>
						<option>Bachillerato</option>
						<option>Licenciatura</option>
						<option>Maestría</option>
						<option>Doctorado</option>';
					} else {
						foreach ($escolArray as $row) {
							if ($row == $Escolaridad) {
								echo '
								<option selected>'.$row.'</option>';
							} else {
								echo '
								<option>'.$row.'</option>';
							}
						}					
					}
					echo '	
					</select>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Edad">Edad</label>
					<input type="text" id="Edad" name="Edad" placeholder="Su edad en años" value="'.$Edad.'">
					<span class="error">'.$edadErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Tel_casa">Teléfono de casa</label>
					<input type="text" id="Tel_casa" name="Tel_casa" placeholder="Incluyendo lada" value="'.$Tel_casa.'">
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Celular">Celular</label>
					<input type="text" id="Celular" name="Celular" placeholder="Su telefono de celular" value="'.$Celular.'">
					<span class="error">'.$celularErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Tel_trabajo">Teléfono del trabajo</label>
					<input type="text" id="Tel_trabajo" name="Tel_trabajo" placeholder="Telefono del trabajo (extension)" value="'.$Tel_trabajo.'">
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="Email">Correo electrónico</label>
					<input type="text" id="Email" name="Email" placeholder="Su e-mail" value="'.$email.'">
					<span class="error">'.$emailErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="role">Tipo de usuario</label>
					<input type="text" id="role" name="role" value="'.$role.'" readonly>
					<span class="error">'.$roleErr.'</span>
				</div>
				<div class="w3-third w3-margin-bottom">
					<label for="FolioID">FolioID</label>
					<input type="text" id="FolioID" name="FolioID" placeholder="Folio ID" value="'.$FolioID.'">
				</div>
				<div class="w3-third">
					<label for="IDUIEM">IDUIEM</label>
					<input type="text" id="IDUIEM" name="IDUIEM" placeholder="IDUIEM" value="'.$IDUIEM.'">
				</div>
				<input type="hidden" name="PeopleID" value="'.$PeopleID.'" />
				<input type="hidden" name="action" value="updateUsuario" />
				<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Aceptar">
			</form>
			</div>
		<!--</div>-->';
	}
	else {
		echo $emailErr;
	}
}

/*
* Formulario HTML para modificar los datos de los Protocolos.
* Actualiza la información y sólo se construye si es seleccionado un protocolo en particular.
* @ Recibe $protocoloID a partir de writeProtocoloTable().
*/
function protocolosUpdateForm() {
	global $nombreErr, $protocoloID;
	$datos = getDataProtocolo($protocoloID);
	$ProtocoloID = $Protocolo = "";
	foreach($datos as $row) {
		$ProtocoloID = $row['ProtocoloID'];
		$Protocolo = $row['Protocolo'];
	}
	if ($protocoloID) {
			echo '
		<!--<div class="w3-row-padding" style="margin:8 -16px">-->
			<form id="update_protocolos" action="" method="post" accept-charset="utf-8">
				<div class="w3-third w3-margin-bottom">
					<label for="protocoloName">Nombre del protocolo</label>
					<input type="text" id="protocoloName" name="Protocolo" placeholder="Protocolo.." value="'.$Protocolo.'"><span class="error"> * '.$nombreErr.'</span>
				</div>
					<input type="hidden" name="ProtocoloID" value="'.$ProtocoloID.'" />
					<input type="hidden" name="action" value="updateProtocolo" />
					<input class="" type="submit" value="Aceptar">
			</form>
		<!--</div>-->';
	}
	else {
		echo $nombreErr;
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
		<table id="Medicos">';
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
					<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Modificar">
				</td>
			</tr>
		</form>';
  	}
	echo '
		</table>';
}


/*
* Tabla HTML de los Usuarios.
* Genera la lista completa de los usuarios y permite seleccionar sólo un usuario ($usuarioID).
* @ $usuarioID se define en el main (rcpip-incmnsz.php).
*/
function writeUsersTable($roles = 1) {
	// Escribe la Tabla de Usuario
	//if ($roles == NULL) {
		// Significa distinto a '0' (que tiene un tipo de usario asignado)
	//	$roles = 1;
	//} else {
	//	$roles = 0;
	//}
	global $usuarioID;
	$email = $username = $return = "";

	if ($roles == 1) {
		$buttonText = "Modificar";
	} else {
		$buttonText = "Definir tipo de usuario";
	}
	$datos = getDataUsers($usuarioID, $roles);
	echo '
	<ul class="list-group">';
	// Actualiza la tabla People con la información de $usuarioID
	if ($usuarioID) {
		//$return = addUsuario($usuarioID, $username, $email);
	}
	foreach($datos as $row) {
		if ($usuarioID) {
			$email = $row["email"];
			$username = $row["username"];
			$return = addUsuario($usuarioID, $username, $email);
		}
		echo '
		<li class="list-group-item">
			'.$return.'
			<!--<table id="users">-->
			<form action="" method="post" accept-charset="utf-8">
				
					<td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
					<td>'.$row['id'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['roles_mask'].'</td>
					<td>
						<input type="hidden" name="usuarioID" value="'.$row['id'].'">
						<input class="" type="submit" value="'.$buttonText.'">
					</td>
				
			</form>
			<!--</table>-->
		</li>
		';
  	}
	echo '
	</ul>
		<!--</table>-->';
}

/*
* Tabla HTML de los Usuarios.
* Genera la lista completa de los usuarios y permite seleccionar sólo un usuario ($usuarioID).
* @ $usuarioID se define en el main (rcpip-incmnsz.php).
*/
function writePeopleTable() {
	// Escribe la Tabla de Usuario
	global $usuarioID;
	$datos = getDataPeople($usuarioID);
	echo '
		<table id="People">';
	foreach($datos as $row) {
		echo '
		<form action="" method="post" accept-charset="utf-8">
			<tr>
				<td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
				<td>'.$row['Nombre'].'</td>
				<td>'.$row['Sexo'].'</td>
				<td>'.$row['Ocupacion'].'</td>
				<td>'.$row['Domicilio'].'</td>
				<td>'.$row['Lugar_nacimiento'].'</td>
				<td>'.$row['Fecha_nacimiento'].'</td>
				<td>'.$row['Estado_civil'].'</td>
				<td>'.$row['Escolaridad'].'</td>
				<td>'.$row['Edad'].'</td>
				<td>'.$row['Tel_casa'].'</td>
				<td>'.$row['Celular'].'</td>
				<td>'.$row['Tel_trabajo'].'</td>
				<td>'.$row['Email'].'</td>
				<td>'.$row['rol'].'</td>
				<td>'.$row['FolioID'].'</td>
				<td>'.$row['IDUIEM'].'</td>
				<td>
					<input type="hidden" name="usuarioID" value="'.$row['PeopleID'].'">
					<input class="w3-button w3-teal w3-padding-large w3-hover-black" type="submit" value="Modificar">
				</td>
			</tr>
		</form>';
  	}
	echo '
		</table>';
}

/*
* Tabla HTML de los Protocolos.
* Genera la lista completa de los protocolos y permite seleccionar sólo un protocolo ($protocoloID).
* @ $protocoloID se define en el main (rcpip-incmnsz.php).
*/
function writeProtocoloTable() {
	// Escribe la Tabla de Protocolo
	global $protocoloID;
	$datos = getDataProtocolo($protocoloID);
	echo '
					<table id="Protocolo">';
	foreach($datos as $row) {
		echo '
						<form action="" method="post" accept-charset="utf-8">
							<tr>
								<td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
								<td>'.$row['ProtocoloID'].'</td>
								<td>'.$row['Protocolo'].'</td>
								<td>
									<input type="hidden" name="protocoloID" value="'.$row['ProtocoloID'].'">
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
  		<div class="container">
  		<div id="logo">
  			<img src="imgs/incmnsz.png">
  		</div>
  			<form class="form-signin" action="" method="post" accept-charset="utf-8">
  			  <!--<h2 class="form-signin-heading">Bienvenido</h2>-->
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
        		<button class="btn btn-lg btn-primary btn-block" type="submit" >Ingresar</button>
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


// R24hrs
function writeR24hrsTable($PeopleID) {
	// Escribe la Tabla de Protocolo
	global $db;
	$id = $PeopleID;
	$fecha = "2017-12-15";
	$datos = getDataR24hrs($id, $fecha);
	echo '
		<table id="R24hrs-'.$id.'">
			<tr>'.$id.'</tr>';

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
				<td>'.$row['FechaR24'].'</td>
				<td><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a></td>
			</tr>';
  	}
	echo '
		</table>';
}


/*
* Construye formulario para ingresar nuevo usuario al sistema.
* Ingreso de nuevos usuarios.
*/
function showCreateUserForm() {
	global $db;
	echo '
			<form action="" method="post" accept-charset="utf-8">
			<div class="row top-buffer"></div>
			<div class="row top-buffer">
			   <div class="col-md-1"></div>
				<div class="col-md-5">
					<input type="hidden" name="action" value="admin.createUser" />
					<input type="text" name="email" placeholder="Correo electrónico" />
					<p>Ingresar correo</p>
				</div>
				<div class="col-md-5">
					<input type="text" name="password" placeholder="Contraseña nueva para este sistema" />
					<p>Ingresar una contraseña</p>
				</div>
				<div class="col-md-1"></div>
			</div>
			<div class="row">
			    <div class="col-md-1"></div>
				<div class="col-md-10">
					<input type="text" name="username" placeholder="Nombre del usuario" />
					<p>Su nombre completo</p>

					<!-- value=1 := Nombre de Usuario Único-->
					<input type="hidden" name="require_unique_username" value="1">	
					<button class="" type="submit">Registrar nuevo usuario</button>				
				</div>
				<div class="col-md-1"></div>		
			</div>

				
				
				
				
				
				

	            
			</form>';
}

/*
* Construye formulario para asignar el tipo de usuario.
* Asigna tipo de usuario.
*/
function showAddRoleForm() {
	global $db, $usuarioID;
	$email = $username = $roles = "";

	$datos = getDataUsers($usuarioID, $roles);
	foreach($datos as $row) {
		$email = $row["email"];
		$username = $row["username"];
	}

	if ($usuarioID) {
		echo '
		<div class="w3-container w3-whitegray">
		<form action="" method="post" accept-charset="utf-8">
			<input type="hidden" name="action" value="admin.addRole" />
			<input type="text" name="id" placeholder="'.$usuarioID.'" value="'.$usuarioID.'" readonly />
			<select name="role">
				' . \createRolesOptions() . '
			</select>
			<button class="" type="submit">Asignar el tipo de usuario</button>
		</form>
		</div>';
		// Actualiza la tabla People con la información de $usuarioID
		function addPeople ($usuarioID, $email, $username) {
			$return = addUsuario();
			return $return;
		}
	} else {
		//do nothing;
	}
}

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