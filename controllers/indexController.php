<?php
class indexController extends ControllerBase
{
	public function __construct(){		
		parent::__construct();	
	}	
//#############
//Action-Index#
//#############

    public function index()
    {      
    	$this->restringirAcceso();      
      if(isset($_GET['msg']) && $_GET['msg']=="permiso_denegado"){
        $this->vars["msg"]="No está autorizado para acceder a esa sección";
      }

      $this->vars["seccion"]="inicio.php";
      $this->view->show("normal.php", $this->vars);
    }

    public function accion()
    {	
		
    }

}
?>