	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- JQuery  -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".close").click(function(){
				$(".card").hide();
			});
			$(".show").click(function(){
				$(".card").show();
			});
		});
	</script>
	<style>
		.card{
			display: none;
		}
	</style>
	</head>
	<style>
		a{
			text-decoration: none;
		}
	</style>
	<body>
		<div class="container mt-3">
			<button class="btn btn-primary show">Show</button>
			<div class="card mt-4">
				<div class="card-header">
					<div class="card-title">Post
					<i class="float-end close"><a href="">X</a></i>
					</div>
					
				</div>
				<div class="card-body">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, rem adipisci sunt vero, molestiae autem enim perspiciatis ratione magnam facilis, beatae et sed! Sunt, earum facilis laudantium ipsam veniam cum?</p>
				</div>
				<div class="card-footer">
					<button class="btn btn-success">Ok</button>
				</div>
			</div>
		</div>
	</body>
	</html>
	