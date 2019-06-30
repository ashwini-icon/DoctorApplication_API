<?php
    
    $conn = mysqli_connect("35.200.158.161","root","123456","doctor_app");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn);
    }
    echo "Connected successfully";
