<?php
class loginModel extends ModelBase
{
	public function esValidoUsuario($usr,$pass)
	{
		//realizamos la consulta del usuario y la contrase�a
		//CORREGIR
		
		$sql="SELECT COUNT(*) FROM usuarios WHERE usr_usuario = ? AND cmsusr_pass = ?";
		$consulta = $this->db->prepare($sql);
		
		$consulta->execute(array($usr,$pass));

		var_dump($_POST['pass']);
		
		if($consulta->fetchColumn() > '0')
			return true;
		else 
			return false;
	}

	public function seleccionarHashXUsuario($usr)
	{
		$sql="SELECT usr_pass FROM usuarios WHERE usr_usuario = ? LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usr));
		$row = $consulta->fetch(PDO::FETCH_ASSOC);		
		return $row['usr_pass'];
	}


	//Seleccionar un Administrador por su mail
	public function seleccionarAdmXMail($mail)
	{
		$sql="SELECT * FROM usuarios WHERE usr_usuario = ? LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($mail));
		$fila = $consulta->fetch(PDO::FETCH_OBJ);
		foreach ($fila as $key => $value) 
        {
        	$datos[$key] = $value;
        }		 
		return $datos;
	}
	
	
	public function actualizaToken($token,$usr)
	{
		//realizamos el update
		$sql="UPDATE usuarios SET usr_token = ? WHERE usr_usuario = ?";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($token,$usr));
	}
	
	public function comprobarToken($usr,$token)
	{		 
		$sql="SELECT * FROM usuarios WHERE usr_usuario = ? AND usr_token = ?";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($usr,$token));
		if($consulta->fetchColumn() > '0')
			return true;
		else 
			return false;
	}
	
	
	
}
?>