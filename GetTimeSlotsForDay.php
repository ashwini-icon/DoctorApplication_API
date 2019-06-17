<?php
include('getActivity.php');
$fff = new getActivity;

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$datt = date('h:i:s d/m/Y');
$d =  date('d-m-Y');
$ii = date('h:i:s');

$data = json_decode(file_get_contents("php://input"));
//check user id
@$ind = $data->idd;
@$inputeDate = $data->date;

//pic profile data from database
$result = $fff->companyDetails($ind);
if($result==1)
{
?>
{"STATUS":"SUCCESS","MESSAGE":"","RESPONCE":"1","DATA":
[
<?php
   //fetch all data
   $resultingSlots = $fff->fetchAvailableSlotsForTheDay($inputeDate);
    
   foreach ($resultingSlots as $key => $value) {
   	  $id = $value['id'];
   	  $time = $value['time'];
   	  $availibility = $value['availablity'];
?>
{"id":"<?php echo $id; ?>","time":"<?php echo $time; ?>","availibility":"<?php echo $availibility; ?>"},
<?php
}
?>

]}

<?php
}
else
{
echo "Invalid User Action !!";
}

?>