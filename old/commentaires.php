<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>TP: un blog avec des commentaires</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <!-- requête pour afficher le billet -->
		<?php
    		try
    		{
    		    $bdd = new PDO('mysql:host=localhost;dbname=blogP4;charset=utf8', 'root', '');
    		}
    		catch (Exception $e)
    		{
    		    die('Erreur : ' . $e->getMessage());
    		}

    		$reponse = $bdd->prepare('SELECT * FROM cours3_billets WHERE id = ?');
    		$reponse->execute(array($_GET['idBillet']));

    		$donnees = $reponse->fetch();

            if(empty($donnees)) //on teste si l'id existe
            {
                echo 'Le numéro du billet n\'existe pas, veuillez retourner au blog.', '<br>';
            }

            else
            {
		?>

        <!-- affichage du billet -->
            <div class="news">  		      
                <h3><?php echo htmlspecialchars($donnees['titre']); ?>, posté le <?php echo htmlspecialchars($donnees['dateCreation']); ?></h3>
    		    <p>
    		        <?php echo htmlspecialchars($donnees['contenu']); ?><br />
    		    </p>
    		</div>
            
		<?php
    		$reponse->closeCursor();
		?>

        <!-- requête pour les commentaires -->
		<?php
    		try
    		{
        		$bdd = new PDO('mysql:host=localhost;dbname=blogP4;charset=utf8', 'root', '');
    		}
    		catch (Exception $e)
    		{
    		    die('Erreur : ' . $e->getMessage());
    		}

    		$reponse = $bdd->prepare('SELECT * FROM cours3_commentaires WHERE id_billet = ? ORDER BY date_commentaire');
    		$reponse->execute(array($_GET['idBillet']));
        ?>
        
        <!-- affichage des commentaires -->
            <h2>Commentaires :</h2>
            
        <?php
   			while($donnees = $reponse->fetch())
    		{
		?>         
            <div class="commentaires">
        		<h3><?php echo htmlspecialchars($donnees['auteur']); ?>, posté le <?php echo htmlspecialchars($donnees['date_commentaire']); ?></h3>
        		<p>
 		    	<?php echo htmlspecialchars($donnees['commentaire']); ?><br />
		        </p>
            </div>
		<?php
		}

 		   $reponse->closeCursor();
		?>

		<form action="commentaires_post.php?idBillet=<?php echo htmlspecialchars($_GET['idBillet']); ?>" method="post">
            <p>
            <textarea name="message" rows="4" cols="40">Votre message</textarea><br />
            <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo"><br />
            <input type="submit" value="Envoyer">
            </p>
        </form>

        <?php
        }
        ?>
	
		<a href="index.php">Retour au blog</a>
	</body>
</html>