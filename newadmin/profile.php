<?php include 'includes/connection.php';
session_start();
if (isset($_SESSION['role'])) {
} else {
	echo "<script>alert('you need to login first');
    window.location.href='../index';</script>";
}

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$userid = $row['id'];
		$username = $row['username'];
		$password = $row['password'];
		$useremail = $row['email'];
		$userfirstname = $row['firstname'];
		$userlastname = $row['lastname'];
	}
}
?>


<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<?php include 'includes/header.php' ?>

		<!-- Menu -->
		<?php include 'includes/menu.php' ?>

		<!-- Main -->
		<div id="main">

			<!-- Post -->
			<article class="post">

				<div class="container">
					<h2>Welcome,
						<small style="color: #1bc19a"><?php echo $_SESSION['firstname']; ?></small>
					</h2>


					<!-- <p>Please fill all fields in the form</p> -->

					<form role="form" action="profile.php" method="POST" enctype="multipart/form-data">

						<div class="form-group">
							<label for="user_title">User Name</label>
							<input type="text" name="username" class="form-control" value="<?php echo $username; ?>" readonly>
						</div>

						<div class="form-group">
							<label for="user_author">FirstName</label>
							<input type="text" name="firstname" class="form-control" value="<?php echo $userfirstname; ?>" readonly>
						</div>

						<div class="form-group">
							<label for="user_status">LastName</label>
							<input type="text" name="lastname" class="form-control" value="<?php echo $userlastname; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="user_tag">Email</label>
							<input type="email" name="email" class="form-control" value="<?php echo $useremail; ?>" readonly>
						</div>

			</article>

		</div>

	</div>
	<?php include 'includes/footer.php' ?>
</body>

</html>