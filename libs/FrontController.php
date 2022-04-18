<?php
class FrontController
{
	static function main()
	{
		//Incluimos algunas clases:
		
		require 'libs/Config.php'; //de configuracion
		require 'libs/SPDO.php'; //PDO con singleton
		require 'libs/ControllerBase.php'; //Clase controlador base
		require 'libs/ModelBase.php'; //Clase modelo base
		require 'libs/View.php'; //Mini motor de plantillas
		require 'models/controladorModel.php'; //Clase modelo base
		require 'config2.php'; //Archivo con configuraciones.
		
		//Con el objetivo de no repetir nombre de clases, nuestros controladores
		//terminaran todos en Controller. Por ej, la clase controladora Items, ser� ItemsController
		
		//Formamos el nombre del Controlador o en su defecto, tomamos que es el loginController
		if(! empty($_GET['ctrl']))
		      $controllerName = $_GET['ctrl'] . 'Controller';
		else
		      $controllerName = "indexController";
		
		//Lo mismo sucede con las acciones, si no hay accion, tomamos login como accion
		if(! empty($_GET['act']))
		      $actionName = $_GET['act'];
		else
		      $actionName = "index";
		
		$controllerPath = $config->get('controllersFolder') . $controllerName . '.php';
		
		//whitelist controladores
		$ctrlModel = new controladorModel();
		if(!$ctrlModel->existeControlador($controllerName)){
			die ($controllerName . ' no es un controlador válido');
			return false;
		}		

		//Incluimos el fichero que contiene nuestra clase controladora solicitada	
		if(is_file($controllerPath))
		      require $controllerPath;
		else
		      die ('El controlador no existe - 404 not found');
		
		//Si no existe la clase que buscamos y su accion, tiramos un error 404
		if (is_callable(array($controllerName, $actionName), true) == false) 
		{
			trigger_error ($controllerName . '->' . $actionName . '` no existe', E_USER_NOTICE);
			return false;
		}

		$config->set('controllerName',$controllerName);
		$config->set('actionName',$actionName);
		

		//Si todo esta bien, creamos una instancia del controlador y llamamos a la accion
		$controller = new $controllerName();
		$controller->$actionName();
	}
}
?>