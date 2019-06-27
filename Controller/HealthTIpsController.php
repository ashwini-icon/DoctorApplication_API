<?php
    include_once 'dbaction.php';
    include_once 'BaseController.php';
    class HealthTIpsController extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this->connection = mysqli_connect("localhost","root","","doctor_app");
            $this->databaseAction = new dbAction();
        }
    
        public function saveHealthTipAndSendNotification($tipTitle, $tipDescription) {
            $tableName = "health_tips";
            $value = "(tip_title,tip_description) VALUES ('$tipTitle','$tipDescription')";
            $result = $this->databaseAction->insert($tableName,$value);
            return $result;
        }
    
        public function getHealthTips() {
            $tableName = "health_tips";
            $select = "select * from ".$tableName;
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
    }