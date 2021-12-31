<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$response = array("error"=>FALSE);

if(isset($_POST['email']) && isset($_POST['password'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$user = $db->getUserByEmailAndPassword($email,$password);
	if($user!=false){
		$response["error"] = FALSE;
		$response["uid"] = $user["unique_id"];
		$response["user"]["name"] = $user["name"];
		$response["user"]["email"] = $user["email"];
		$response["user"]["created_at"] = $user["created_at"];
		$response["user"]["updated_at"] = $user["updated_at"];
		echo json_encode($response);
	} else{
		$response["error"] = TRUE;
		$response["error_msg"] = "Login credentials are wrong. Please try again";
		echo json_encode($response);
	}
} else{
	$response["error"] = TRUE;
	$response["error_msg"] = "Required parameters email or password is missing!";
	echo json_encode($response);
}
?>