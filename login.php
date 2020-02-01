<?php
    include('getActivity.php');
    $fff = new getActivity;
    
    $data = json_decode(file_get_contents("php://input"));
    
    $userId = $data->email;
    $passWord = $data->password;
    $ind = $data->idd;
    $did = $data->did;
    
    echo "Data : ";
    echo "Email : ";
   echo $data->email;
   echo "Password : ";
   echo $data->password;
   echo "iddd : ";
   echo $data->idd;
   echo "DID : ";
   echo $data->did;
    $result = $fff->companyDetails($ind);
    if($result==1)
    {
        $status = $fff->login($userId,$passWord,$did);
        $result2 = $status['status'];
        $em3 = $status['user_token'];
        if($result2==1)
        {
            
            echo "{\"STATUS\":\"SUCCESS\",\"MESSAGE\":\"REGISTERED USER\",\"RESPONCE\":\"1\",\"TOKEN\":\"".$em3."\"}";
            
        }
        else
        {
            
            echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"NOT REGISTERED USER\",\"RESPONCE\":\"2\",\"TOKEN\":\"NULL\"}";
            
        }
    }
    else
    {
        echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"API KEY IS NOT VALID\",\"RESPONCE\":\"2\"}";
    }
