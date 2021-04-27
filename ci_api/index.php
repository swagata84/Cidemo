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
<h1>Registration page</h1>
<form action="registration.php" method="post">
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" name="name" class="form-control" id="name">
  </div>
   <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Phone no:</label>
    <input type="number" name="phone_no" class="form-control" id="phone_no">
  </div>
   <div class="form-group">
    <label for="email">Password:</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
<br>
If already registered <a href="login.php">Login</a>
</div>
</body>
</html>