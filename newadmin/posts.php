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
    echo "<script> alert('Only ADMIN can view');
window.location.href='./index.php'; </script>";
} else if ($currentrole == 'superadmin') {
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
                <!-- <article class="post"> -->

                <div class="container">
                    <h2>Check list of posts,
                        <small style="color: #1bc19a"><?php echo $_SESSION['firstname']; ?></small>
                    </h2>

                    <button class="btn btn-primary"><a href="publishnews.php">Add New Post</a></button>
                    <br>
                    <?php if (isset($_SESSION['adduser-success'])) : ?>
                        <div class="alert_message success">
                            <p style="color: #1bc19a; font-size: 2rem">
                                <?= $_SESSION['adduser-success'];
                                unset($_SESSION['adduser-success']) ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <table class="table table-bordered table-striped table-hover">


                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>View Post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Publish</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $query = "SELECT * FROM posts ORDER BY id DESC";
                            $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                            if (mysqli_num_rows($run_query) > 0) {
                                while ($row = mysqli_fetch_array($run_query)) {
                                    $post_id = $row['id'];
                                    $post_title = $row['title'];
                                    $post_author = $row['author'];
                                    $post_date = $row['postdate'];
                                    $post_image = $row['image'];
                                    $post_content = $row['content'];
                                    $post_tags = $row['tag'];
                                    $post_status = $row['status'];
                                    $post_cat = $row['cat_id'];


                                    $query2 ='SELECT posts.id, Categories.cat_title

                                    FROM posts
                                    INNER JOIN Categories
                                    ON posts.cat_id = Categories.cat_id;';

                                    $run_query2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

                                    while($row = mysqli_fetch_array( $run_query2)){

                                        $post_cat  = $row['cat_title'];                                                         

                                    }


                                    echo "<tr>";
                                    echo "<td>$post_id</td>";
                                    echo "<td>$post_author</td>";
                                    echo "<td>$post_title</td>";
                                    echo "<td>$post_status</td>";
                                    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
                                    echo "<td>$post_tags</td>";
                                    echo "<td>$post_date</td>";
                                    echo "<td>$post_cat</td>";
                                    echo "<td><a href='post.php?post=$post_id' style='color:green'>See Post</a></td>";
                                    echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span>Edit</a></td>";

                                   // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i></a></td>";
                                   echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to publish this post?')\"href='?pub=$post_id'>publish</a></td>";

                                    echo "</tr>";
                                }
                            } else {
                                echo "<script>alert('Not any posts yet! Start Posting now');
    window.location.href= 'publishnews.php';</script>";
                            }
                            ?>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    <?php
} else if ($_SESSION['role'] == 'admin') {
    ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">

                    <form action="" method="post">
                        <table class="table table-bordered table-striped table-hover">


                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Publish</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $currentuser = $_SESSION['firstname'];
                                $query = "SELECT * FROM posts WHERE author = '$currentuser' ORDER BY id DESC";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0) {
                                    while ($row = mysqli_fetch_array($run_query)) {
                                        $post_id = $row['id'];
                                        $post_title = $row['title'];
                                        $post_author = $row['author'];
                                        $post_date = $row['postdate'];
                                        $post_image = $row['image'];
                                        $post_content = $row['content'];
                                        $post_tags = $row['tag'];
                                        $post_status = $row['status'];
                                        $post_cat = $row['cat_id'];


                                    $query3 ='SELECT posts.id, Categories.cat_title

                                    FROM posts
                                    INNER JOIN Categories
                                    ON posts.cat_id = Categories.cat_id;';


                                    $run_query3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
                                    while($row = mysqli_fetch_array($run_query3)){

                                        $post_cat  = $row['cat_title'];                                                         
                                    }




                                        echo "<tr>";
                                        echo "<td>$post_id</td>";
                                        echo "<td>$post_author</td>";
                                        echo "<td>$post_title</td>";
                                        echo "<td>$post_status</td>";
                                        echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
                                        echo "<td>$post_tags</td>";
                                        echo "<td>$post_date</td>";
                                        echo "<td>$post_cat</td>";
                                        echo "<td><a href='post.php?post=$post_id' style='color:green'>See Post</a></td>";
                                        echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
                                        //echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to publish this post?')\"href='?pub=$post_id'><i class='fa fa-times' style='color: red;'></i>publish</a></td>";

                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<script>alert('You have not posted any news yet! Start Posting now');
                                    window.location.href= 'publishnews.php';</script>";
                                }
                                ?>


                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (isset($_GET['del'])) {
            $post_del = mysqli_real_escape_string($conn, $_GET['del']);
            $del_query = "DELETE FROM posts WHERE id='$post_del'";
            $run_del_query = mysqli_query($conn, $del_query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('post deleted successfully');
            window.location.href='posts.php';</script>";
            } else {
                echo "<script>alert('error occured.try again!');</script>";
            }
        }
        if (isset($_GET['pub'])) {
            $post_pub = mysqli_real_escape_string($conn, $_GET['pub']);
            $pub_query = "UPDATE posts SET status='published' WHERE id='$post_pub'";
            $run_pub_query = mysqli_query($conn, $pub_query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('post published successfully');
            window.location.href='posts.php';</script>";
            } else {
                echo "<script>alert('error occured.try again!');</script>";
            }
        }

        ?>
    <?php
} else {
    ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">

                    <form action="" method="post">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $currentuser = $_SESSION['firstname'];

                                $query = "SELECT * FROM posts WHERE author = '$currentuser' ORDER BY id DESC";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0) {
                                    while ($row = mysqli_fetch_array($run_query)) {
                                        $post_id = $row['id'];
                                        $post_title = $row['title'];
                                        $post_author = $row['author'];
                                        $post_date = $row['postdate'];
                                        $post_image = $row['image'];
                                        $post_content = $row['content'];
                                        $post_tags = $row['tag'];
                                        $post_status = $row['status'];
                                        $post_cat = $row['cat_id'];


                                        $query3 ='SELECT posts.id, Categories.cat_title

                                        FROM posts
                                        INNER JOIN Categories
                                        ON posts.cat_id = Categories.cat_id;';

                                        $run_query4 = mysqli_query($conn, $query4) or die(mysqli_error($conn));

                                        while($row = mysqli_fetch_array($run_query4)){

                                        $post_cat  = $row['cat_title'];                                                         


                                        echo "<tr>";
                                        echo "<td>$post_title</td>";
                                        echo "<td>$post_status</td>";
                                        echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
                                        echo "<td>$post_tags</td>";
                                        echo "<td>$post_date</td>";
                                        echo "<td>$post_cat</td>";
                                        echo "<td><a href='post.php?post=$post_id' style='color:green'>See Post</a></td>";
                                        echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<script>alert('You have not posted any posts yet! Start Posting now');
    window.location.href= 'publishnews.php';</script>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['del'])) {
            $post_del = mysqli_real_escape_string($conn, $_GET['del']);
            $del_query = "DELETE FROM posts WHERE id='$post_del' AND author='$currentuser'";
            $run_del_query = mysqli_query($conn, $del_query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('post deleted successfully');
            window.location.href='posts.php';</script>";
            } else {
                echo "<script>alert('error occured.try again!');</script>";
            }
        }
        ?>
    <?php
}
    ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script src="js/jquery.js"></script>


    <script src="js/bootstrap.min.js"></script>

    </body>

    </html