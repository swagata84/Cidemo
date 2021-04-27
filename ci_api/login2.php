<?php

$email = $_POST['email'];
$password = $_POST['password'];

$data = array(
	 'email' => $email,
	 'password' => $password
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/api/login");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

//print_r($output);

$token = json_decode($output);
//echo "token is:".$token->token;

print_r($token);

$token2 = $token->token;

$token_email = $token->user->email;



$_SESSION['token'] = $token2;
$_SESSION['email'] = $token_email;
if(!empty($token2)){
header('Location:user_details.php');

}
	

?>