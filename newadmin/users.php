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
    echo "<script> alert('Only ADMIN can view user list');
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
                    <h2>Welcome,
                        <small style="color: #1bc19a"><?php echo $_SESSION['firstname']; ?></small>
                    </h2>
                    <h2>All users</h2>
                    <?php if (isset($_SESSION['adduser-success'])) : ?>
                        <div class="alert_message success">
                            <p style="color: #1bc19a; font-size: 2rem">
                                <?= $_SESSION['adduser-success'];
                                unset($_SESSION['adduser-success']) ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Change Role</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
                            if (mysqli_num_rows($select_users) > 0) {
                                while ($row = mysqli_fetch_array($select_users)) {
                                    $user_id = $row['id'];
                                    $username = $row['username'];
                                    $user_firstname = $row['firstname'];
                                    $user_lastname = $row['lastname'];
                                    $user_email = $row['email'];
                                    $user_role = $row['role'];
                                    echo "<tr>";
                                    echo "<td>$user_id</td>";
                                    echo "<td>$username</td>";
                                    echo "<td>$user_firstname</td>";
                                    echo "<td>$user_lastname</td>";
                                    echo "<td>$user_email</td>";
                                    echo "<td>$user_role</td>";
                                    echo "<td><a href='users.php?change_to_admin=$user_id''>Assign Admin</a></td>";
                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";
                                    echo "</tr>";
                                }

                            ?>

                        </tbody>
                    </table>
                <?php
                            }

                            if (isset($_GET['delete'])) {
                                $the_user_id = $_GET['delete'];
                                $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
                                $result = mysqli_query($conn, $query0) or die(mysqli_error($conn));
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    $id1 = $row['role'];
                                }
                                if ($id1 == 'superadmin') {
                                    echo "<script>alert('super-admin cannot be deleted');</script>";
                                } else {

                                    $query = "DELETE FROM users WHERE id = '$the_user_id'";

                                    $delete_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                    if (mysqli_affected_rows($conn) > 0) {
                                        echo "<script>alert('user deleted successfully'); window.location.href= 'users.php';</script>";
                                    }
                                }
                            }


                            if (isset($_GET['change_to_admin'])) {
                                $the_user_id = $_GET['change_to_admin'];

                                $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
                                $result = mysqli_query($conn, $query0) or die(mysqli_error($conn));
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    $id1 = $row['role'];
                                }
                                if ($id1 == 'admin') {
                                    echo "<script>alert('USER IS ALREADY ADMIN');</script>";
                                } else if ($id1 == 'superadmin') {
                                    echo "<script>alert('Cannot change role for super-admin');</script>";
                                } else {
                                    $query = "UPDATE users SET role = 'admin' WHERE id = '$the_user_id'";

                                    $change_to_admin_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                    if (mysqli_affected_rows($conn) > 0) {
                                        echo "<script>alert('changed to admin successfully');
            window.location.href= 'users.php'; </script>";
                                    }
                                }
                            }
                ?>


                </div>

            </div>
        <?php
    } else {
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
                            <h2>Welcome,
                                <small style="color: #1bc19a"><?php echo $_SESSION['firstname']; ?></small>
                            </h2>
                            <h2>View All users</h2>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM users WHERE role <> 'superadmin' AND role <> 'admin'";
                                    $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                    if (mysqli_num_rows($select_users) > 0) {
                                        while ($row = mysqli_fetch_array($select_users)) {
                                            $user_id = $row['id'];
                                            $username = $row['username'];
                                            $user_firstname = $row['firstname'];
                                            $user_lastname = $row['lastname'];
                                            $user_email = $row['email'];
                                            $user_role = $row['role'];
                                            echo "<tr>";
                                            echo "<td>$user_id</td>";
                                            echo "<td>$username</td>";
                                            echo "<td>$user_firstname</td>";
                                            echo "<td>$user_lastname</td>";
                                            echo "<td>$user_email</td>";
                                            echo "<td>$user_role</td>";
                                            // echo "<td><a href='users.php?change_to_admin=$user_id''>Assign Admin</a></td>";
                                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";
                                            echo "</tr>";
                                        }

                                    ?>

                                </tbody>
                            </table>
                    <?php
                                    }

                                    if (isset($_GET['delete'])) {
                                        $the_user_id = $_GET['delete'];
                                        $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
                                        $result = mysqli_query($conn, $query0) or die(mysqli_error($conn));
                                        if (mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_array($result);
                                            $id1 = $row['role'];
                                        }
                                        if ($id1 == 'superadmin') {
                                            echo "<script>alert('super-admin cannot be deleted');</script>";
                                        } else {

                                            $query = "DELETE FROM users WHERE id = '$the_user_id'";

                                            $delete_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                            if (mysqli_affected_rows($conn) > 0) {
                                                echo "<script>alert('user deleted successfully'); window.location.href= 'users.php';</script>";
                                            }
                                        }
                                    }
                                }

                    ?>



                    <?php include 'includes/footer.php' ?>
            </body>

            </html>