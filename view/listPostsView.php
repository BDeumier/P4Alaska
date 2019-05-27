<?php $title = 'Le blog de l\'exilé'; ?>

<?php include("old\header.php"); ?>

<?php ob_start(); ?>
<p>Derniers billets du blog :</p>
<div class="news">
    <?php
        while($data = $posts->fetch())
        {
    ?>
            <h3><?= htmlspecialchars($data['title']); ?>, posté le <?= htmlspecialchars($data['post_date']); ?></h3>
            <p>
                <?= htmlspecialchars($data['content']); ?><br />
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

<?php include("old\\footer.php"); ?>
