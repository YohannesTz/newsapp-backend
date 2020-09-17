<?php 
require "db.php";
header('content-type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST"){

	if (isset($_POST['newstitle']) && isset($_POST['newsuploader']) && isset($_POST['newsdetail'])) {
		$newstitle = $_POST['newstitle'];
		$newsuploader = $_POST['newsuploader'];
		$newsdetail = $_POST['newsdetail'];
		$imagelink = $_POST['imagelink'];


		add_news($newstitle, $newsuploader, $newsdetail, $imagelink);
	}

}

function add_news($newstitle, $newsuploader, $newsdetail, $imagelink)
{

	$conn = OpenCon();
	$header = mb_strimwidth($newsdetail, 0, 30, '...');
	$date = date('Y/m/d H:i:s');
	$sql = "INSERT INTO `news` (`id`, `uploader`, `newsHeader`, `newsContent`, `detailImage`, `date`, `view`) VALUES (NULL, '{$newsuploader}', '{$newsdetail}', '{$header}', '{$imagelink}', '{$date}', '0');
	 INSERT INTO `newsdetail` (`id`, `newstitle`, `newsdetail`, `image`) VALUES (NULL, '{$newstitle}', '{$newsdetail}', '{$imagelink}');";
	$insert_news = mysqli_query($conn, $sql);

	if($insert_news){
		echo "Sucess";
	}else{
		echo mysqli_error($conn);
	}
	
}

?>