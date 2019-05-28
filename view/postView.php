<?php $title = 'Le blog de l\'exilé'; ?>

<?php ob_start(); ?>
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
        <button>Report</button> <!-- ou autre, pour renvoyer vers l'action report -->
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

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>
<?php include("old\\footer.php"); ?>