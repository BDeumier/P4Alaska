<?php $title = 'Le blog de l\'exilé';
//session_start();
?>

<?php ob_start(); ?>
<p>Derniers billets du blog :</p>
<div class="news">
    <?php
        while($data = $posts->fetch())
        {
    ?>
            <h3><?= htmlspecialchars($data['title']); ?></h3>
            <p>
                <?= htmlspecialchars($data['content']); ?><br />
                <strong>Posté le <?= htmlspecialchars($data['post_date']); ?></strong>
                <a href="index.php?action=post&id=<?= htmlspecialchars($data['id']); ?>">Commentaires</a>
            </p>
    <?php
        }        

        $posts->closeCursor();
    ?>
        <p>Pages : </p>
    <?php
        /*for ($i = 1; $i <= $nombre_pages; $i++)
        {
            var_dump($i);
        }*/
    ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>
