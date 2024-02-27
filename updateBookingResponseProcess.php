<?php
require "connection.php";
$id = $_GET['id'];
$status = $_GET['status'];

Database::iud("UPDATE booking SET status_id='" . $status . "' WHERE booking.id='".$id."'");
echo "Success";
