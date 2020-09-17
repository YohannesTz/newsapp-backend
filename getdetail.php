<?php 

require "db.php";
if($_SERVER['REQUEST_METHOD']=="GET")
{
  if(isset($_GET['id']))
  {
    $id =  $_GET['id'];
    get_news_detail($id);
  }else{
    echo "there is no id provided!";
  }
}

function get_news_detail($id)
{
	$conn = OpenCon();
	$result = array();
	$get_data = mysqli_query($conn,"SELECT * FROM `newsdetail` WHERE id = {$id} ");
	if(mysqli_num_rows($get_data) > 0){
        while ( $row = $get_data->fetch_assoc())  {
	        $dbdata =$row;
        }

        echo json_encode($dbdata);

    }else{
        echo "Record not found. Please try again";
    }
}

?>