<?php




try {
    $bdd = new PDO('mysql:host=localhost;dbname=jaures;charset=utf8', 'root', 'root1234');
} catch (Exception $e) {
    die('Erreur' . $e->getMessage());
}
