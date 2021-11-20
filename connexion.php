<?php
session_start();
require_once 'config.php';


if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $check = $bdd->prepare('SELECT pseudo, email ,password FROM utilisateurs WHERE email = ?');
    $check->execute(array($email,));
    $data = $check->fetch();


    if ($row == 1) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        } else header("Location:index.php?login_err=email");
    } else header('Location:index.php?login_err=already');
} else header('Location:index.php');
