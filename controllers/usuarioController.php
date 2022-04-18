<?php
class usuarioController extends ControllerBase
{
	public function __construct(){		
		parent::__construct();		
		require_once('libs/PHPMailer.php');
		require_once('libs/SMTP.php');
		require_once('models/usuarioModel.php');
	}
	
//#######
//Accion#
//#######
    public function index()
    {   
    	$this->restringirAcceso();
		exit;
    }
	

	public function listar()
    {   
    	$this->restringirAcceso();
		$usr = new usuarioModel;
		$this->vars['usuarios'] = $usr->seleccionarTodos();
		$this->vars["seccion"]="usuarios_listar.php";
		$this->view->show("normal.php", $this->vars);
		exit;
    }



    
//#######
//Accion#
//#######
    public function registrar()
    {	
		$mail = new PHPMailer(true);

		if($_POST){
			$usr = new usuarioModel;

			//Validacion
			$this->vars['error_val']=array();

			$usr_nombre = $_POST['usr_nombre'];
			$usr_apellido = $_POST['usr_apellido'];
			$usr_mail = $_POST['usr_mail'];
			$usr_usuario = $_POST['usr_usuario'];
			$usr_pass = $_POST['usr_pass'];
			


			//Check nombre
			//Las conciones son que el nombre tenga mas de 2 caracteres y hasta un maximo de 20 de largo y solo contenga letras
			if(!ctype_alpha($usr_nombre) || strlen($usr_nombre) < 2 || strlen($usr_nombre) > 20){
				$this->vars['error_val']['usr_nombre']='El Nombre debe tener entre 3 y 20 caracteres y solo contener letras';
			}

			//Check apellido
			//Las conciones son que el nombre tenga mas de 2 caracteres y hasta un maximo de 20 de largo y solo contenga letras
			if(!ctype_alpha($usr_apellido) || strlen($usr_apellido) < 2 || strlen($usr_apellido) > 20){
				$this->vars['error_val']['usr_apellido']='El Apellido ser de al menos 3 caracteres con un maximo de 20 y solo contener letras';
			}


			//Check mail
			//El mail debe ser un mail correctamente formado
			if(filter_var($usr_mail,FILTER_VALIDATE_EMAIL) == false){
				$this->vars['error_val']['usr_mail']='El mail es incorrecto';
			}


			//Check nombre de usuario
			//Las conciones son que el nombre tenga mas de 2 caracteres y hasta un maximo de 20 de largo y solo contenga letras y numeros y sea en minusculas
			if(!ctype_lower($usr_usuario) || !ctype_alnum($usr_usuario) || strlen($usr_usuario) < 2 || strlen($usr_usuario) > 20){
				$this->vars['error_val']['usr_apellido']='El nombre de usuario solo puede contener letras y numeros en minusculas con un tamaño de 3 a 20 caracteres';
			}

			$pass_sinNumeros = preg_replace('~[0-9]+~', '', $usr_pass);
			if(ctype_lower($pass_sinNumeros) || ctype_upper($pass_sinNumeros) || !preg_match('~[0-9]+~', $usr_pass) || !ctype_alnum($usr_pass) || strlen($usr_pass ) < 8 || strlen($usr_usuario) > 50){
				$this->vars['error_val']['usr_pass']='Debes utilizar un pasword mas fuerte de al menos 8 caracteres con mayusculas minusculas y numeros';
			}

			//Check contraseñas iguales
			if($_POST['usr_pass'] <> $_POST['usr_repass']){
				$this->vars['error_val']['usr_pass']='Las contraseñas no coinciden';
			}
			
			//Chequeo que el usuario no exista en la base
			if($usr->existeUsuario($_POST['usr_usuario'])){
				$this->vars['error_val']['usr_usuario']='El usuario ya existe';
			}

			if(count($this->vars['error_val']) == 0){
				$tkn = bin2hex(random_bytes(16));
				if($usr->insertarUsuario($usr_nombre,$usr_apellido,$usr_mail,$usr_usuario,$usr_pass) && $usr->insertarActivacion($usr_usuario, $tkn)){
						
					//Server settings
					$mail->SMTPDebug = false; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
					$mail->isSMTP();                                            //Send using SMTP
					$mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
					$mail->SMTPAuth = true;                                   //Enable SMTP authentication
					$mail->Username = 'sseguridad666@gmail.com';                     //SMTP username
					$mail->Password = 'Ucu2021*';                               //SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
					$mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

					//Recipients
					$mail->setFrom('sseguridad666@gmail.com', 'Seguridad');
					$mail->addAddress($usr_mail, $usr_nombre);     //Add a recipient
					$mail->addReplyTo('sseguridad666@gmail.com', 'Seguridad');
				
					//Content
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'Nuevo usuario';
					$mail->Body    = 'Presione el link para activar su usuario <a href="localhost/login/index.php?ctrl=usuario&act=activarUsr&tkn='.$tkn.'"> Activar </a>';
				


					$mail->send();		

					$this->view->show("registro_exito.php", $this->vars);
					exit;
				}
				else{
					$this->vars['msg_error']= "Ocurrió un error al registrar el usuario, si el problema persiste comuniquese por el el formulario de contacto";
					$this->view->show("error.php", $this->vars);
					exit;	
				}
			}			
			
			foreach($_POST as $k=>$v){
				//$this->vars["valor_campo"][$k]= $v;				
				$this->vars["valor_campo"][$k]= htmlspecialchars(strip_tags($v));				
			}


		}
		$this->view->show("registro.php", $this->vars);
		exit;
	}	


    public function activarUsr()
    {	
		if(isset($_GET["tkn"])){
			$this->vars["tkn_token"] = htmlspecialchars(strip_tags($_GET["tkn"]));
		}

		if($_POST){
			$this->vars["msg"] = "hola";
			$usr = new usuarioModel;
			$tkn_token = htmlspecialchars(strip_tags($_POST["tkn_token"]));
			$difTimestamp = $usr->verificoTknUsr($tkn_token);
			if(!empty($difTimestamp)){
				if($difTimestamp['tkn_timestamp']<1800){
					$usr->activarUsuario($difTimestamp['usr_usuario']);
					$this->vars["msg"] = "Su usuario ha sido activado";
				}else{
					$this->vars["msg"] = "Su token ha expirado";
				}
			}else{
				$this->vars["msg"] = "El usuario no existe";
			}
		}

		$this->vars["seccion"]="activar.php";
		$this->view->show("normal.php", $this->vars);
		exit;
	}

	
    public function funcionalidad(){
		$this->vars["seccion"]="funcionalidad.php";
		$this->view->show("normal.php", $this->vars);
		exit;

	}


}
?>