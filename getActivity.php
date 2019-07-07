<?php
include_once 'dbaction.php';
class getActivity{


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
        $this->cAction = new dbAction();
       }
     public function companyDetails($ind)
     {
       $tableName = "com_details";
       $condition = "where inddd='$ind'";
       $select = "select * from "."$tableName ".$condition;
       
       $run = $this->con->query($select);
       $check = $run->rowCount();
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
           $value = "(user_token,email,password) value('$rand','$email','$pass')";
       $result = $this->cAction->insert($tableName,$value);
       if($result)
       {
       	 $result = true;
       }
       return $result;
     }


     public function login($userId,$passWord,$did)
     {
     	$tableName = "login_details";
     	$condition = "email = '$userId' AND password ='$passWord'";
     	$token = '';
     	$responseArray = array();
     	$select = "select * from ".$tableName." where ".$condition;
     	$run = $this->con->query($select);
     	while ($rr = $run->fetch()) {
     		$token = $rr['user_token'];
     	}
     	$check = $run->rowCount();
     	if($check==1)
     	{
             $tableName  = "login_details";
             $value = "device_id = '$did'";
             $condition = "email = '$userId'";
             $updateResult = $this->cAction->update($tableName,$value,$condition);
             if($updateResult){
                $responseArray =  array('status' => 1,
                                'user_token' => $token);
             }
     	}
     	else
     	{
     	     $responseArray =  array('status' => 2,
                                'user_token' => $token );
     	}
     	return $responseArray;
     }


     public function checkuserTrue($UserKey)
     {
     	$tableName = "login_details";
     	$condition = "user_token='$UserKey'";

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
     public function updateUserData($firstName,
                                    $lastName,
                                    $age,
                                    $gender,
                                    $mobileNumber,
                                    $address,
                                    $bloodGroup,
                                    $height,
                                    $weight,
                                    $medicalHistorySelf,
                                    $lastVisitDate,
                                    $medicalHistorySpouse,
                                    $medicalHistoryParents,
                                    $medicalHistoryKids,
                                    $UserKey,
                                    $longitude,$latitude)
     {
        $tableName = "login_details";
        $value = "first_name='$firstName',
        last_name='$lastName',
        age='$age',
        gender='$gender',
        mobile='$mobileNumber',
        address='$address',
        blood_group='$bloodGroup',
        height='$height',
        weight='$weight',
        medical_history_self = '$medicalHistorySelf',
        last_visit_date = '$lastVisitDate',
        medical_history_spouse = '$medicalHistorySpouse',
        medical_history_parents='$medicalHistoryParents',
        medical_history_kids='$medicalHistoryKids',
        longitude='$longitude',
        latitude='$latitude'";
        
        $condition = "user_token ='$UserKey'";

        $result = $this->cAction->update($tableName,$value,$condition);
        if($result)
        {
        	return true;
        }
        else
        {
        	return false;
        }
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


     public function fetchProfileData($UserKey)
      {
        $tableName = "login_details";
        $select = "select * from ".$tableName." where user_token = '$UserKey'";
        $run = mysqli_query($this->con,$select);
        while($rr = mysqli_fetch_array($run))
        {
             $email = $rr['email'];
             $firstName = $rr['first_name'];
             $lastName = $rr['last_name'];
             $gender = $rr['gender'];
             $mobileNumber = $rr['mobile'];
             $age = $rr['age'];
             $address = $rr['address'];
             $bloodGroup = $rr['blood_group'];
             $height = $rr['height'];
             $weight = $rr['weight'];
             $medicalHistorySelf = $rr['medical_history_self'];
             $lastVisitDate = $rr['last_visit_date'];
             $medicalHistorySpouse = $rr['medical_history_spouse'];
             $medicalHistoryParents = $rr['parents_medical_history'];
             $medicalHistoryKids = $rr['kids_medical_history'];
             $longitude = $rr['longitude'];
             $latitude = $rr['latitude'];
    
            return $userDetails = array('email' => $email,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'gender' => $gender,
                'mobile' => $mobileNumber,
                'age' => $age,
                'address' => $address,
                'blood_group' => $bloodGroup,
                'height' => $height,
                'weight' => $weight,
                'medical_history_self' => $medicalHistorySelf,
                'last_visit_date' => $lastVisitDate,
                'medical_history_spouse' => $medicalHistorySpouse,
                'medical_history_parents' => $medicalHistoryParents,
                'medical_history_kids' => $medicalHistoryKids,
                'longitude' => $longitude,
                'latitude' => $latitude );
        }
        return false;
      }



      public function bookingApp($UserKey,$slot_id, $date)
      {
         $result = false;
         $slot = $this->fetch_slot_from_slot_id($slot_id);
         if ($slot != null) {
            //check booking slot status
            $tableName = "bookingstructure";
            $nul = null;
            $condition = "slot_no='$slot_id' AND date='$date'";
            $select = "select * from ".$tableName." where ".$condition;
            $run = mysqli_query($this->con,$select);
            $check = mysqli_num_rows($run);
            if($check==0)
            {
               $time = $slot['time'];
               $slot_id_from_db = $slot['id'];
               $value = "(date, time, slot_no, uniqueId, profile_id) value('$date','$time','$slot_id_from_db','$UserKey',1)";
               $result = $this->cAction->insert($tableName, $value);

            }
         }
         return $result;
      }

      public function fetch_slot_from_slot_id($slot_id) 
      {
         $tableName = "slots_master";
         $condition = "id = '$slot_id'";
         $select = "select * from ".$tableName. " where ".$condition;
         $result = mysqli_query($this->con, $select);
         $returnedRows = mysqli_num_rows($result);
         if ($returnedRows > 0) {
            while ($rr = mysqli_fetch_array($result)) 
            {
               $id = $rr['id'];
               $time = $rr['time'];
               $slot = array('id' => $id,
                           'time' => $time);
            }
            return $slot;
         } else {
            return null;
         }
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

      public function fetchAvailableSlotsForTheDay($date) {
         $arrayOfTheSlots = array();
         $tableName = "slots_master";
         $select = "select id, TIME_FORMAT(time, '%h %i %p') as 'time' from ".$tableName;
         $run = mysqli_query($this->con,$select);
         while ($result = mysqli_fetch_array($run)) 
         {
              $id = $result['id'];
              $time = $result['time'];
              $arrayCreatedFromLeaveCalculationIfAny = array('id' => $id,
                          'time' => $time,
                          'availability' => $this->isSlotAvailableForTheDate($date, $id)
                        );

              $finalArrayOfSlotsForDay[] = $arrayCreatedFromLeaveCalculationIfAny;

         }
        return $finalArrayOfSlotsForDay;
      }

      public function isSlotAvailableForTheDate($date, $slotId) {
          $tableName = "bookingstructure";
          $select = "select * from ".$tableName." where date = '".$date."' AND slot_no = ".$slotId;
          $run = mysqli_query($this->con,$select);
          $returnedRows = mysqli_num_rows($run);
          if ($returnedRows == 0) {
              return 1;
          }
          else {
              return 0;
          }
      }



}
?>