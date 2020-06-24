<?php 

	class Database{
		private static $driver=DRIVER;
		private static $port=PORT;
		private static $server=SERVER;
		private static $dbname=DBNAME;
		private static $user=USER;
		private static $pass=PASSWORD;
		private static $connect;

		function __construct(){
			
		}
		

		public function getInstance(){
			$con = self::$driver.":host=".self::$server.":".self::$port.";dbname=".self::$dbname;

			if(!isset(self::$connect)){
				self::$connect = new PDO($con, self::$user, self::$pass, array(PDO::ATTR_PERSISTENT=>TRUE));
				self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

			}

			return self::$connect;
		}

		public function __clone(){
			trigger_error("cannot be cloned",E_USER_ERROR);
		}
	}

 ?>