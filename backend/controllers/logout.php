<?php

session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../?page=");
    exit();
} else
    header("Location: ../../?page=");
