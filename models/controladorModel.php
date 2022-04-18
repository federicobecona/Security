<?php
class controladorModel extends ModelBase
{
	public function existeControlador($ctrl)
	{
		$sql="SELECT COUNT(*) as ctrl_exist FROM controlador WHERE ctrl_nombre = ? LIMIT 1";
		$consulta = $this->db->prepare($sql);
		$consulta->execute(array($ctrl));
		$row = $consulta->fetch(PDO::FETCH_ASSOC);
		if($row['ctrl_exist'] > 0)
		    return true;
		else
		    return false;					
	}
		
}
?>