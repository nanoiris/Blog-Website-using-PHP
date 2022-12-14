<?php include 'includes/connection.php';
session_start();
if (isset($_SESSION['role'])) {
} else {
	echo "<script>alert('you need to login first');
    window.location.href='../index';</script>";
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
					<h2>Add a new user</h2>

					<!-- <p>Please fill all fields in the form</p> -->

					<div class="row"><?php
										$query = "SELECT * FROM posts";
										$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
										$post_num = mysqli_num_rows($result);
										echo "<div class='text-right huge'>{$post_num}</div>";
										?>&nbspPosts
					</div>

					<div>
						<a href="posts.php"><span class="pull-left">View All Posts</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						</a>
					</div>
					<br>
					<div class="row"><?php
										$query = "SELECT * FROM users";
										$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
										$user_num = mysqli_num_rows($result);
										echo "<div class='text-right huge'>{$user_num}</div>";
										?>&nbspUsers

					</div>
					<div>Users</div>
					<div>
						<a href="users.php"><span class="pull-left">View All Users</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						</a>
					</div>
					<br>

					<div>
						"<span id="quoteBody" style="color: #1bc19a"></span>"<br>
						— <span id="quoteAuthor" style="color: #1bc19a"></sp>
					</div>

					<script src="js/jquery.js"></script>
					<script src="js/bootstrap.min.js"></script>
					<script>
						function get_quote_of_the_day() {
							var xhttp = new XMLHttpRequest();
							xhttp.open("GET", "https://favqs.com/api/qotd", true);
							xhttp.send();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									// Access the result here
									const quote = JSON.parse(this.responseText).quote;
									document.getElementById("quoteBody").innerHTML = quote.body;
									document.getElementById("quoteAuthor").innerHTML = quote.author;
								}
							};
						}
						get_quote_of_the_day();
					</script>

			</article>

		</div>

	</div>
	<?php include 'includes/footer.php' ?>
</body>

</html>