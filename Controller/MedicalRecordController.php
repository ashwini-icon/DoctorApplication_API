<?php
    include_once 'dbaction.php';
    class MedicalRecordController
    {
        
        public function __construct()
        {
            $this->connection = mysqli_connect("localhost","root","","doctor_app");
            $this->databaseAction = new dbAction();
        }
        
        public function saveMedicalRecord($nameOfMedicine, $type, $quantity, $unit, $repeatingDays, $repeatingTime, $patient_id) {
           $tableName = "medical_record";
           $value = "(name_of_medicine,type,quantity,unit,repeating_days,repeating_time, patient_id) VALUES ('$nameOfMedicine','$type','$quantity','$unit','$repeatingDays', '$repeatingTime', $patient_id)";
           $result = $this->databaseAction->insert($tableName,$value);
           return $result;
        }
        
        public function getMedicalRecord($id) {
            $tableName = "medical_record";
            $condition = "patient_id = '$id'";
            $select = "select * from ".$tableName." where ".$condition;
            $run = mysqli_query($this->connection,$select);
            $check = mysqli_num_rows($run);
            if($check >= 0)
            {
                $returnString = "[";
                $index = 0;
                while($rr = mysqli_fetch_array($run,MYSQLI_ASSOC)) {
                    if ($index != 0){
                        $returnString .= ", ";
                    }
                    $returnString .= json_encode($rr);
                    $index++;
                    if ($index == $check){
                        $returnString .= "]";
                    }
                }
                return $returnString;
            }
            else
            {
                return false;
            }
        }
    
        public function getUserFromToken($UserKey)
        {
            $tableName = "login_details";
            $condition = "user_token='$UserKey'";
            $select = "select * from ".$tableName." where ".$condition;
            $run = mysqli_query($this->connection,$select);
            $check = mysqli_num_rows($run);
            if($check==1)
            {
                while($rr = mysqli_fetch_array($run))
                {
                    return $userDetails =
                        array('id' => $rr['id'],
                            'email' => $rr['email'],
                            'first_name' => $rr['first_name'],
                            'last_name' => $rr['last_name'],
                            'gender' => $rr['gender'],
                            'mobile' => $rr['mobile'],
                            'age' => $rr['age'],
                            'address' => $rr['address'],
                            'blood_group' => $rr['blood_group'],
                            'height' => $rr['height'],
                            'weight' => $rr['weight'],
                            'medical_history_self' => $rr['medical_history_self'],
                            'last_visit_date' => $rr['last_visit_date'],
                            'medical_history_spouse' => $rr['medical_history_spouse'],
                            'medical_history_parents' => $rr['parents_medical_history'],
                            'medical_history_kids' => $rr['kids_medical_history'],
                            'longitude' => $rr['longitude'],
                            'latitude' => $rr['latitude'] );
            
                }
            }
            else
            {
                return false;
            }
        }
    }