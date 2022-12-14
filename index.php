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
				$query = "SELECT P.title, P.id, P.author, P.postdate, P.image, P.content, P.tag, P.status, P.cat_id, C.cat_title FROM posts AS P JOIN categories AS C on P.cat_id = C.cat_id WHERE status='published' ORDER BY updated_on DESC";
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

							<a href="single.html" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
							<?php $post_lead = mb_substr($post_content, 0, 400, "UTF-8"); ?>
							<p><?php echo $post_lead ?>...</p>
							<footer>
								<ul class="actions">
									<li><a href="publicposts.php?post=<?php echo $post_id; ?>" class="button large">Continue Reading</a></li>
								</ul>
							</footer>

				<?php }
					}
				} ?>
			</article>




			<!-- Pagination -->
			<ul class="actions pagination">
				<li><a href="" class="disabled button large previous">Previous Page</a></li>
				<li><a href="#" class="button large next">Next Page</a></li>
			</ul>

		</div>

		<!-- Sidebar -->
		<?php include 'includes/sidebar.php' ?>

	</div>
	<?php include 'includes/footer.php' ?>
	</body>
</html>