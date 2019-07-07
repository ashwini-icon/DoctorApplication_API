<?php
    include_once 'dbaction.php';
    class BaseController
    {
        public function __construct()
        {
            $servername = "mysql:unix_socket=/cloudsql/doctor-mobile-application:asia-south1:doctor-app;dbname=doctor_app";
            $username = "root";
            $dbname = "doctor_app";
            $password = "123456";
            try
            {
                $this->connection = new PDO($servername, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(PDOException $e) {
                die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
                echo("Can't open the database.". $e);
            }
            $this->databaseAction = new dbAction();
        }
    
        public function getUserFromToken($UserKey)
        {
            $tableName = "login_details";
            $condition = "user_token='$UserKey'";
            $select = "select * from ".$tableName." where ".$condition;
            $run = $this->connection->query($select);
            $check = $run->rowCount();
            if($check==1)
            {
                while($rr = $run->fetch())
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