<?php 

require_once "libs/form-valid.php";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome</title>
</head>
<body>
    <main>
        <section class="glass">
            <div class="form-group">
                <h3>Please Login</h3>

                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-red">
                        <?php foreach($errors as $error): ?>
                        <li><?php echo $error ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="index.php" method="POST">
                    <input type="text" name="username" id="" placeholder="Enter your Username or Email" value="<?php echo htmlspecialchars($username);?>">
                    <input type="password" name="password" id="" placeholder="Enter your Password" >
                    <div class="btn">
                        <button name="login" type="submit">Login</button>
                    </div>
                    <p>Forgot Password? <a href="reset.php">Click here</a></p>
                    <p>Dont have an account? <a href="register.php">Sign up here</a></p>
                </form>
            </div>
        </section>
    </main>
</body>
</html>