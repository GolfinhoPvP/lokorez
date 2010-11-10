<?php
	/* This archieve connects in MySql - Server = localhost*/
	class Connect {
	
		private $dbHost; //Host of MySql DB server.
		private $dbUser; // User name to log in MySql.
		private $dbPassword; //Password to log in MySQL.
		private $dbName; // Name of database's Contracheque Online sistem in MySql DB.
		private $connectionStarted; //Guard a pointer to connection
		
		function __construct($h, $u, $p, $n){
			$this->dbHost 	= $h;
			$this->dbUser 	= $u;
			$this->dbPassword = $p;
			$this->dbName 	= $n;
		}
		
		//Connect to MySQL server
		public function start(){		
			if(!($this->connectionStarted = mysql_pconnect($this->dbHost, $this->dbUser, $this->dbPassword)))
				return false; // Impossible to connect to server.
				
			//Select the database
			if(!(mysql_select_db($this->dbName, $this->connectionStarted)))
				return false; // Impossible to select the database.
								
			return true;
		}
		
		//Execute query
		public function execute($query){
			$result;
			
			if(empty($query) || ($this->connectionStarted == NULL)){
				//die($this->connectionStarted."- Error, ivalid arguments");
				return false; //Error, ivalid arguments
			}

			if(!($result = mysql_query($query, $this->connectionStarted))){
				//die("Error in the consult".mysql_error($this->connectionStarted));
				return false; //Error in the consult
			}
							
			return $result;
   		}
		
		//Close the connection to data base
		public function close(){
			return mysql_close($this->connectionStarted);
		}
		
		public function counterResult($r){
			return mysql_num_rows($r);
		}
		
		public function counterAffected(){
			return mysql_affected_rows($this->connectionStarted);
		}
		
		public function antiInjection($variable){
			$variable = strip_tags($variable); //  it retires the HTML's tags
			$variable = mysql_escape_string($variable); //It retires the MySQL references tags exemple: select, insert, update, drop...
			return $variable;
		}
		
		function __destruct(){
			$this->close();
		}
	} 
?>
