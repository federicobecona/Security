<?php
class usuarioModel extends ModelBase
{

	//######SELECT
	//Si existe el usuario retorna TRUE
	public function existeUsuario($usr)
	{
		$sql="SELECT COUNT(*) as usr_exist FROM usuarios WHERE usr_usuario = ? LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usr));
		$row = $consulta->fetch(PDO::FETCH_ASSOC);
		
		if($row['usr_exist'] > 0)
		    return true;
		else
		    return false;					
	}

	public function esAdmin($usr)
	{
		$sql="SELECT COUNT(*) as usr_exist FROM usuarios WHERE usr_usuario = ? and rol_id = 2 LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usr));
		$row = $consulta->fetch(PDO::FETCH_ASSOC);
		
		if($row['usr_exist'] > 0)
		    return true;
		else
		    return false;					
	}

	//Seleccionar estado por usuario
	public function seleccionarEstadoXUsuario($usr)
	{
		$sql="SELECT usr_estado FROM usuarios WHERE usr_usuario = ? LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usr));
		$fila = $consulta->fetch(PDO::FETCH_NUM);
		return $fila[0];
	}

	//Seleccion todos los usuarios
	public function seleccionarTodos()
	{		
		$sql="SELECT * FROM usuarios";
		$consulta = $this->db->prepare($sql);
		$consulta->execute();
		$i=0;
		while($fila = $consulta->fetch(PDO::FETCH_OBJ))
		{	
			foreach ($fila as $key => $value) 
            {
            	$datos[$i][$key] = $value;
            }
			$i++;
		}
		return $datos;
	}


	//Seleccion ...
	public function comprobarPermisoFuncionalidad($usr,$token)
	{
		$config = Config::singleton();
		$sql="SELECT count(*) as usr_autorizado FROM usuarios usr INNER JOIN rol r ON usr.rol_id = r.rol_id INNER JOIN 
			rol_funcionalidad rf ON r.rol_id = rf.rol_id INNER JOIN funcionalidad fun ON rf.func_id = fun.func_id INNER JOIN 
			controlador ctr ON fun.ctrl_id = ctr.ctrl_id WHERE usr_usuario = ? AND usr_token = ? AND ctrl_nombre = ? AND act_nombre = ?";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usr,$token,$config->get('controllerName'),$config->get('actionName')));
		$row = $consulta->fetch(PDO::FETCH_ASSOC);
		
		if($row['usr_autorizado'] > 0)
		    return true;
		else
		    return false;		
	}


	//######INSERT
	//Insertar un nuevo Usuario
	public function insertarUsuario($nombre,$apellido,$mail,$usuario,$pass)
	{	
		//Encripto pass
		$config = Config::singleton();
		$pepper = $config->get('pepper');
		$pass = $pass . $pepper;
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		$sql="INSERT INTO usuarios(usr_nombre,usr_apellido,usr_mail,usr_usuario,usr_pass) VALUES(?,?,?,?,?)";

		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($nombre,$apellido,$mail,$usuario,$pass));				

		if($consulta->rowCount() > 0)
			return true;
		else 
			return false;
	}


	public function insertarActivacion($usuario, $tkn)
	{	
		$sql="INSERT INTO activacion(usr_usuario, tkn_token, tkn_timestamp) VALUES(?,?, CURRENT_TIMESTAMP())";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usuario, $tkn));				
		if($consulta->rowCount() > 0)
			return true;
		else 
			return false;
	}

	public function verificoTknUsr($tkn)
	{
		$sql="SELECT CURRENT_TIMESTAMP - tkn_timestamp as diftimestamp, usr_usuario FROM activacion WHERE tkn_token = ? ORDER BY tkn_timestamp DESC LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($tkn));
		$row = $consulta->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	//######UPDATE
	public function activarUsuario($usuario)
	{
		$sql="UPDATE usuarios SET usr_estado = 1 WHERE usr_usuario = ?";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usuario));
	}

		

}
?>