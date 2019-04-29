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
    $reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
?>


<!-- ici on commence le HTML -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

    <head>
        <title>Mon super blog</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>

    <h1>Bonjour, bienvenue sur mon super blog.</h1>
    <p>Derniers billets du blog :</p>

    <?php while ($donnees = $reponse->fetch()){ ?>
        <div class="news">
            <h3> <?= htmlspecialchars($donnees['titre']) ?> </h3>
            <p> <?= htmlspecialchars($donnees['contenu']) ?> <br>
            <a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a> </p>   
        </div>
    <?php } ?>

   </body>