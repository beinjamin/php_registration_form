<?php
session_start();
require_once 'config.php';


if (isset($_POST['email']) && isset($_POST['password'])) {
} else header('Location:index.php');
