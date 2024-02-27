<?php
session_start();
require "connection.php";
$email = $_POST['email'];
$password = $_POST['password'];
$remember = $_POST['remember'];

if (empty($email)) {
    echo "Please enter your email";
} else if (empty($password)) {
    echo "Please enter your password";
} else {
    $result=Database::search("SELECT * FROM hotel WHERE username='" . $email . "' AND password='" . $password . "'");

    if ($data = $result->fetch_assoc()) {

        if ($remember) {
            setcookie("email", $email, time() + (3600 * 24 * 365));
            setcookie("password", $password, time() + (3600 * 24 * 365));
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
        $_SESSION['hotel'] = $data;
        echo "Success";
    } else {
        echo "Invalid username or password";
    }
}
