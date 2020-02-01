<?php

 class dbAction
 {

 	public function __construct()
 	{
 		//$this->con = mysqli_connect("localhost","pune_Apps","jIrlF4t({I#4","doctorAppli");
        $this->con = mysqli_connect("194.59.165.24","abhash","abhash@123456","doctor_app");

 	}
 	
 	public function insert($tableName,$value)
 	{
        $result = false;
		 $insert = "insert into ".$tableName." ".$value;
		 echo "insertt copmmand";
		 echo $insert;

 		$run = mysqli_query($this->con,$insert);
 		if($run)
 		{
			 echo "executing the query done";
 			$result = true;
		}
		return $result;
 	}



 	public function update($tableName,$value,$condition)
 	{
		 $update = "update ".$tableName." set ".$value." where ".$condition;
		 echo "update query";
		 echo $update;
 		$run = mysqli_query($this->con,$update);
 		if($run)
 		{
			 $result = true;
			 echo "resulted true";
 		}
 		else{
			 $result = false;
			 echo "result false";
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