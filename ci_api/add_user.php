<?php

session_start();

if(!empty($_SESSION['token'])){
$logged_user_token = $_SESSION['token'];
 $logged_user_email = $_SESSION['email'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone_no'];
$password = $_POST['password'];

$data = array(
     'name' => $name,
	 'email' => $email,
	 'phone_no' => $phone,
	 'password' => $password,
	 'token' => $logged_user_token,
	 'token_email' => $logged_user_email
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/api/add_user");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

print_r($output);

}

?>