<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>Login page</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  
   <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" class="form-control" id="email">
  </div>
   <div class="form-group">
    <label for="email">Password:</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>

  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
</div>
</body>
</html>



<?php

if(isset($_POST['submit'])){



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

//$token = json_decode($output);
//echo "token is:".$token->token;



//$token = "";

$token = json_decode($output);

if(isset($token->token)){

$token2 = $token->token;

$token_email = $token->user->email;



$_SESSION['token'] = $token2;
$_SESSION['email'] = $token_email;
if(!empty($token2)){
header('Location:user_details.php');

}
}else{
	
	print_r($output);
}


	}

?>