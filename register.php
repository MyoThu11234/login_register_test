<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
	<!-- sweetalert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<?php
		
		include 'db.php';
		$nameErr = ""; $emailErr = ""; $addressErr = ""; $passwordErr = ""; $confirm_passwordErr = "";
		// $name = $email = $address = $password = $confirm_password = "";
		if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$password = md5($_POST['password']);
		$confirm_password = md5($_POST['confirm_password']);

		if(empty($name)){
			$nameErr = "Name field is required";
		}
		if(empty($email)){
			$emailErr = "Email field is required";
		}
		if(empty($address)){
			$addressErr = "Address field is required";
		}
		if(empty($password)){
			$passwordErr = "Password field is required";
		}
		if(empty($confirm_password)){
			$confirm_passwordErr = "Confirm password field is required";
		}

		if($password === $confirm_password){
			if(!empty($name) && !empty($email) && !empty($address) && !empty($password) && !empty($confirm_password) ){
				$data = "INSERT INTO users(name,email,address,password) VALUES('$name', '$email', '$address', '$password')"; 
				$ouput = mysqli_query($db,$data);
			}else{
				echo '<script>swal("Alert!", "need input value!", "error");
				</script>';	
				}
			
		}else{
			echo '<script>swal("!", "Worng Password!", "error");
			</script>';		
		}

		//echo $name,$email,$address,$password;
		
		if($ouput){
			echo '<script>swal("Good job!", "Register Successfully!", "success");
			</script>';		
		}		
		else{
			// echo '<script>swal("Error!", "Try Again!", "error");
			// </script>';
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
									<form action="register.php" method="post">
										<div class="card">
											<div class="card-header">
												<h6>Register</h6>
											</div>
											<div class="card-body">

												<i class="text-danger"><?php echo $nameErr ?></i>
												<input type="text" name="name" class="form-control mb-2 <?php if(empty(!$nameErr)){ ?> is-invalid <?php } ?>" placeholder="Name">

												<i class="text-danger"><?php echo $emailErr ?></i>
												<input type="text" name="email" class="form-control mb-2 <?php if(empty(!$emailErr)){ ?> is-invalid <?php } ?>" placeholder="Email" minlength="5">

												<i class="text-danger"><?php echo $addressErr ?></i>
												<textarea name="address" id="" cols="30" rows="2" class="form-control mb-2 <?php if(empty(!$addressErr)){ ?> is-invalid <?php } ?>" placeholder="Address"></textarea>

												<i class="text-danger"><?php echo $passwordErr ?></i>
												<input type="password" name="password" class="form-control mb-2 <?php if(empty(!$passwordErr)){ ?> is-invalid <?php } ?>" placeholder="Password">
												
												<i class="text-danger"><?php echo $confirm_passwordErr ?></i>
												<input type="password" name="confirm_password" class="form-control mb-2 <?php if(!empty($confirm_passwordErr)){ ?> is-invalid <?php } ?>" placeholder="Confirm Password">
											</div>
											<div class="card-footer">
												<button class="btn btn-primary" name="submit">Submit</button>
												<span class="float-end">If you already account? <a href="login.php">login here</a></span>
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