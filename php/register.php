<?php



if (empty($_POST['name'])){
    die("Name is Required");
}


if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Email is Required");
}

if (strlen($_POST["password"]) < 8) { 
    die("Password must be atleast 8 characters");
}


if (! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must contain atleast one letter");
}

if (! preg_match("/[0-9]/", $_POST["password"])){
    die("Password must contain atleast one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]){
    die("Passwords do not match");
} 

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO userdata (username, email, password_hash)
        VALUES(?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (! $stmt -> prepare($sql)){
    die("duplicate entry");
}

$stmt -> bind_param("sss", 
                    $_POST['name'],
                    $_POST['email'],
                    $password_hash);

if ($stmt -> execute()) {
    echo 'success' ;
    exit;
} else {
    die("duplicate entry");
}







?>