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
//$UserKey = $data->usrkey;

//pic profile data from database
$result = $fff->companyDetails($ind);
if($result==1)
{
?>
[
<?php
   //fetch all data
   $result2 = $fff->fetchslot($ind);
    
   foreach ($result2 as $key => $value) {
   	  $id = $value['id'];
   	  $date = $value['date'];
   	  $time = $value['time'];
   	  $slotNo = $value['slotNo'];
   	  $status = $value['status'];
   	  $remark = $value['remark'];
?>
{"ID":"<?php echo $id; ?>","DATE":"<?php echo $date; ?>","TIME":"<?php echo $time; ?>","SLOTNO":"<?php echo $slotNo; ?>","STATUS":"<?php echo $status; ?>","REMARK":"<?php echo $remark; ?>"},
<?php
}
?>

]

<?php
}
else
{
echo "Invalid User Action !!";
}

?>