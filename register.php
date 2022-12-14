<?php include 'includes/connection.php';?>

<?php
$error = false;
$username_error = $firstname_error = $lastname_error = $email_error = $password_error = "";

$passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $username)) {
        $error = true;
        $username_error = "User name must only contain alphabets, numbers and space";
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
        $error = true;
        $firstname_error = "First name must contain only alphabets and space";
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
        $error = true;
        $lastname_error = "Last name must contain only alphabets and space";
    }

    if (!preg_match("/^[a-zA-Z\d]+@[a-zA-Z\d]+\.[a-zA-Z\d\.]{2,}+$/", $email)) {
        $error = true;
        $email_error = "Please Enter a correct format of email";
    }

    if (!preg_match($passwordPattern, $password)) {
        $error = true;
        $password_error = "The password should be at least 6 chars and include exactly one special character, one uppercase letter and one digit";
    }

    if (($password) !== ($cpassword)) {
        $error = true;
        $cpassword_error = "Password and Confirm password should match!";
    }

    if (!$error) {

        if (mysqli_query($conn, "INSERT INTO users(username,firstname,lastname,email,password,role) VALUES('" . $username . "','" . $firstname . "','" . $lastname . "', '" . $email . "',  '" . md5($password) . "','" . $role . "')")) {
            header("location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<?php include 'includes/header.php'?>

		<!-- Menu -->
		<?php include 'includes/menu.php'?>

		<!-- Main -->
		<div id="main">

		<!-- Post -->
		<article class="post">

		<div class="container">
			<h2>Registration</h2>
			<p>Please fill all fields in the form</p>
			<form action="" method="post">

				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?php if (isset($_POST['register'])) {echo $_POST['username'];}?>" required>
					<span class="text-danger"><?php if (isset($username_error)) {echo $username_error;}?></span>
				</div>

				<div class="form-group">
					<label>Firstname</label>
					<input type="text" name="firstname" class="form-control" value="<?php if (isset($_POST['register'])) {echo $_POST['firstname'];}?>"  required>
					<span class="text-danger"><?php if (isset($firstname_error)) {echo $firstname_error;}?></span>
				</div>

				<div class="form-group">
					<label>Lastname</label>
					<input type="text" name="lastname" class="form-control" value="<?php if (isset($_POST['register'])) {echo $_POST['lastname'];}?>"  required>
					<span class="text-danger"><?php if (isset($lastname_error)) {echo $lastname_error;}?></span>
				</div>


				<div class="form-group ">
					<label>Email</label>
					<input type="email" name="email" class="form-control" value="<?php if (isset($_POST['register'])) {echo $_POST['email'];}?>"  required>
					<span class="text-danger"><?php if (isset($email_error)) {echo $email_error;}?></span>
				</div>


				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" value="<?php if (isset($_POST['register'])) {echo $_POST['password'];}?>"  required>
					<span class="text-danger"><?php if (isset($password_error)) {echo $password_error;}?></span>
				</div>

				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" name="cpassword" class="form-control" value="<?php if (isset($_POST['register'])) {echo $_POST['cpassword'];}?>"  required>
					<span class="text-danger"><?php if (isset($cpassword_error)) {echo $cpassword_error;}?></span>
				</div>

				<div class="form-group">
					<!--<label >Role</label>-->
					<input type="hidden" name="role" class="form-control" value="user"  readonly >
				</div>
				<br>
				<input type="submit" class="btn btn-primary" name="register" value="register">

			</form>

		</article>

	</div>

	</div>
	<?php include 'includes/footer.php'?>
	</body>
</html>