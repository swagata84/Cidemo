<?php session_start();?>
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

<script>

function useredit(id){
		
		//$id = $(this).val();
		
	$.ajax({
		 url:"http://localhost:8080/api/fetch",
		 method:"get",
		 data:{id:id},
		success:function(data){
			
			console.log(data);
			
			$.each(data,function(){
				
				//console.log(data['user']['name']);
				
				$("#name").val(data['user']['name']);
			$("#email").val(data['user']['email']);
			$("#phone_no").val(data['user']['phone_no']);
			
			$("#user_id").val(data['user']['id']);
				
			});
			
			
			
			
			
		},
		error:function(error){
			
		}
	});			
		
}




function userdelete(id){
		
		//$id = $(this).val();
		if(confirm("Do you want to delete?")){
	$.ajax({
		 url:"http://localhost:8080/api/user_delete",
		 method:"get",
		 data:{id:id},
		success:function(data){
			
			console.log(data);
			
			location.reload();
			
			
			
			
			
		},
		error:function(error){
			
		}
	});			
		}	
}




function logout(){
	
	if(confirm("Do you want to logout?")){
		
		$.ajax({
			
			url:"logout.php",
			method:"get",
			success:function(data){
				
				location.href="index.php";
			}
			
		});
	}
}

</script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="update.php" method="post">
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" name="name" class="form-control" id="name">
  </div>
   <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  
  <input type="hidden" name="user_id" id="user_id">
  
  
  <div class="form-group">
    <label for="pwd">Phone no:</label>
    <input type="number" name="phone_no" class="form-control" id="phone_no">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
     
    </div>
  </div>
</div>






<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="add_user.php" method="post">
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" name="name" class="form-control" id="name">
  </div>
   <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Phone no:</label>
    <input type="number" name="phone_no" class="form-control" id="phone_no">
  </div>
  
    <div class="form-group">
    <label for="email">Password:</label>
    <input type="password" class="form-control" name="password" id="password" required>
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
     
    </div>
  </div>
</div>

<?php


if(!empty($_SESSION['token']) && !empty($_SESSION['email'])){
	
	$logged_user_token = $_SESSION['token'];
	$logged_user_email = $_SESSION['email'];
	
	$ch = curl_init();
	
	$headers = array(
    "Content-Type: application/json; charset=utf-8",
    "Authorization:".$logged_user_token
);

$data = array('token' => $logged_user_token,'token_email'=>$logged_user_email);
	
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/api/user_details");
//curl_setopt($ch, CURLOPT_USERPWD, $email . ":" . $password); 

//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

$gh = json_decode($output);


//print_r($gh);
$value = $gh->data;
/*
foreach($value as $item){
	
	//print_r($item);
	
	echo $item->name;
	
}
*/
//print_r($output);

//echo $gh->data->data->name;


//echo $gh['name'];
//$value = $gh->data;

//print_r($value);



//print_r(get_object_vars($value));
	
	?>
	
	<div class="container">
  <h2>User Details</h2>    

<button class="btn btn-danger" style="float:right;" onclick="logout();">Logout</button>
<button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#exampleModal2">Add User</button>   
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone No</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($value as $item){ ?>
	<tr>
	<td><?php echo $item->name;?></td>
	<td><?php echo $item->email;?></td>
	<td><?php echo $item->phone_no;?></td>
	<td><button type="button" id="edit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal" value="<?php echo $item->id;?>" onclick="useredit('<?php echo $item->id;?>');">Edit</button>  <button type="button" id="delete" class="btn btn-danger btn-sm" onclick="userdelete('<?php echo $item->id;?>');">Delete</button></td>
	</tr>
	
	<?php }?>
    </tbody>
  </table>
</div>
	<?php
	
}else{
	
$logged_user_token = '';
}

?>

<div id="hello"></div>
</body>
</html>