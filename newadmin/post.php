<?php include 'includes/connection.php';
session_start();
if (isset($_SESSION['role'])) {
} else {
    echo "<script>alert('you need to login first');
    window.location.href='../index.php';</script>";
}
?>

<?php
if (isset($_SESSION['role'])) {
    $currentrole = $_SESSION['role'];
}
if ($currentrole == 'user') {
    echo "<script> alert('Only ADMIN can add users');
window.location.href='../index.php'; </script>";
}
?>

<?php

if (isset($_GET['post'])) {
    $post = mysqli_real_escape_string($conn, $_GET['post']);
} else {
    header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
    $query = "SELECT * FROM posts WHERE id='$post'";
} else {
    $query = "SELECT * FROM posts WHERE id='$post' AND author = '$currentuser'";
}
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
    while ($row = mysqli_fetch_array($run_query)) {
        $post_title = $row['title'];
        $post_id = $row['id'];
        $post_author = $row['author'];
        $post_date = $row['postdate'];
        $post_image = $row['image'];
        $post_content = $row['content'];
        $post_tags = $row['tag'];
        $post_status = $row['status'];
        $post_cat = $row['cat_id'];


        $query ='SELECT posts.id, Categories.cat_title

        FROM posts
        INNER JOIN Categories
        ON posts.cat_id = Categories.cat_id;';

        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_array( $run_query)){

            $post_cat  = $row['cat_title'];                                                         

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

                            <hr>
                            <p>
                            <h2><a href="#"><?php echo $post_title; ?></a></h2>
                            </p>
                            <p>
                            <h3>by <a href="#"><?php echo $post_author; ?></a></h3>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span>Posted on <?php echo $post_date; ?></p>
                            <p><span class="glyphicon glyphicon"></span>Category <?php echo $post_cat; ?></p>
                            <hr>
                            <img class="img-responsive img-rounded" src="../allpostpics/<?php echo $post_image; ?>" alt="900 * 300">
                            <hr>
                            <p><?php echo $post_content; ?></p>

                            <hr>
                    <?php }
            } else {
                echo "<script>alert('error');</script>";
            } ?>

                    </article>

                </div>

            </div>
            <?php include 'includes/footer.php' ?>

        </body>

        </html>
        </body>

        </html>