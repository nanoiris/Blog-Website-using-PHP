<?php
session_start();
require 'includes/connection.php'; // connect to the database 

// get user form data if submit button was clicked 
if (isset($_POST['submit'])) {
    // use the name of the input to get the value that'll be passed in 
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userrole = $_POST['userrole'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate input values 
    if (!$firstname) {
        $_SESSION['adduser'] = "Please enter your first name";
    } else if (!$lastname) {
        $_SESSION['adduser'] = "Please enter your last name";
    } else if (!$username) {
        $_SESSION['adduser'] = "Please enter your username";
    } else if (!$email) {
        $_SESSION['adduser'] = "Please enter your email";
    } else if (strlen($createpassword) < 2) {
        $_SESSION['adduser'] = "Password should be 2+ characters";
    } else if (!$confirmpassword) {
        $_SESSION['adduser'] = "Please confirm your password";
    } else {
        // check if password do not match 
        if ($createpassword !== $confirmpassword) {
            $_SESSION['adduser'] = "Password does not match";
        } else {
            $md5_password = md5($createpassword);
            // echo $createpassword . '<br/>';
            // echo $hashed_password . '<br/>';
            $user_check_query = "SELECT * FROM users WHERE 
            username = '$username' OR email = '$email' ";
            $user_check_result = mysqli_query($conn, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['adduser'] = "username or email already exsits";
            }
        }
    }
    // redirect to the add user page if there was any problem 
    if (isset($_SESSION['adduser'])) {
        // pass form data back to add user page 
        $_SESSION['adduser-data'] = $_POST;
        header('location: ' . 'http://localhost:8080/WD-project1/WD-project/newadmin/' . 'adduser.php');
        die();
    } else {
        // insert new user into user table 
        $insert_new_query = "INSERT INTO users (username, firstname, lastname, email, password, role) VALUES ('$username', '$firstname', '$lastname', '$email', '$md5_password','$userrole' )";

        $add_user_query = mysqli_query($conn, $insert_new_query);

        if (!mysqli_error($conn)) {
            $_SESSION['adduser-success'] = "Add user successfully!";
            header('location: ' . 'http://localhost:8080/WD-project1/WD-project/newadmin/' . 'users.php');
            die();
        }
    }
} else {
    // if button wasnt clicked, bounce back to the adduser page 
    header('location: ' . 'http://localhost:8080/WD-project1/WD-project/newadmin/' .  'adduser.php');
    die();
}
