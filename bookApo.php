<?php
include('getActivity.php');
$fff = new getActivity;


$data = json_decode(file_get_contents("php://input"));
@$ind = $data->idd;
@$UserKey = $data->usrkey;
@$bbiId = $data->bookId;

 

$result = $fff->companyDetails($ind);
if($result==1)
{
//check user key true or not..
$result2 = $fff->checkuserTrue($UserKey);
if($result2==1)
{
//if user registerd..
//now check Booking id status------------>
$result3 = $fff->bookingApp($UserKey,$bbiId);
if($result3==1)
{
?>
{"STATUS":"SUCCESS","MESSAGE":"SLOT BOOKING SUCCESS","RESPONCE":"1","SLOTID":"<?php echo $bbiId ?>"}


<?php
}
else
{
?>
{"STATUS":"FAILED","MESSAGE":"SLOT ALREADY BOOK","RESPONCE":"2"}
<?php
}

}
else
{
?>
{"STATUS":"FAILED","MESSAGE":"USER NOT REGISTERD","RESPONCE":"2"}

<?php
}
}
else
{
	echo "Invalid User Action !!";
}

?>