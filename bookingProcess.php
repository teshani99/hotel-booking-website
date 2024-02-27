<?php
session_start();
require "connection.php";

if (isset($_SESSION['user'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $guests = $_POST['guests'];
    $days = $_POST['days'];
    $hotel = $_POST['hotel'];
    $package = $_POST['package'];
    $paymentMethod = $_POST['paymentMethod'];

    if (empty($name)) {
        echo "Please Enter yur name";
    } else
if (empty($email)) {
        echo "Please Enter your email";
    } else
if (empty($contactNo)) {
        echo "Please Enter your contact number";
    } else
if (empty($guests)) {
        echo "Please Enter number of guests";
    } else
if (empty($days)) {
        echo "Please Enter days required to book";
    } else
if ($hotel == 0) {
        echo "Please Select required hotel";
    } else
if ($package == 0) {
        echo "Please Select required package";
    } else
if ($paymentMethod == 0) {
        echo "Please select payment type";
    } else {

        Database::iud("INSERT INTO booking(user_name,email,contact,days,no_of_guests,package_id,payment_id) 
    VALUES('" . $name . "','" . $email . "','" . $contactNo . "','" . $days . "','" . $guests . "','" . $package . "','" . $paymentMethod . "')");

        echo "Booking done successfully";
    }
} else {
    echo "Please Login First";
}
