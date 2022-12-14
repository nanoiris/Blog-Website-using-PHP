<section id="menu">

    <section>
    </section>

    <section>
        <ul class="links">
            <li>
                <h3><?php echo "Hello " . $_SESSION['firstname'] . "!" ?></h3>
            </li>
            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin') { ?>
                <li>
                    <a href="#">
                        <h3><a href="./index.php">Dashboard</a></h3>
                    </a>
                </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin') { ?>
                <li>
                    <a href="#">
                        <h3><a href="./users.php">View All Users</a></h3>
                        <p><a href="adduser.php">Add New User</a></p>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="#">
                    <h3><a href="./posts.php">View All Posts</a></h3>
                    <p><a href="./publishnews.php">Add New Post</a></p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3><a href="./profile.php">View Your Profile</a></h3>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <button name="loginout" class="button Large fit">Log out</button>
                </a>
            </li>
        </ul>

    </section>

</section>