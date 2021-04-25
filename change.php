<?php

require_once "config/db.php";

$errors = array();

$email = isset($_GET['email']) ? $_GET['email'] : die('Error: Record not found');

if(isset($_POST['reset-pass'])){
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if(empty($password)){
        $errors['password'] = "Password is required";
    }

    if($password !== $password2){
        $errors['password'] = "The two passwords do not match";
    }

    if(empty($errors)){
        try{
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password=:pw WHERE email=:em";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":pw", $password);
            $stmt->bindParam(":em", $email);


            if($stmt->execute()){
                header("Location: index.php");
            } else{
                echo "Not Successful";
            }

        }catch(PDOException $e){
            echo "Connection Error: " . $e->getMessage();
        }
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
                    <input type="password" name="password" id="" placeholder="Enter your new Password">
                    <input type="password" name="password2" id="" placeholder="Confirm your new Password">
                    <div class="btn">
                        <button name="reset-pass" type="submit">Submit</button>
                    </div>
                    <p><a href="index.php">Go Back</a></p>
                    
                </form>
            </div>
        </section>
    </main> 

</body>
</html>