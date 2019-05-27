<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Le blog de l'exilé</title>
        <link rel="stylesheet" href="public\css\style.css" /> 
    </head>
        
    <body>
        <?php include("old\header.php"); ?>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['post_date'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>

        <h2>Commentaires</h2>
        <div class="commentaires">

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <h3><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></h3>
            <p><?= htmlspecialchars($comment['comment']) ?></p>
        <?php
        }
        ?>
        </div>

        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" name="Envoyer" />
            </div>
    </body>
</html>