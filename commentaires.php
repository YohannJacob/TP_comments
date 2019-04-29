<?php
// Appel vers la base de donnée
    try
    {
       $bdd = new PDO('mysql:host=localhost;dbname=Test;charset=utf8', 'root', 'root');
    }
    // Gérer les erreurs
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    // Aller chercher les données dans la table
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
    $req->execute(array($_GET['billet']));
    $donnees = $req->fetch();

    $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
    $req->execute(array($_GET['billet']));
    //var_dump($_POST)
?>


<!-- ici on commence le HTML -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

    <head>
        <title>Mon super blog - billet </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>

    <h1>Bonjour, bienvenue sur mon super blog.</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3> <?= htmlspecialchars($donnees['titre']) ?> </h3>
            <p> <?= htmlspecialchars($donnees['contenu']) ?> </p>
        </div>

        <h2> Commentaires</h2>
        <?php while ($donnees = $req->fetch()){ ?>
            <p><strong> <?= htmlspecialchars($donnees['auteur']) ?> </strong> le <?= htmlspecialchars($donnees['date_commentaire_fr']) ?> </p>
            <p> <?= htmlspecialchars($donnees['commentaire']) ?> </p>   
        <?php } ?>    
   </body>