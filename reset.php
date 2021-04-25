<?php

require_once "config/db.php";

$email = "";
$errors = array();

if(isset($_POST['reset'])){
    $email = trim($_POST['email']);

    if(empty($email)){
        $errors['email'] = "Email Required";
    }

    $sql = "SELECT email FROM users WHERE email=:em";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':em', $email);
    $stmt->execute();

    $result = $stmt->fetch();
    if(!$result){
        $errors['email'] = "Email does not exists";
    }

    if(empty($errors)){
        header("Location: change.php?email=$email");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Password Reset</title>
</head>
<body>
    <main>
        <section class="glass">
            <div class="form-group">
                <h3>Password Reset</h3>

                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-red">
                        <?php foreach($errors as $error): ?>
                        <li><?php echo $error ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <input type="text" name="email" id="" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email);?>">
                    <div class="btn">
                        <button name="reset">Reset</a></button>
                    </div>
                    <p><a href="index.php">Go Back</a></p>
                    
                </form>
            </div>
        </section>
    </main> 
</body>
</html>