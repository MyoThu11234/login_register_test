<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.close').click(function(){
				$('.edit_card').hide();
			});
		});
	</script>
	<title>Document</title>
</head>
<body>
	<?php
		//db connect
		include('db.php');

		session_start();
		if($_SESSION['user']['role'] == 'admin'){
			header('location:admin.php');
		}

		// user database data
		$id = $_SESSION['user']['id'];
		$result = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
		if($result){
			$user_db = mysqli_fetch_array($result);
			//print_r($user_db);
		}else{
			die("Error").mysqli_error($db);
		}

		//edit user profile
		$user_edit_form = false;
		if(isset($_GET['edit_user_id'])){
			$user_edit_form = true;
			$id = $_GET['edit_user_id'];
			
			$query = "SELECT * FROM users WHERE id = $id";
			$result = mysqli_query($db, $query);
			$user_data = mysqli_fetch_array($result);
			//print_r($user_data);
		}

		//update user
		if(isset($_POST['update'])){
			$id = $_POST['id'];			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$input_password = $_POST['password'];

			$query = "SELECT * FROM users WHERE id = $id";
			$result = mysqli_query($db, $query);
			$user_data = mysqli_fetch_array($result);
			$old_password = $user_data['password'];

			$new_password = $old_password != $input_password ? md5($input_password): $input_password ;
			//echo $newpassword;

			$query = "UPDATE users SET name = '$name', email='$email', address='$address', password='$new_password' WHERE id=$id ";
			$result = mysqli_query($db, $query);
			if($result){
				header('location:user-dashboard.php');
				echo "Succeffully";
			}else{
				echo "try";
			}
		}
	?>
	<div class="container-fluid">
		<div class="card mt-2">
			<div class="card-header">
				<div class="card-title">
					<a href="user-dashboard.php"><h5>User Dashboard
					<a href="logout.php" class="btn btn-primary float-end btn-sm" onclick="return confirm('Are you sure logout')">logout</a>
					</h5></a>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><h6>Your Info
								<a href="user-dashboard.php?edit_user_id=<?php echo $_SESSION['user']['id']  ?>" class="btn btn-sm btn-success ms-4">Edit</a>
								</h6></div>
							</div>
						<div class="card-body ms-2">
							<h6>Name: <i><?php  echo $user_db['name'] ?></i></h6>
							<h6>Email: <i><?php  echo $user_db['email'] ?></i></h6>
							<h6>Address: <i><?php  echo $user_db['address'] ?></i></h6>
						</div>
					</div>
				</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
					<?php if($user_edit_form == true): ?>
						<div class="card edit_card">
							<div class="card-header">
								<div class="card-title">Your Info Detail</div>
							</div>
							<form action="user-dashboard.php" method="post">
									<div class="card-body">
										<input type="hidden" class="mb-2" value="<?php echo $user_data[0] ?>" name="id">
										<input type="text" name="name" class="form-control mb-2" value="<?php echo $user_data['name'] ?>">
										<input type="text" name="email" class="form-control mb-2" value="<?php echo $user_data[2] ?>">
										<input type="text" name="address" class="form-control mb-2" value="<?php echo $user_data[3] ?>">
										<input type="text" name="password" class="form-control mb-2" value="<?php echo $user_data[4] ?>" >
									</div>
								<div class="card-footer">
									<input type="submit" value="Update" class="btn btn-success" name="update">
								</div>
							</form>
					<?php endif ?>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>
		
</body>
</html>