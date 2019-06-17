<?php

include('connect.php');
        

$dd = "DELETE FROM bookingstructure WHERE id between 754 AND 873";
$run = mysqli_query($con,$dd);
?>