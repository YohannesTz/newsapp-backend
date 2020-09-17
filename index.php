<?php 
require "api.php";
header('content-type: application/json');

if($_SERVER['REQUEST_METHOD']=="GET")
{
  if(isset($_GET['id']))
  {
    $id =  $_GET['id'];
    get_news($id);
  }
  else{
    get_random_data();
  }
}


if($_SERVER['REQUEST_METHOD'] == "POST")
{
/*    foreach ($_POST as $key => $value){
        echo $key ." -> ". $value ."\n";
    }*/

	if($_POST['type'] == "user"){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$fname = $_POST['fname'];
		$phonenum = $_POST['phonenum'];
		$bio = $_POST['bio'];
		$avatar_link = $_POST['avatar_link'];

		add_user($username, $password, $name, $fname, $phonenum, $bio, $avatar_link);
	}else if($_POST['type'] == "news"){
		$newstitle = $_POST['newstitle'];
		$newsdetail = $_POST['newsdetail'];
		$uploader = $_POST['uploader'];

		add_news($newstitle, $newsdetail, $uploader);
	}else if ($_POST['type'] == "login") {
		$username = $_POST['username'];
		$password = $_POST['password'];

		auth_login($username, $password);

	}else if($_POST['type'] == "up_user"){
		$username = $_POST['username'];
/*		$name = $_POST['name'];
		$fname = $_POST['fname'];
		$phonenum = $_POST['phonenum'];
		$bio = $_POST['bio'];
		$avatar_link = $_POST['avatar_link'];*/

		echo password_hash($username, PASSWORD_BCRYPT);

		//update_user($username, $name,  $fname, $phonenum, $bio, $avatar_link);

	}else {
		echo "unknown operation!";
	}
}


