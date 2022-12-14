<?php

	$db = new mysqli('localhost','root','','test');

	$delete = mysqli_query($db, "TRUNCATE TABLE users");


?>