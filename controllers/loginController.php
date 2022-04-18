<?php
class loginController extends ControllerBase
{
	public function __construct(){		
		parent::__construct();
		require_once 'models/loginModel.php';		
	}
	
//#############################################################
//Accion login - Muestra y procesa un formulario par loguearse#
//#####################################################	#######
    public function index()
    {
		//Creo una instancia
		$login = new loginModel();		
		if($_POST) {
			//Si no hay errores previos
			$this->vars['error_val'] = array();

			//validacion de los campos 
			$pass=$_POST['pass'];
			$usr = $_POST['usr'];
			//*********/

			//Chequeo si el usuario y la contraseña son validos
			if(count($this->vars['error_val']) == 0){			
				//Concatenamos el peper con la contraseña
				$config = Config::singleton();
				$pepper = $config->get('pepper');
				$pwd_peppered = $pass . $pepper;
				$pwd_hash = $login->seleccionarHashXUsuario($usr);		
				if(!password_verify($pwd_peppered, $pwd_hash)){
					$this->vars['error_val']['login_incorrecto']=utf8_encode('Usuario o password invalido');
				}			
			}
				
			//En caso de no existir error genero el token y guardo los datos en la sesion	
			if(count($this->vars['error_val']) == 0){
				$_SESSION['usr_usuario'] = $usr;
				//Generamos un token aleatorio para el usr_usuario							
				$_SESSION['usr_token'] = bin2hex(random_bytes(16));				

				//Actualizamos el token para en la DB
				$login->actualizaToken($_SESSION['usr_token'],$_SESSION['usr_usuario']);				
				header('Location: index.php'); 
				exit;
			}			
			//*************************CASO DE ERROR*************************
			//Paso los valores de los campos post para que se puedan corregir
			foreach($_POST as $k=>$v){
				$this->vars["valor_campo"][$k]=$v;				
			}
			//Seteo las clases de los campos con error 
			foreach($this->vars['error_val'] as $k=>$v){
				//Clase para el campo mismo
				$this->vars["error_clase"][$k]="reg-form-conerror";
				//Clase para el Texto
				$this->vars["error_clase"]['txt_'.$k]="form-descri-conerror";
			}
			//***************************************************************			
	 	}        
        	
        if(isset($_GET['msg_error']) && $_GET['msg_error']=="usr_inactivo"){        	
        	$this->vars['error_val']['usr_inactivo']="Este usuario no esta activado";	
        }
		$this->view->show("login.php", $this->vars);
    }
	
//################################################################
//Accion logout - Limpia la sesion y vuelve a la pagina de loguin#
//#####################################################	##########
    public function logout()
    {	
		$_SESSION=array();
		session_destroy();
		header("Location: index.php");
		exit;
	}	
}
?>