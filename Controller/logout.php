<?php

if (isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
    unset($_SESSION['userType']);
    header("Location: /");
    exit;
}
