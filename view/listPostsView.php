<?php $title = 'Billet simple pour l\'Alaska';?>

<?php ob_start(); ?>
<div class="row justify-content-around" id="news">
    <div class="col-lg-7">
        <?php
            while($data = $posts->fetch())
            {
        ?>
                <div class="textbox">
                    <h3><?= $data['title'] ?></h3>
                    <div class ="postContent">
                        <?= $data['content'] ?>
                    </div>
                    <div class="date">
                        <p>Posté le <?= htmlspecialchars($data['post_date']); ?>
                        <a href="index.php?action=post&id=<?= htmlspecialchars($data['id']); ?>">Voir le billet</a></p>
                    </div>
                </div>
        <?php
        }        
        $posts->closeCursor();
        ?>
        <p>Pages : </p>
        <?php
        /*$nombre_pages = $data
        for ($i = 1; $i <= $nombre_pages; $i++)
        {
            var_dump($i);
        }*/
        ?>
    </div>
    <div class="col-lg-2">
        <div class="textbox" id="aside">
            <h3>A propos de l'auteur</h3>
            <p>Jean Rochefort est un romancier français né en 1976 à Paris. Auteur de "Une nuit au paradis" ainsi que de "Bonjour mon vieil ami", il se lance dans le numérique avec une aventure en Alaska disponible en ligne.</p>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>
