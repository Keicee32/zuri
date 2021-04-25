<?php session_start();

require_once "config/db.php";

$errors = array();

$full_name = $username = $email = $course = $year = $semester = "";

// If the user submits the registration form
if(isset($_POST['submit'])){

    $full_name = trim(ucwords($_POST['full_name']));
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    $_SESSION['full_name'] = $full_name;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    // Validation Process
    if(empty($full_name)){
        $errors['full_name'] = "Full Name is required";
    }

    if(empty($email)){
        $errors['email'] = "Email is required";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email Address is invalid";
    }

    if(empty($username)){
        $errors['username'] = "Username is required";
    }
    
    if(empty($password)){
        $errors['password'] = "Password is required";
    }

    if($password !== $password2){
        $errors['password'] = "The two passwords do not match";
    }

    $sql = "SELECT * FROM users WHERE email=:em LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":em", $email);
    $stmt->execute();

    $result = $stmt->fetch();
    if($result){
        $errors['email'] = "Email already exists";
    }

    if(empty($errors)){
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users SET full_name=:fn, email=:em, username=:un, password=:pw";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":fn", $full_name);
        $stmt->bindParam(":em", $email);
        $stmt->bindParam(":un", $username);
        $stmt->bindParam(":pw", $password);

        if($stmt->execute()){
            $_SESSION['username'] = $full_name;
            header("Location: dashboard.php");
        } else{
            echo "Not Successful";
        }
    }

}



// LOGIN VALIDATIONS
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        $errors['username'] = "Username is required";
    }

    if(empty($errors)){

        $sql = "SELECT * FROM users WHERE username=:un OR email=:un";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":un", $username);
        $stmt->execute();

        $query = $stmt->fetch();
        
        $pw = password_verify($password, $query['password']);
        
        if($pw){
            $_SESSION['username'] = $query['full_name'];
            header("Location: dashboard.php");
        } else{
            $errors['message'] = "Wrong email and password combination";
        }
    }
}

// REGISTER NEW COURSE
if(isset($_POST['register'])){
    $course = trim($_POST['course']);
    $year = trim($_POST['year']);
    $department = trim(ucwords($_POST['department']));
    $level = trim($_POST['level']);
    $semester = trim($_POST['semester']);

    if(empty($course)){
        $errors['course'] = "Course Name is required";
    }

    if(empty($year)){
        $errors['year'] = "Academic year is required";
    }

    if(empty($department)){
        $errors['department'] = "Department is required";
    }

    if(empty($level)){
        $errors['level'] = "Level is required";
    }

    if(empty($semester)){
        $errors['semester'] = "Semester is required";
    }

    if(empty($errors)){

        $sql = "INSERT INTO courses SET course=:c, years=:y, department=:d, levels=:l, semester=:s";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":c", $course);
        $stmt->bindParam(":y", $year);
        $stmt->bindParam(":d", $department);
        $stmt->bindParam(":l", $level);
        $stmt->bindParam(":s", $semester);

        if($stmt->execute()){
            header("Location: dashboard.php");
        } else{
            echo "Not Successful";
        }
    }
    
}


// This displays all the data in the database to the dashboard.php page
$detailsSql = "SELECT * FROM courses";
$stmts = $conn->prepare($detailsSql);
$stmts->execute();

$num = $stmts->rowCount();
$courseDetails = $stmts->fetchAll(PDO::FETCH_ASSOC);