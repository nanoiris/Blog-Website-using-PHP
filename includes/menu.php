<section id="menu">

    <?php if (isset($_SESSION['role'])) { // already logged in 
    ?>
        <section>
            <ul class="links">
                <li>
                    <h3><?php echo "Hello " . $_SESSION['firstname'] . "!" ?></h3>
                </li>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin') { ?>
                    <li>
                        <a href="#">
                            <h3><a href="newadmin/index.php">Dashboard</a></h3>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin') { ?>
                    <li>
                        <a href="#">
                            <h3><a href="newadmin/users.php">View All Users</a></h3>
                            <p><a href="newadmin/adduser.php">Add New User</a></p>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="#">
                        <h3><a href="newadmin/posts.php">View All Posts</a></h3>
                        <p><a href="newadmin/publishnews.php">Add New Post</a></p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h3><a href="newadmin/profile.php">View Your Profile</a></h3>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <button name="loginout" class="button Large fit">Log out</button>
                    </a>
                </li>
            </ul>

        </section>
    <?php } else { ?>
        <!-- login -->
        <section>
            <form method="POST" action="login.php">
                <input style="margin-bottom: 1em" name="username" type="text" placeholder="Username" required>
                <input style="margin-bottom: 1em" name="password" type="password" placeholder="Password" required>
                <button name="login" class="button large fit" type="submit">Log in</button>
                <div style="text-align:center"><a href="register.php">Register</a></div>
            </form>
        </section>
    <?php } ?>

</section>