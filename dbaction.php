<?php

 class dbAction
 {

 	public function __construct()
 	{
 		//$this->con = mysqli_connect("localhost","pune_Apps","jIrlF4t({I#4","doctorAppli");
        $this->con = mysqli_connect("localhost","root","","doctor_app");

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
 		$run = mysqli_query($this->con,$update);
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