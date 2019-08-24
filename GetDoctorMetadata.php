<?php
    include('Controller/DoctorMetadataController.php');
    include('getActivity.php');
    $doctorMetadataControllerInstance = new DoctorMetadataController;
    $activityControllerInstance = new getActivity;
    $data = json_decode(file_get_contents("php://input"));
    
    $idd = $data->idd;
    
    $result = $activityControllerInstance->companyDetails($idd);
    if ($result == 1) {
        $validUserData = $doctorMetadataControllerInstance->getMetadata();
        if ($validUserData != null){
            if ($validUserData) {
                echo "{\"STATUS\":\"SUCCESS\",\"MESSAGE\":\"SUCCESS\",\"RESPONCE\":1, \"DATA\":".$validUserData."}";
            }
            else{
                echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"ERROR IN INSERTING\",\"RESPONCE\":2}";
            }
        }
        else{
            echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID USER TOKEN\",\"RESPONCE\":2}";
        }
    }
    else{
        echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID API KEY\",\"RESPONCE\":2}";
    }
