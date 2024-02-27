<?php

session_start();

if (isset($_SESSION["hotel"])) {

    $_SESSION["hotel"] = null;

    session_destroy();

    echo "Success";
}
