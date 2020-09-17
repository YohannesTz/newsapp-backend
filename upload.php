<?php 
require "db.php";

/*	$base = $_REQUEST['image'];
	$filename = _REQUEST['filename'];
	$binary = base64_decode($base);
	header('Content-Type: bitmap; charset=utf-8');
	$file = fopen('userProfiles/'.$filename, 'wb');

	fwrite($file, $binary);
	fclose($file);
	echo json_encode('Image uploaded Sucessfully!');*/

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$UserName = $_POST['username'];
		$ImageName = $_POST['filename'];
		$ImageData = $_POST['image'];

		$ImagePath = "userProfiles/$ImageName";
		$imageUrl = "https://addisnews.000webhostapp.com/news/$ImagePath";
		file_put_contents($ImagePath, base64_decode($ImageData));

		updateUserAvatar($ImagePath, $UserName);

	}else {
		echo "unknown eror!";
	}

	function updateUserAvatar($url, $username)
	{
		$conn = OpenCon();
		$error = null;
		//$updateuserprofile = mysqli_query($connection, "UPDATE `users` SET `avatar_link` = 'https://addisnews.000webhostapp.com/news' WHERE `users`.`` = {$username};") or die($error);
	    
	    //echo error;
	    
	    $imageurl = "https://addisnews.000webhostapp.com/news/".$url;
	    
	    $sql = "UPDATE `users` SET `avatar_link` = '{$imageurl}' WHERE `username` = '{$username}'";
	    
	   if (mysqli_query($conn, $sql)) {
            senduser($username);
        } else {
            echo "Error updating record: " . mysqli_error($conn) . " ${username}";
        }
	    
	}
	
	function senduser($username)
	{
	    $conn = OpenCon();
        $auth_login = mysqli_query($conn, "SELECT * FROM `users` WHERE username='{$username}' ");
    
        if(mysqli_num_rows($auth_login) == 1){
            while ($row = $auth_login->fetch_assoc())  {
                $dbdata =$row;
            }
            echo json_encode($dbdata);
        }else{
            echo json_encode("User Not found");
        }
	}

?>      