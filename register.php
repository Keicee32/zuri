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
    <title>Register</title>
</head>
<body>
    <main>
        <section class="glass">
            <div class="form-group">
                <h3>Please Register</h3>

                <?php if(count($errors) > 0): ?>
                <div class="alert alert-red">
                    <?php foreach($errors as $error): ?>
                    <li><?php echo $error ?></li>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <form action="register.php" method="POST">
                    <input type="text" name="full_name" id="" placeholder="Enter your Full Name" value="<?php echo htmlspecialchars($full_name);?>">
                    <input type="text" name="email" id="" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email);?>">
                    <input type="text" name="username" id="" placeholder="Enter your Username" value="<?php echo htmlspecialchars($username);?>">
                    <input type="password" name="password" id="" placeholder="Enter your Password">
                    <input type="password" name="password2" id="" placeholder="Confirm Password">
                    <div class="btn">
                        <button name="submit" type="submit">Submit</button>
                    </div>
                    <p>Already have an account? <a href="index.php">Login here</a></p>
                </form>
            </div>
        </section>
    </main>
</body>
</html>