<?php
require "connection.php";

$email_rg = $_POST['email_rg'];
$password1_rg = $_POST['password1_rg'];
$password2_rg = $_POST['password2_rg'];


if (empty($email_rg)) {
    echo "Please enter your email";
} else if (empty($password1_rg)) {
    echo "Please enter your email";
} else if ($password1_rg !== $password2_rg) {
    echo "Passwords doesn't matched";
} else {
    $result = Database::search("SELECT * FROM `user` WHERE email='" . $email_rg . "'");
    if ($result->fetch_assoc()) {
        echo "user already registered";
    } else {
        Database::iud("INSERT INTO user(email,password) VALUE('" . $email_rg . "','" . $password1_rg . "')");
        echo "Success";
    }
}
