<?php session_start();

if(isset($_POST['reset']))
{
    if(isset($_SESSION['id']) && $_SESSION['id'] == true)

    {
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        reset_if_loggedIn($password, $password2);
    } 
}

if(isset($_POST['reset1'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    reset_if_not_loggedIn($email, $password);
}

// This works if the user isn't logged in
function reset_if_not_loggedIn($em, $pw){

    validateEmail($em);
    validatePassword1($pw);

    if(empty($_SESSION['email_err']) && empty($_SESSION['pass_err']))
    {
        $pw = hash("sha512", $pw); // This encrypts the password.

        $users = scandir("./db/users/");
        $countUsers = count($users);

        // This counts the number of items in the file
        for($i=0; $i < $countUsers; $i++){
            
            // This shows the current user
            $currentUser = $users[$i];

            // This checks to see if the users match with that from the input
            if($currentUser == $em . ".json"){
                $get = file_get_contents("./db/users/" . $currentUser );//This gets the details of the current user.
                $userObject = json_decode($get, true);

                $array_data = [
                    "id" => $userObject['id'],
                    "full_name" => $userObject['full_name'],
                    "email" => $em,
                    "phone" => $userObject['phone'],
                    "password" => $pw
                ];

                file_put_contents('./db/users/' . $array_data['email'] . ".json" , json_encode($array_data));
                header('Location: login.php');
            }
        }
    }
}

// This works if the user is logged in.
function reset_if_loggedIn($pw, $pw1){
    validatePassword1($pw, $pw1);

    if(empty($_SESSION['pass_err'])){
        
        $pw = hash("sha512", $pw); // This encrypts the password.

        $users = scandir("./db/users/");
        $countUsers = count($users);

        // This counts the number of items in the file
        for($i=0; $i < $countUsers; $i++){
            
            // This shows the current user
            $currentUser = $users[$i];

            // This checks to see if the users match with that from the input
            if($currentUser == $_SESSION['id'] . ".json"){
                $get = file_get_contents("./db/users/" . $currentUser );//This gets the details of the current user.
                $userObject = json_decode($get, true);

                $array_data = [
                    "id" => $userObject['id'],
                    "full_name" => $userObject['full_name'],
                    "email" => $_SESSION['id'],
                    "phone" => $userObject['phone'],
                    "password" => $pw
                ];

                file_put_contents('./db/users/' . $array_data['email'] . ".json" , json_encode($array_data));
                header('Location: dashboard.php');
            }
        }
    }
}

// This validates the passwords if the user is logged in
function validatePassword($pw, $pw1){
    if(empty($pw) || empty($pw1)){
        $_SESSION['pass_err'] = "Password cannot be blank";
        header('Location: dash-reset.php');
    }elseif($pw != $pw1){
        $_SESSION['pass_err'] = "Passwords do not match";
        header('Location: dash-reset.php');
    }
}

// This validates the password if the user isn't logged in
function validatePassword1($pw){
    if(empty($pw)){
        $_SESSION['pass_err'] = "Password cannot be blank";
        header('Location: reset.php');
    }
}

function validateEmail($email){
    if(empty($email)){
        $_SESSION['email_err'] = "Email can't be blank";
        header('Location: register.php');
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['email_err'] = "Please use the correct email format";
        header('Location: register.php');
    }
}