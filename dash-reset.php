<?php session_start();

if(!isset($_SESSION['id']) && $_SESSION['id'] != true){

    header('Location: login.php');
}
include_once "./libs/dash-header.php"; ?>

<section id="login">
        <div class="container">
            <h3>Password Reset</h3>
            <form action="processreset.php" method="post">

            <?php if(isset($_SESSION['pass_err']) && !empty($_SESSION['pass_err'])){
                echo "<span style='color:red; text-align:center;'>" . $_SESSION['pass_err'] . "</span>";
                session_destroy();
            }
            ?>
                <label for="Password">Password</label>
                <input type="password" name="password" id="Password" >

                <label for="Password">Confirm Password</label>
                <input type="password" name="password2" id="Password" >

                <button type="submit" name="reset">Submit</button>

            </form>

        </div>
    </section>

<?php include_once "./libs/dash-footer.php"; ?>