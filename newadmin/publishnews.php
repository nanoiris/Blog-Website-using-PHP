<?php include 'includes/connection.php';
session_start();
if (isset($_SESSION['role'])) {
} else {
    echo "<script>alert('you need to login first');
    window.location.href='../index';</script>";
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
                    <h2>PUBLISH NEW POST</h2>
                    <?php

                    


                    //  input function: ??
                    function test_input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }



                    if (isset($_POST['publish'])) {


           $post_title = test_input($_POST['title']);                         
                        $post_tag = test_input($_POST['tags']);
                        $post_cat = test_input($_POST['category']);                        
                        $post_content = test_input( $_POST['content']);


                        if (isset($_SESSION['firstname'])) {
                            $post_author = $_SESSION['firstname'];
                        }
                        $post_date = date('Y-m-d');
                        $post_status = 'draft';

                        // image validation:

                        $image = $_FILES['image']['name'];
                        $ext = $_FILES['image']['type'];
                        $validExt = array("image/gif",  "image/jpeg",  "image/jpg", "image/png");

                        if (empty($image)) {
                            echo "<script>alert('Attach an image');</script>";

                        } else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000) {
                            echo "<script>alert('Image size is not proper');</script>";

                        } else if (!in_array($ext, $validExt)) {
                            echo "<script>alert('Not a valid image');</script>";

                        } else {
                            $folder  = '../allpostpics/';
                            $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                            $picture = rand(1000, 1000000) . '.' . $imgext; //file naming
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $folder . $picture)) {
                                $query = "INSERT INTO posts (title,author,postdate,image,content,status,tag,cat_id ) VALUES ('$post_title' , '$post_author' , '$post_date' , '$picture' , '$post_content' , '$post_status', '$post_tag',  '$post_cat') ";

                                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_affected_rows($conn) > 0) {
                                    echo "<script> alert('Post published successfully.It will be published after admin approves it');
                window.location.href='posts.php';</script>";
                                } else {
                                    "<script> alert('Error while posting..try again');</script>";
                                }
                            }
                        }
                    }
                    ?>

                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="post_title">Post Title</label>
                            <input type="text" name="title" placeholder="Enter title " value="<?php if (isset($_POST['publish'])) {
                                                                                                    echo $post_title;
                                                                                                } ?>" class="form-control" required>
                        </div>
                        <br>


                        <div class="form-group">
                            <label for="post_image">Post Image<font color='brown'> (Max image size: 1 MB) </font> </label>

                            <input type="file" name="image">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="post_tag">Post Tags</label>
                            <input type="text" name="tags" placeholder="Enter some tags separated by comma (,)" value="<?php if (isset($_POST['publish'])) {
                                                                                                                            echo $post_tag;
                                                                                                                        } ?>" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="post_cat">Post Category</label>

                            <input list= "category" type="text" name="category" placeholder="Enter post category" value="<?php if (isset($_POST['publish'])) {

                                                                                                                            echo $post_cat;
                                                                                                                        } ?>" class="form-control">
                            <datalist id="category">
                                <option value="Beauty">
                                <option value="Fashion">
                                <option value="Lifestyle">

                            </datalist>

                        </div>
                        <br>
                        <div class="form-group">
                            <label for="post_content">Post Content</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="15"><?php if (isset($_POST['publish'])) {
                                                                                                        echo $post_content;
                                                                                                    } ?></textarea>
                        </div>
                        <button type="submit" name="publish" class=" btn btn-primary" value="Publish Post">Publish Post</button>

                    </form>

                </div>

        </div>
        <?php include 'includes/footer.php' ?>
        <script src="js/jquery.js"></script>


        <script src="js/bootstrap.min.js"></script>

</body>

</html>