
<?php $title = 'Le blog de l\'exilé';
//session_start();
?>

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

<?php
    if (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 1)
    {
?>
        <div id="admin">
            <a href="index.php?action=goeditPost&amp;id=<?= $post['id'] ?>">Modifier le billet</a>
            <a href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>">Supprimer le billet</a><br/>
        </div>
<?php
    }
?>

<h2>Commentaires</h2>
<div class="commentaires">

<?php
    while ($comment = $comments->fetch())
    {
?>
        <div <?php if ($comment['reported'] == 1 && isset($_SESSION['group_id']) && $_SESSION['group_id'] == 1) {?>class="reported"<?php }?>> <!-- à tester, correct? -->
            <h3><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></h3>
            <p><?= htmlspecialchars($comment['comment']) ?></p>
            <div class="commentActions">
                <a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>">Signaler</a>
                <?php
                    if (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 1)
                    {
                ?>
                        <div id="admin">
                            <a href="index.php?action=goeditComment&amp;id=<?= $comment['id'] ?>">Modérer</a>
                            <a href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>">Supprimer</a><br/>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    <?php
    }

    if (isset($_SESSION['nickname']))
    {
    ?>
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                    <label for="comment">Commentaire</label><br />
                    <textarea id="comment" name="comment"></textarea>
                    <input type="submit" name="Envoyer" />
            </form>
    <?php
    }
    ?>
    </body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>