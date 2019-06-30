<?php
    include('getActivity.php');
    $fff = new getActivity;
    
    @$data = json_decode(file_get_contents("php://input"));
    @$email = $data->email;
    @$pass = $data->pass;
    @$ind = $data->idd;
    
    @$rand = md5("$email");
    
    $result = $fff->companyDetails($ind);
    if($result==1)
    {
        $result = $fff->checkUserStatus($email);
        if($result==1)
        {
            $result = $fff->register($email,$pass,$rand);
            if($result==1)
            {
                echo "{\"STATUS\":\"SUCCESS\",\"MESSAGE\":\"REGISTER SUCCESS\",\"RESPONCE\":\"1\"}";
            }
        }
        else
        {
            echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"USER WITH SAME EMAIL ALREADY EXISTS\",\"RESPONCE\":\"2\"}";
        }
    }
    else
    {
        echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"COMPANY IDENTIFICATION FAILED\",\"RESPONCE\":\"2\"}";
    }