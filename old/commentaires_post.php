<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=blogP4;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
    	die('Erreur : ' . $e->getMessage());
    }

    $commentaire = $_POST['message'];
    $auteur = $_POST['pseudo'];
    $idBillet = $_GET['idBillet'];

    $req = $bdd->prepare('INSERT INTO cours3_commentaires(id_billet, auteur, commentaire, date_commentaire)
    VALUES (:idBillet, :auteur, :commentaire, NOW())');
    $req->execute(array(
        'idBillet' => $idBillet,
        'auteur' => $auteur,
        'commentaire' => $commentaire
    ));
header('Location: index.php');
?>