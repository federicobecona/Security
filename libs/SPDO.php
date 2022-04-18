<?php
class SPDO extends PDO 
{	
	private static $instance = null;	
	
	public function __construct() 
	{
		try {
			$config = Config::singleton();
			parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname') . ';charset=utf8', $config->get('dbuser'), $config->get('dbpass'));
			//$this->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
		}
    	catch ( Exception $e ) {
      	$ip = $_SERVER['REMOTE_ADDR'];	
		$this->error = $e->getMessage();
      	// do your log writing stuff here
      	file_put_contents( 'mylog.txt', date("Y/m/d H:i:s")."-(".$ip.")".$this->error."\r\n", FILE_APPEND);
			
    	}
	}

	public static function singleton() 
	{
		if( self::$instance == null ) 
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	
}
?>