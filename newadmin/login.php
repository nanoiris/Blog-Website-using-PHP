<!-- 2022/09/30 2:24 -->
<?php
include('includes/connection.php');
session_start();

// When form submitted, check and create user session.
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);    // removes backslashes
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Check user is exist in the database
    $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";

    $result = mysqli_query($conn, $query) or die(mysqli_connect_errno());

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $pass = $row['password'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['image'] = $row['image'];

            // Redirect to user dashboard page
            header('Location: profile.php');
        }
    } else {
        echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
    }
}
