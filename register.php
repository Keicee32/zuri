<?php session_start();
include_once "libs/header.php"; 
?>

<section id="register">
    <div class="container">
        <h3>Register</h3>
        <form action="formaction.php" method="post">

            <?php if(isset($_SESSION['full_name']) && !empty($_SESSION['full_name'])){
                echo "<span style='color:red; text-align:center;'>" . $_SESSION['full_name'] . "</span>";
                session_destroy();
            }
            ?>
            <label for="fullName">Full Name</label>
            <input type="text" name="full_name" id="fullName" >

            <?php if(isset($_SESSION['email_err']) && !empty($_SESSION['email_err'])){
                echo "<span style='color:red; text-align:center;'>" . $_SESSION['email_err'] . "</span>";
                session_unset();
            }
            ?>
            <label for="Email">Email</label>
            <input type="text" name="email" id="Email" >

            <?php if(isset($_SESSION['phone_err']) && !empty($_SESSION['phone_err'])){
                echo "<span style='color:red; text-align:center;'>" . $_SESSION['phone_err'] . "</span>";
                session_unset();
            }
            ?>
            <label for="Phone">Phone</label>
            <input type="text" name="phone" id="Phone" >


            <label for="Password">Password</label>
            <input type="password" name="password" id="Password" >

            <button type="submit" name="submit">Submit</button>
        </form>
        <p>Have an account? <a href="login.php">Login here</a></p>
    </div>
</section>

<?php include_once "libs/footer.php"; ?>