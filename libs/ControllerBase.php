<?php
abstract class ControllerBase{
    
    protected $view;
    
    function __construct()
    {
    	date_default_timezone_set("Europe/Madrid");
			if(@session_start() == false){@session_destroy();session_start();}
			
		//Rotacion de sesiones y expiracion 
		if (!isset($_SESSION['creado'])) {
			//Si no marque el tiempo de creacion
			$_SESSION['creado'] = time();
		} else if (time() - $_SESSION['creado'] > 900) {
			//Si ya pasaron 15 minutos regenero el id de sesion 
			session_regenerate_id(true);
			//Actualizo el tiempo de creacion 
			$_SESSION['creado'] = time(); 
		} 

		if(isset($_SESSION['utlimo_acceso']) && time() - $_SESSION['utlimo_acceso'] > 1800){			
			//Si pasaron 30 minutos desde el ultimo request expiro la sesion
			session_unset();     
			session_destroy();   
		}
		//Actualizo el utlimo acseso
		$_SESSION['utlimo_acceso'] = time();

		//Datos Administrador
        include_once('models/usuarioModel.php');        
        $adm = new usuarioModel;        
        $this->vars["row_adm"]=$adm->esAdmin($_SESSION['usr_usuario']);

        $this->view = new View();

		//Titulo por defecto
		$this->vars["titulo_pagina"] = "Seguridad";
		$this->vars["descripcion_pagina"] = "";
		$this->vars['error_val'] = array();	
			
    }
    
    public function restringirAcceso()
	{						
		if(!empty($_SESSION['usr_usuario']) && !empty($_SESSION['usr_token'])){			
			//Incluye el modelo que corresponde
			include_once('models/loginModel.php');
			include_once('models/usuarioModel.php');
			$log= new loginModel();
			$usr= new usuarioModel();

			if($usr->seleccionarEstadoXUsuario($_SESSION['usr_usuario']) != 1){
				session_destroy();
				header("Location:index.php?ctrl=login&msg_error=usr_inactivo");
				exit;
			}
			if($log->comprobarToken($_SESSION['usr_usuario'],$_SESSION['usr_token'])){				
				//Recalcular y actualizar token
				$_SESSION['usr_token'] = bin2hex(random_bytes(16));	
				$log->actualizaToken($_SESSION['usr_token'],$_SESSION['usr_usuario']);

				//Comprobar si esta autorizado
				if(!$usr->comprobarPermisoFuncionalidad($_SESSION['usr_usuario'],$_SESSION['usr_token'])){
					header("Location:index.php?msg=permiso_denegado");
           			exit;
				}	
			}
			else {
           		session_destroy();
           		header("Location:index.php?ctrl=login");
           		exit;
      		}
		}
		else{
  			header("Location:index.php?ctrl=login");  			
  			exit;
		}	
  	}
}
?>