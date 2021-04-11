<?php session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    login($email, $password);
}

function login($em, $pw){
    validateEmail($em);
    validatePassword($pw);
    database_exists();

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
                $userObject = json_decode($get, true); // This returns a json file so its readable
                
                // This checks to see if the password of the input && that in the db matches
                //if it does, it redirects the user to the dashboard.
                if($pw == $userObject['password']){
                    $_SESSION['id'] = $userObject['email'];
                    header('Location: dashboard.php');
                }else{
                    $_SESSION['email_err'] = "Incorrect email and Password combination";
                    header('Location: login.php');
                }
            }
        }
    }

}

function validateEmail($email){
    if(empty($email)){
        $_SESSION['email_err'] = "Email can't be blank";
        header('Location: login.php');
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['email_err'] = "Please use the correct email format";
        header('Location: login.php');
    }
}

function validatePassword($pw){
    if(empty($pw)){
        $_SESSION['pass_err'] = "Password cannot be blank";
        header('Location: login.php');
    }
}

// This checks if the path exist
function database_exists(){
    if(!is_dir("./db/users/")){
        $_SESSION['db_not_found'] = "Cannot connect to the Database";
        header('Location: login.php');
    }
}