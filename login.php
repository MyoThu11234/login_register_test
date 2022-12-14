<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<?php
	session_start();
		include 'db.php';
		if(isset($_POST['submit'])){
			$email = trim($_POST['email']);
			$password = md5($_POST['password']);

			$result = mysqli_query($db, "SELECT * FROM users WHERE email='$email' AND password='$password'");
			//print_r($data);
			$count = mysqli_num_rows($result);
			$user = mysqli_fetch_assoc($result);
			//echo $user['role'];
			//echo $count;
			if($count == 1){
				$_SESSION['user'] = $user;
				if($user['role'] == 'user'){
					header('location: user-dashboard.php');
				}else{
					header('location: admin.php');
				}
			 }else{
				$error = "Invalid email or password";
			}
		}
	?>
		<div class="container-fluid mt-2">
			<div class="row">
				<div class="col-md-12">
						<div class="card">
						<div class="card-header">
							<div class="card-title">
								<div class="row">
									<div class="col-6">
									<a href="index.php">
										<h6>Home</h6>
									</a>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-3"></div>
								<div class="col-6">
									<form action="" method="post">
										<div class="card">
											<div class="card-header">
												<h6>Login</h6>
											</div>
											<div class="card-body">
												<i class="text-danger"> <?php echo$error;  ?> </i>
												<input type="text" name="email" class="form-control mb-2" placeholder="Email">
												<input type="password" name="password" class="form-control mb-2" placeholder="Password">
											</div>
											<div class="card-footer">
												<button class="btn btn-primary" name="submit">Submit</button>
												<span class="float-end">If you not had account? <a href="register.php">register here</a></span>
											</div>
										</div>
									</form>	
								</div>
								
								<div class="col-3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>