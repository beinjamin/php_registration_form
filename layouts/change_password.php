<?php
// Démarrage de la session 
session_start();
// Include de la base de données
require_once '../config.php';


// Si la session n'existe pas 
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
    die();
}


// Si les variables existent 
if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_retype'])) {
    // XSS 
    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $new_password_retype = htmlspecialchars($_POST['new_password_retype']);

    // On récupère les infos de l'utilisateur
    $check_password  = $bdd->prepare('SELECT password FROM utilisateurs WHERE token = :token');
    $check_password->execute(array(
        "token" => $_SESSION['user']
    ));
    $data_password = $check_password->fetch();

    // Si le mot de passe est le bon
    if (password_verify($current_password, $data_password['password'])) {
        // Si le mot de passe tapé est bon
        if ($new_password === $new_password_retype) {

            // On chiffre le mot de passe
            $cost = ['cost' => 12];
            $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
            // On met à jour la table utiisateurs
            $update = $bdd->prepare('UPDATE utilisateurs SET password = :password WHERE token = :token');
            $update->execute(array(
                "password" => $new_password,
                "token" => $_SESSION['user']
            ));
            // On redirige
            header('Location: ../landing.php?err=success_password');
            die();
        }
    } else {
        header('Location: ../landing.php?err=current_password');
        die();
    }
} else {
    header('Location: ../landing.php');
    die();
}
