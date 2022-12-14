<?php include 'includes/connection.php';
session_start();
if (isset($_SESSION['role'])) {
} else {
    echo "<script>alert('you need to login first');
    window.location.href='../index';</script>";
}
?>

<?php
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
} else {
    header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
    $query = "SELECT * FROM posts WHERE id='$id'";
} else {
    $query = "SELECT * FROM posts WHERE id='$id' AND author = '$currentuser'";
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


        // Content validation
        function testString($input)
        {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }



        if (isset($_POST['update'])) {

            $post_title = testString($_POST['title']);
            $post_tag = testString($_POST['tags']);
            $post_content = testString($_POST['content']);
            $post_date = date('Y-m-d');
            $post_cat = testString($_POST['category']);
            if ($_SESSION['role'] == 'admin') {
                $post_status = 'draft';
            } else {
                $post_status = $_POST['status'];
            }



            $image = $_FILES['image']['name'];
            $ext = $_FILES['image']['type'];
            $validExt = array("image/gif",  "image/jpg",  "image/jpeg", "image/png"); //accepted image forma
            if (empty($image)) {
                $picture = $post_image;
            } else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000) {
                echo "<script>alert('Image size is not proper');
        window.location.href = 'editposts.php?id=$id';</script>";
            } else if (!in_array($ext, $validExt)) {
                echo "<script>alert('Not a valid image');
        window.location.href = 'editposts.php?id=$id';</script>";
                exit();
            } else {
                $folder  = '../allpostpics/';
                $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION));


                 //choose a tmp name for the image on database

                $picture = rand(1000, 1000000) . '.' . $imgext;

                move_uploaded_file($_FILES['image']['tmp_name'], $folder . $picture);
            }


            $queryupdate = "UPDATE posts SET title = '$post_title' , tag = '$post_tag' , content='$post_content' , 	status = '$post_status' , image = '$picture' , postdate = '$post_date', cat_id = '$post_cat' WHERE id= '$post_id' ";            $result = mysqli_query($conn, $queryupdate) or die(mysqli_error($conn));

            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('POST SUCCESSFULLY UPDATED');
        	window.location.href= 'posts.php';</script>";
            } else {
                echo "<script>alert('Error! ..try again');</script>";
            }
        }
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
                    <form role="form" action="" method="POST" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="post_title">Post Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $post_title;  ?>">
                        </div>

                        <div class="form-group">
                            <label for="post_tags">Post Tags</label>
                            <input type="text" name="tags" class="form-control" value="<?php echo  $post_tags; ?>">
                        </div>
                        <div class="form-group">
                            <label for="post_cat">Post Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo  $post_cat; ?>">
                        </div>

                        <div class="input-group">
                            <label for="post_status">Post Status</label>
                            <select name="status" class="form-control">
                                <?php if ($_SESSION['role'] == 'user') {
                                    echo "<option value='draft' >draft</option>";
                                } else { ?>
                                    <option value="<?php echo $post_status; ?>"><?php echo  $post_status;  ?></option>>
                                    <?php
                                    if ($post_status == 'published') {
                                        echo "<option value='draft'>Draft</option>";
                                    } else {
                                        echo "<option value='published'>Publish</option>";
                                    }
                                    ?>
                                <?php
                                }
                                ?>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="post_image">Post Image</label>
                            <img class="img-responsive" width="200" src="../allpostpics/<?php echo $post_image; ?>" alt="Photo">
                            <input type="file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="post_content">Post Content</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content;  ?>
</textarea>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary" value="Update Post">Update Post</button>
                    </form>


                </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>

</body>

</html>
</body>

</html>