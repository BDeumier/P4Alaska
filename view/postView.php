<?php $title = 'Billet simple pour l\'Alaska';?>

<?php ob_start(); ?>
<!--affichage du billet -->
<div class="col-lg-8" id="news">
    <div class="textbox">
        <h3><?= $post['title'] ?></h3>          
        <?= $post['content'] ?>
        <div class="date">
            <p>le <?= $post['post_date'] ?></p>
        </div>

    </div>  
</div>

<!--actions d'administrateur -->
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

<!--commentaires du billet -->
<div class="col-lg-8" id="commentaires">
    <div class="textbox">
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

                <!--actions d'administrateur -->
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
    ?>
    </div>

    <?php
    if (isset($_SESSION['nickname']))
    {
    ?>
        <!--formulaire pour écrire un commentaire -->
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
            <input type="submit" value="Envoyer" />
        </form>
    <?php
    }
    ?>
    </body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>