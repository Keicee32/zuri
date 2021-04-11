<?php session_start();

$full_name = $email = $phone = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Session variables
    $_SESSION['fullName'] = $full_name;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    register($full_name, $email, $phone, $password);
    

}

// This function gets the user details, validates them and stores them in the file database
function register($fn, $em, $ph, $pw){
    validateName($fn);
    validateEmail($em);
    validatePhone($ph);

    if(empty($_SESSION['full_name']) && empty($_SESSION['email_err']) && empty($_SESSION['phone_err']))
    {
        $pw = hash("sha512", $pw); // This is used to harsh the password

        // This creates a directory of db and a sub-directory of users if it doesn't exist
        $path = './db/users/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }


        // This scans the directory and assigns id to new users
        $users = scandir($path);
        $countUsers = count($users);
        $id_AI = $countUsers - 1; // $id_AI means id auto-increment
        

        // This puts all the form details in an associative array
        $array_data = [
            'id' => $id_AI,
            'full_name' => $fn,
            'email' => $em,
            'phone' => $ph,
            'password' => $pw
        ];

        // var_dump($array_data);
        // exit;

        $put = file_put_contents($path . $array_data['email'] . ".json", json_encode($array_data));

        if($put)
        {
            $_SESSION['id'] = $array_data['email'];
            header('Location: dashboard.php');
        }
    }
}

// This validates the full name
function validateName($name){
    if(empty($name)){
        $_SESSION['full_name'] = "Full name can't be blank";
        header('Location: register.php');
    }elseif(!preg_match("/^[a-zA-Z_ -]/", $name)){
        $_SESSION['full_name'] = "Use letters and whitespaces only";
        header('Location: register.php');
    }
}

// This validates the email
function validateEmail($email){
    if(empty($email)){
        $_SESSION['email_err'] = "Email can't be blank";
        header('Location: register.php');
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['email_err'] = "Please use the correct email format";
        header('Location: register.php');
    }
}

// This validates the phone number
function validatePhone($phone){
    if(empty($phone)){
        $_SESSION['phone_err'] = "Phone number can't be blank";
        header('Location: register.php');
    }elseif(!preg_match("/^[0-9]/", $phone)){
        $_SESSION['phone_err'] = "Use numbers only";
        header('Location: register.php');
    }
}