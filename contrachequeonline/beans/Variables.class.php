<?php
	///File to guard general informations of sistem.	
	class Variables{
		public $dbHost; //Host of MySql DB server.
		public $dbUser; // User name to log in MySql.
		public $dbPassword; //Password to log in MySQL.
		public $dbName; // Name of database's Contracheque Online sistem in MySql DB.
		
		function __construct(){
			$this->dbHost 	= "localhost";
			$this->dbUser 		= "root";
			$this->dbPassword 	= "root";
			$this->dbName 		= "contrachequeonline";
			/*
			$this->dbHost 		= "mysql06.cgsus.saude.ws";
			$this->dbUser 		= "cgsus5";
			$this->dbPassword 	= "saude10*";
			$this->dbName 		= "cgsus5";	*/
		}
	}
?>
