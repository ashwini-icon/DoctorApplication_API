<?php
    include('getActivity.php');
    $fff = new getActivity;
    
    $data = json_decode(file_get_contents("php://input"));
    
    @$ind = $data->idd;
    @$UserKey = $data->token;
    
    
    $result = $fff->companyDetails($ind);
    if($result==1)
    {
        
        $result2 = $fff->checkuserTrue($UserKey);
        if($result2==1)
        {
            $profileData = $fff->fetchProfileData($UserKey);
            $finalResponse = "{\"STATUS\":\"SUCCESS\", \"MESSAGE\":\"PROFILE DATA FETCHED\", \"RESPONCE\":1, \"DATA\": ".json_encode($profileData)." }";
            echo $finalResponse;
        }
    }
    else
    {
        $finalResponse = "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID_TOKEN\",\"RESPONCE\":2}";
        echo $finalResponse;
    }
    