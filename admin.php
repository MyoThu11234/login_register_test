<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
	<!-- JQuery  -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- sweetalert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>		
		$(document).ready(function(){
			$(".close").click(function(){
				$(".card-x").hide();
			});
		});
	</script>
</head>
<body>
	<?php
		include 'db.php';
		session_start();

		// Auth
		if(!isset($_SESSION['user']['name'])){
		header('location:login.php');
		}
		if($_SESSION['user']['role'] == 'user'){
			header('location:user-dashboard.php');
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

		// edit code
		$user_edit_form = false;
		if(isset($_GET['edit_data'])){
			$user_edit_form = true;
			$id = $_GET['edit_data'];
		
			$query = "SELECT * FROM users WHERE id =$id ";
			$result = mysqli_query($db,$query);
			$result_arr = mysqli_fetch_assoc($result); // change array
		}

		//update
		if(isset($_POST['update'])){
			$id = $_POST['id'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$role = $_POST['role'];

			$query = "UPDATE users SET name = '$name', email='$email', address='$address', role='$role' WHERE id=$id ";
			$result = mysqli_query($db,$query);
			if($result){				
				//header('location:admin.php');
				echo '<script>swal("Good job!", "Update Successfully!", "success");
					</script>';
			}else{
				echo "What the fuck";
			}
			
		}

		//Delete
		if(isset($_GET['delete_id'])){
			$id = $_GET['delete_id'];		
			$query = "DELETE FROM users WHERE id=$id";
			if($query){
				$result = mysqli_query($db, $query);
				if($result){
					header('location:admin.php');
				}
				if($result){
					echo "gg";
				}
				echo '<script>swal("Delete Successfully!");
				</script>';
			}else{
				echo "Try Again";
			}
		}


	?>
	<div class="container-fluid mt-2">
		<div class="row">
					<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="row">
								<div class="col-6">
								<a href="admin.php">
									<h6>Admin Dashboard</h6>
								</a>
								</div>
								<div class="col-6">
								<a href="logout.php" class="btn btn-danger btn-sm float-end" name="logout" onclick="return confirm('Are you sure logout')">Logout</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-2">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><h5 class="text-info">Profile</h5></div>
									</div>
									<div class="card-body">
									<h6>Admin: <br> <i class="text-primary"><?php echo $user_db['name'] ?></i></h6>
									<h6>G-mail: <i class="text-primary"><?php echo $user_db['email'] ?></i></h6>
									</div>
								</div>								
							</div>
							<div class="col-6">								
								<table class="table table-border table-hover">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Address</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
								<?php 
									$data = mysqli_query($db, "SELECT * FROM users");
									foreach($data as $value) { ?>
								<tr>
									<td><?php echo $value['id'] ?></td>
									<td><?php echo $value['name'] ?></td>
									<td><?php echo $value['email'] ?></td>
									<td><?php echo $value['address'] ?></td>
									<td><?php echo $value['role'] ?></td>
									<td class="edit"><a href="admin.php?edit_data=<?php echo $value['id'] ?>" class="btn btn-primary btn-sm ">Edit</a>
									<a href="admin.php?delete_id=<?php echo $value['id'] ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Are you sure')">Delete</a>
									</td>
								</tr>
									<?php } ?>
								</table>
							</div>
							<?php if($user_edit_form == true): ?>
							<div class="col-4 card-x">
								<form action="admin.php" method="post">
									<div class="card mt-4 ">
										<div class="card-header">
											<div class="card-title">Update</div>
										</div>
										<div class="card-body">
											<div class="form-group">
												<input type="hidden" name="id" value="<?php echo $result_arr['id'] ?>">
												<label for="">Name</label>
												<input type="text" value="<?php echo $result_arr['name'] ?>" class="form-control" name="name">
											</div>
											<div class="form-group">
												<label for="">Email</label>
												<input type="text" value="<?php echo $result_arr['email'] ?>" class="form-control" name="email">
											</div>
											<div class="form-group">
												<label for="">Address</label>
												<input type="text" value="<?php echo $result_arr['address'] ?>" class="form-control" name="address">
											</div>
											<div class="form-group">
												<label for="">Role</label>
												<select name="role" class="form-control" >
													<option value="admin" <?php if($result_arr['role'] == "admin" ): ?> selected <?php endif?> >Admin</option>
													<option value="user" <?php if($result_arr['role'] == "user" ): ?> selected <?php endif?> >User</option>
												</select>
											</div>
										</div>
										<div class="card-footer">
											<!-- <a href="admin.php?update=<?php echo $result_arr['id'] ?>" class="btn btn-primary">Update</a> -->
											<button class="btn btn-primary" name="update">Update</button>
										</div>
									</div>
								</form>
							</div>
							<?php endif ?>
						</div>
					</div>
				</div>				
		</div>
	</div>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="edit.js"></script>
</body>
</html>