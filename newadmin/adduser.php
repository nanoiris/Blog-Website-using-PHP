<?php include 'includes/connection.php';
session_start();
if (isset($_SESSION['role'])) {
} else {
	echo "<script>alert('you need to login first');
    window.location.href='../index';</script>";
}
?>

<?php
if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}
if ($currentrole == 'user') {
	echo "<script> alert('Only ADMIN can add users');
window.location.href='./index.php'; </script>";
}
?>

<?php
// include('includes/connection.php');
// include('includes/adminheader.php');
//session_start();test
// get back form data of there was a registration error
$firstname = $_SESSION['adduser-data']['firstname']  ?? null;
$lastname = $_SESSION['adduser-data']['lastname']  ?? null;
$username = $_SESSION['adduser-data']['username']  ?? null;
$userrole = $_SESSION['adduser-data']['userrole']  ?? null;
$email = $_SESSION['adduser-data']['email']  ?? null;
$confirmpassword = $_SESSION['adduser-data']['confirmpassword']  ?? null;
$createpassword = $_SESSION['adduser-data']['createpassword']  ?? null;
// delete adduser data session 
unset($_SESSION['adduser-data']);
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
					<h2>Add a new user</h2>
					<?php if (isset($_SESSION['adduser'])) : ?>

						<div class="alert_message error">
							<p style="color: red">
								<?= $_SESSION['adduser'];
								unset($_SESSION['adduser']);
								?>

							</p>
						</div>
					<?php endif ?>
					<!-- <p>Please fill all fields in the form</p> -->

					<form action="adduser_logic.php" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label for="user_author">FirstName</label>
							<input type="text" name="firstname" value="<?= $firstname ?>" class="form-control">
						</div>

						<div class="form-group">
							<label for="user_status">LastName</label>
							<input type="text" name="lastname" value="<?= $lastname ?>" class="form-control">
						</div>

						<div class="form-group">
							<label for="user_title">User Name</label>
							<input type="text" name="username" value="<?= $username ?>" class="form-control">
						</div>

						<div class="input-group">
							<label for="user_role">Role</label>
							<select class="form-control" name="userrole" value="<?= $userrole ?>" id="">
								<option value="user">User</option>
								<option value="admin">Admin</option>
							</select>

						</div>

						<div class="form-group">
							<label for="user_tag">Email</label>
							<input type="email" name="email" value="<?= $email ?>" class="form-control">
						</div>
						<div class="form-group">
							<label for="user_tag">Password</label>
							<input type="password" name="createpassword" value="<?= $createpassword ?>" class="form-control">
						</div>
						<div class="form-group">
							<label for="user_tag">Confirm Password</label>
							<input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" class="form-control">
						</div>


						<button type="submit" name="submit" class="btn btn-primary" value="Add User">Add User</button>

					</form>

			</article>

		</div>

	</div>
	<?php include 'includes/footer.php' ?>
</body>

</html>