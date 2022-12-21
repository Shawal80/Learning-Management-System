<?php  

	##################### DATABASE  CLASS ########################################
	class database 
		{
			public $hostname = "localhost";
			public $username = "root";
			public $password = "";
			public $database = "lms";
			public $connection = null;
			public $query = null;
			public $result = null;

			############## MAGICAL METHOD FOR CONNECTION WITH DATABASE STARTS HERE #######

			public function __construct()
			{
				$this->connection = mysqli_connect($this->hostname,$this->username,$this->password,$this->database);

				if (mysqli_connect_errno()) 
				{
					echo "<p style='color:red'><b> Database Connection Error: </b>".mysqli_connect_error()."</p>";
					echo "<p style='color:red'><b> Database Connection Error No: </b>".mysqli_connect_errno()."</p>";
				}
			}
			############################################################################
			################# METHOD FOR QUERY EXECUTION STARTS HERE ###################
			public function execute_query($query)
			{
				$this->query = $query ;
				$this->result = mysqli_query($this->connection,$this->query);
				return $this->result ;
			}

			###########################################################################

		}

		#################################  END OF DATABASE CLASS ##################################


?>