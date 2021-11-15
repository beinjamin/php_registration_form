<?php
session_start();
require_once 'config.php';


if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $check = $bdd->prepare('SELECT pseudo, email ,password FROM utilisateurs WHERE email = ?');
} else header('Location:index.php');
