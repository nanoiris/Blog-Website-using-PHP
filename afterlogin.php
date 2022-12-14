<?php include 'includes/connection.php';
?>
<?php include 'includes/header.php'; ?>

<?php include 'includes/navbar.php'; ?>

<!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">


				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">CG Blogging platform</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                    	  <li><a href="about.php">About Us</a></li>
						            <li><a href="">Trending News</a></li>
						            <li><a href="register.php">Register</a></li>
                    </ul>
				
                    <ul class="nav navbar-right top-nav">              
                        <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                    </ul>
         </div>

		</div>
</nav>-->



<?php

session_start();
if (isset($_SESSION['role'])) {
	
}
else {
    echo "<script>alert('you need to login first');
    window.location.href='../index';</script>";	
}?>

              <div class="row">
                <div class="col-md-2">

</div>
<div class="col-md-10">
                    <h4 class="page-header">
                        Welcome 
                        <b><?php echo $_SESSION['firstname']; ?></b>
                    </h4>
                </div>
              </div>

<div class="container">
  <div class="row">

    <div class="col-md-8">

      <?php
      $query = "SELECT * FROM posts WHERE status='published' ORDER BY updated_on DESC";
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
          if ($post_status !== 'published') {
            echo "NO POST PLS";
          } else {

      ?>
            <p>
            <h2><a href="publicposts.php?post=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h2>
            </p>
            <p>
            <h3>by <a href="#"><?php echo $post_author; ?></a></h3>
            </p>
            <p><span class="glyphicon glyphicon-time"></span>Posted on <?php echo $post_date; ?></p>
            <hr><a href="publicposts.php?post=<?php echo $post_id; ?>">
              <img class="img-responsive img-rounded" src="allpostpics/<?php echo $post_image; ?>" alt="900 * 300"></a>
            <hr>
            <p><?php echo substr($post_content, 0, 300) . '.........'; ?></p>
            <a href="publicposts.php?post=<?php echo $post_id; ?>"><button type="button" class="btn btn-primary">Read More<span class="glyphicon glyphicon-chevron-right"></span></button></a>
            <hr>

      <?php }
        }
      } ?>

      <hr>
      <ul class="pager">
        <li class="previous"><a href="#"><span class="glyphicon glyphicon-arrow-left"></span> Older</a></li>
        <li class="next"><a href="#">Newer <span class="glyphicon glyphicon-arrow-right"></span></a></li>
      </ul>
    </div>

    
    <div class="col-md-4">

    <div class="well">

<h4>Search</h4>
<form method="GET" action="search.php">
    <div class="input-group">
        <input name="search" type="text" class="form-control" required>
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>

</div>

</div>


  </div>


  <?php include 'includes/footer.php'; ?>

</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>