<?php

 class dbAction
 {

 	public function __construct()
 	{
 		$servername = "mysql:unix_socket=/cloudsql/doctor-mobile-application:asia-south1:doctor-app;dbname=doctor_app";
        $username = "root";
        $dbname = "doctor_app";
        $password = "123456";
        try 
        {
              $this->con = new PDO($servername, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(PDOException $e) {
             die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
            echo("Can't open the database.". $e);
        }
            //$this->con = new mysqli(null, $username, $password, $dbname, $servername);
 	}
 	
 	public function insert($tableName,$value)
 	{
        $result = false;
 		$insert = "insert into ".$tableName." ".$value;
 		$run = mysqli_query($this->con,$insert);
 		if($run)
 		{
 			$result = true;
		}
		return $result;
 	}



 	public function update($tableName,$value,$condition)
 	{
 		$update = "update ".$tableName." set ".$value." where ".$condition;
 		$run = $this->con->query($update);
 		if($run)
 		{
 			$result = true;
 		}
 		else{
 			$result = false;
 		}
 		return $result;
 	}


 	public function delete()
 	{
 		# code...
 	}



 	public function select()
 	{
 		# code...
 	}
 }


?>