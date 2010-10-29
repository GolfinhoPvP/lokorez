<?php
	/* This archieve connects in MySql - Server = localhost*/
	class Connect {
	
		private $dbHost; //Host of MySql DB server.
		private $dbUser; // User name to log in MySql.
		private $dbPassword; //Password to log in MySQL.
		private $dbName; // Name of database's Contracheque Online sistem in MySql DB.
		private $connection; //Guard a pointer to connection
		
		function __construct(var $h, var $u, var $p, var $n){
			$dbHost 	= $h;
			$dbUser 	= $u;
			$dbPassword = $p;
			$dbName 	= $n;
		}
		
		//Connect to MySQL server
		function public connect(){			
			$connection = mssql_connect($host,$dbUser,$dbPassword) or
								return false; // Impossible to connect to server.
			//Select the database
			mysql_select_db($dbname,$connection) or
								return false; // Impossible to select the database.
			//return the connection pointer
			return $connection;
		}
		
		//Execute query
		function public execute(var $query, var $connection){
			private $result;
			
			if(empty($query) || ($connection == NULL))
				return false; //Error, ivalid arguments
			$result = mysql_query($sql,$id) or
							return false; //Error in the consult
			return $result;
   		}
} 
?>
