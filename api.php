<?php 

require "db.php";

function get_random_data(){
    $conn = OpenCon();
	$result = array();
	$get_data = mysqli_query($conn,"SELECT * FROM `news` ORDER BY RAND() LIMIT 3");
	if(mysqli_num_rows($get_data) > 0){
        while ( $row = $get_data->fetch_assoc())  {
	        $dbdata[]=$row;
        }

        echo json_encode($dbdata);

    }else{
        echo "<h3>No records found. Please insert some records</h3>";
    }
}

function get_news($id){
    $conn = OpenCon();
	$result = array();
	$get_data = mysqli_query($conn,"SELECT * FROM `news` where id = {$id} ");
	if(mysqli_num_rows($get_data) > 0){
        while ( $row = $get_data->fetch_assoc())  {
	        $dbdata =$row;
        }

        echo json_encode($dbdata);

    }else{
        echo "<h3>Record not found. Please try again</h3>";
    }
}

function add_news($newstitle, $newsdetail, $uploader) {
    $conn = OpenCon();
	$insert_news = mysqli_query($conn, "INSERT INTO `news` (`id`, `newstitle`, `newsdetail`, `uploader`) VALUES (NULL, '{$newstitle}', '{$newsdetail}', '{$uploader}')");
    if($insert_news){
        echo "Sucessflully Added the news to the database";
    }else{
        echo "Ooops! the news is not added to the databsase";
        echo ("Error description: " . mysqli_error($conn));
    }
}

function add_user($username, $password, $name, $fname, $phonenum, $bio, $avatar_link){
    $conn = OpenCon();
    $insert_user = mysqli_query($conn, "INSERT INTO `users` (`username`, `password`, `name`, `fname`, `phonenum`, `bio`, `avatar_link`) VALUES ('{$username}', '{$password}', '{$name}', '{$fname}', '{$phonenum}', '{$bio}', '{$avatar_link}')");
    if($insert_user){
        echo json_encode("Sucessflully added the user the the database");
    }else {
        echo "Ooops! someting is worng adding user!";
        echo ("Error description: " . mysqli_error($conn));
    }
    
}

function update_user($username, $name,  $fname, $phonenum, $bio, $avatar_link) {
    $conn = OpenCon();
    $update_user = mysqli_query($conn, "UPDATE `users` SET `name`={$name},`fname`={$fname},`phonenum`={$phonenum},`bio`={$bio},`avatar_link`={$avatar_link} WHERE username = {$username}");

    if($update_user){
        echo json_encode("Sucessflully updated the user");
    }else {
        echo "UPDATE `users` SET `name`={$name},`fname`={$fname},`phonenum`={$phonenum},`bio`={$bio},`avatar_link`={$bio} WHERE username = {$username}";
        echo json_encode("Ooops! Something is wrong updating the user");
    }
}

function auth_login($username, $password){
    $conn = OpenCon();
    $auth_login = mysqli_query($conn, "SELECT * FROM `users` WHERE username='{$username}' AND password='{$password}'");

    if(mysqli_num_rows($auth_login) == 1){
        while ($row = $auth_login->fetch_assoc())  {
            $dbdata =$row;
        }
        echo json_encode($dbdata);
    }else{
        echo json_encode("Wrong Credentials!... please try again... ");
    }
}

/*function delete_news($username) {
    $conn = OpenCon();
    $delte_news = mysql_query($conn, "")
}*/

?>