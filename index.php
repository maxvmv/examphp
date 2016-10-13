<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exam php</title>
	<script type="text/javascript" src="js/custom.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="css/style.css">
	


</head>
<body >
	<div class="container">
		<div class="row">
			<header>
				
			</header>
		</div>
		<div class="row">
			<nav>
				<?php
				 include_once('pages/menu.php');
				 include_once('pages/classes.php');
				?>
			</nav> 
		</div>
		<div class="row">
			<section class = 'redstyle'>
				<?php 
						include_once('pages/upload.php');
				 ?>
			</section>
			<section class = 'greenstyle'>
				<?php 
						include_once('pages/show.php');
				 ?>
			</section>

			<section>

			</section>
		</div>
	</div>
</body>
</html>
<!--
	
-->