
<?php $title = 'Billet simple pour l\'Alaska';
//session_start();
?>

<?php ob_start(); ?>
<div class="col-lg-12" id="news">
    <h3><?= $post['title'] ?></h3>          
    <p>
        <?= $post['content'] ?><br/>
        <strong>le <?= $post['post_date'] ?></strong>
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

<div class="col-lg-12" id="commentaires">
    <h3>Commentaires</h3>
    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <div <?php if ($comment['reported'] == 1 && isset($_SESSION['group_id']) && $_SESSION['group_id'] == 1) {?>class="reported"<?php }?>>
            <h4><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></h4>
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