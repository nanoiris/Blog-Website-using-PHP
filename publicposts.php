<?php session_start();
 include 'includes/connection.php'; ?>

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
				<?php
				if (isset($_GET['post'])) {
					$post = $_GET['post'];
					if (!is_numeric($post)) {
					  header("location:index.php");
					} 
				}
				else {
					header('location: index.php');
				}
				$query = "SELECT P.title, P.id, P.author, P.postdate, P.image, P.content, P.tag, P.status, P.cat_id, C.cat_title 
							FROM posts AS P JOIN categories AS C on P.cat_id = C.cat_id WHERE id=$post";
				$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($run_query) > 0) {
					while ($row = mysqli_fetch_assoc($run_query)) {
						$post_title = $row['title'];
						$post_id = $row['id'];
						$post_author = $row['author'];
						$post_date = $row['postdate'];
						$post_image = $row['image'];
						$post_content = $row['content'];
						$post_tags = $row['tag'];
						$post_status = $row['status'];
						$post_cat_id  = $row['cat_id'];
						$post_cat_title  = $row['cat_title'];
						if ($post_status !== 'published') {
							echo "NO POST PLS";
						} else {
				?>
							<header>
								<div class="title">
									<h2><a href="publicposts.php?post=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h2>
									<h5><a href="search.php?category=<?php echo $post_cat_title; ?>"><?php echo $post_cat_title; ?></a></h5>
								</div>
								<div class="meta">
									<a href="search.php?author=<?php echo $post_author; ?>" class="author"><span class="name"><?php echo $post_author; ?>
										</span><img src="images/avatar.jpg" alt="" /></a>
									<p><?php echo $post_date; ?></p>
								</div>
							</header>

							<img class="image featured" src="allpostpics/<?php echo $post_image; ?>" alt="">
							<hr>
                			<p><?php echo $post_content; ?></p>
				<?php }
					}
				} else {
					echo "<h1>Oops! no result found for your query</h1>";
				} ?>
			</article>
		</div>

	</div>
	<?php include 'includes/footer.php' ?>
	</body>
</html>