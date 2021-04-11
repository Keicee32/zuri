<?php session_start();
include_once "libs/header.php"; ?>

    <section id="login">
        <div class="container">
            <h3>Login</h3>


            <?php if(isset($_SESSION['db_not_found']) && !empty($_SESSION['db_not_found'])){
                    echo "<span style='color:red; text-align:center;'>" . $_SESSION['db_not_found'] . "</span>";
                    session_unset();
                }
                ?>
            
            <form action="processlogin.php" method="post">

                <?php if(isset($_SESSION['email_err']) && !empty($_SESSION['email_err'])){
                    echo "<span style='color:red; text-align:center;'>" . $_SESSION['email_err'] . "</span>";
                    session_destroy();
                }
                ?>
                <label for="Email">Email</label>
                <input type="text" name="email" id="Email" >

                <?php if(isset($_SESSION['pass_err']) && !empty($_SESSION['pass_err'])){
                    echo "<span style='color:red; text-align:center;'>" . $_SESSION['pass_err'] . "</span>";
                    session_unset();
                }
                ?>
                <label for="Password">Password</label>
                <input type="password" name="password" id="Password" >

                <button type="submit" name="login">Submit</button>

            </form>

            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <p>Forgot Password? <a href="reset.php">Request new Password</a></p>
        </div>
    </section>

<?php include_once "libs/footer.php"; ?>