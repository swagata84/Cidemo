<?php
session_start();
if(!empty($_SESSION['token'])){
	
	$logged_user_token = $_SESSION['token'];
	
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone_no'];

$id = $_POST['user_id'];

$data = array(
     'name' => $name,
	 'email' => $email,
	 'phone_no' => $phone,
	 'id' => $id
);

$ch = curl_init();

$headers = array(
   // "Content-Type: application/json; charset=utf-8",
    "Authorization:".$logged_user_token
);

curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/api/userupdate2");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

print_r($output);

}

?>