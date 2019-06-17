<?php
include 'dbaction.php';
class getActivity{


     public function __construct()
       {
          $this->con = mysqli_connect("localhost","root","","doctor_app");

          //$this->con = mysqli_connect("localhost","pune_Apps","jIrlF4t({I#4","doctorAppli");

          $this->cAction = new dbAction();
       }

     public function companyDetails($ind)
     {
       $tableName = "com_details";
       $condition = "where inddd='$ind'";

       $select = "select * from "."$tableName ".$condition;
       $run = mysqli_query($this->con,$select);
       $check = mysqli_num_rows($run);
       if($check==1)
       {
          $result = true;
       }
       else{
       	  $result = false;
       }return $result;
     }

     
     public function checkUserStatus($email)
     {
       $tableName = "login_details";
       $condition = "where email='$email'";

       $select = "select * from "."$tableName ".$condition;
       $run = mysqli_query($this->con,$select);
       $check = mysqli_num_rows($run);
       if($check==1)
       {
       	 $result = false;
       }
       else{
       	$result = true;
       }return $result;
     }



     public function register($email,$pass,$rand)
     {
       $tableName = "login_details";
       $value = "(randum,email,pass) value('$rand','$email','$pass')";
       $result = $this->cAction->insert($tableName,$value);
       if($result)
       {
       	 $result = true;
       }return $result;
     }


     public function login($userId,$passWord,$did)
     {

     	//check user id and password
     	$tableName = "login_details";
     	$condition = "email='$userId' AND pass='$passWord'";

     	$select = "select * from ".$tableName." where ".$condition;
     	$run = mysqli_query($this->con,$select);
     	while ($rr = mysqli_fetch_array($run)) {
     		$randum = $rr['randum'];
     	}
     	$check = mysqli_num_rows($run);
     	if($check==1)
     	{
             $tableName  = "login_details";
             $value = "deviceId='$did'";
             $condition = "email='$userId'";

             $result2 = $this->cAction->update($tableName,$value,$condition);

            if($result2){
             $newArray =  array('status' => 1,
                                'randum' => $randum);
            }
     	}
     	else
     		{
     	     $newArray =  array('status' => 2,
                                'randum' => null );		
     		}return $newArray;
     }


     public function checkuserTrue($UserKey)
     {
     	$tableName = "login_details";
     	$condition = "randum='$UserKey'";

     	$select = "select * from ".$tableName." where ".$condition;
     	$run = mysqli_query($this->con,$select);
     	$check = mysqli_num_rows($run);
     	if($check==1)
     	{
     		$result = true;
     	}
     	else
     	{
     		$result = false;
     	}return $result;
     }


    //user data insert/update area
     public function updateUserData($name,$lname,$ag,$gender,$mobile,$address,$bldgrp,$height,$wght,$prnt,$kdsDetls,$UserKey)
     {
     	$longt = "12.34535.34";
     	$lat = "34.2334.33";
        $tableName = "login_details";
        $value = "name='$name',last_name='$lname',age='$ag',gender='$gender',mobile='$mobile',address='$address',bloodgroup='$bldgrp',height='$height',weight='$wght',prents='$prnt',kidsDetails='$kdsDetls',longt='$longt',lat='$lat'";
        $condition = "randum='$UserKey'";

        $result = $this->cAction->update($tableName,$value,$condition);

        if($result)
        {
        	$result2 = true;
        }
        else
        {
        	$result2 = false;
        }
        return $result2;
     }


     public function chat($UserKey,$message,$type)
     {
     	$tableName = "chat";
     	date_default_timezone_set('Asia/Calcutta'); 
     	$dateValue = date("d/m/Y");
     	$timeValue = date("h:i:s");
     	$value = "(randum,type,message,data_value,time_value) VALUES ('$UserKey','$type','$message','$dateValue','$timeValue')";

     	return $result = $this->cAction->insert($tableName,$value);
     }


     public function chatdatafetch($ind,$UserKey)
     {

       

     }


     public function forget($userId)
     {
        $select  = "select * from login_details where email='$userId'";
        $run = mysqli_query($this->con,$select);
        $check = mysqli_num_rows($run);
        if($check==1)
        {
           while ($dd = mysqli_fetch_array($run))
           {
              $pass = $dd['pass'];
           }

            $arrayName = array('status' => 1,
                               'password' => $pass );

           $result = $arrayName;

        }
        else
        {
          $result = false;
        }return $result;


     }


     public function fetchData($UserKey)
      {
        //now pic user data.
        $tableName = "login_details";
        $select = "select * from ".$tableName." where randum='$UserKey'";
        $run = mysqli_query($this->con,$select);
        while($rr = mysqli_fetch_array($run))
        {
          //user data here...
             $email = $rr['email'];
             $pass = $rr['pass'];
             $name = $rr['name'];
             $last_name = $rr['last_name'];
             $gender = $rr['gender'];
             $mobile = $rr['mobile'];
             $age = $rr['age'];
             $address = $rr['address'];
             $bloodgroup = $rr['bloodgroup'];
             $height = $rr['height'];
             $weight = $rr['weight'];
             $prents = $rr['prents'];
             $kidsDetails = $rr['kidsDetails'];
             $long = $rr['longt'];
             $lat = $rr['lat'];
          //its convert to an array...
              
        }

         return $userDetails = array('email' => $email,
                              'pass' => $pass,
                              'name' => $name,
                              'lname' => $last_name,
                              'gender' => $gender,
                              'mobile' => $mobile,
                              'age' => $age,
                              'address' => $address,
                              'bloodgroup' => $bloodgroup,
                              'height' => $height,
                              'weight' => $weight,
                              'prents' => $prents,
                              'kidsDetails' => $kidsDetails,
                              'long' => $long,
                              'lat' => $lat );
      }



      public function bookingApp($UserKey,$bbiId)
      {
         //check booking slot status
         $tableName = "bookingstructure";
         $nul = null;
         $condition = "id='$bbiId' AND status='$nul'";
         $select = "select * from ".$tableName." where ".$condition;
         $run = mysqli_query($this->con,$select);
         $check = mysqli_num_rows($run);
         if($check==1)
         {
            $value = "status='book',uniqueId='$UserKey'";
            $result = $this->cAction->update($tableName,$value,$condition);
         }
         else
         {
            $result = false;
         }

         return $result;
      }



   


      public function fetchslot()
      {
           $rrrr = array();
        $tableName = "bookingstructure";
         $select = "select * from ".$tableName;
         $run = mysqli_query($this->con,$select);
         while ($rr = mysqli_fetch_array($run)) 
         {
              $id = $rr['id'];
              $date = $rr['date'];
              $time = $rr['time'];
              $slotNo = $rr['slot_no'];
              $status = $rr['status'];
              $remark = $rr['remark'];

              $fr = array('id' => $id,
                          'date' => $date,
                          'time' => $time,
                          'slotNo' => $slotNo,
                          'status' => $status,
                          'remark' => $remark );

              $rrrr[] = $fr;

         }
        return $rrrr;
      } 



}
?>