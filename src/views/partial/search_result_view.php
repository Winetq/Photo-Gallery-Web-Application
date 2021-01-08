<?php foreach ($results as $image): ?>
        Tytuł: <?= $image['title'] ?> <br/>
        <?php $path = 'images/' . pathinfo($image['photo']['name'], PATHINFO_FILENAME) . '.min.' . pathinfo($image['photo']['name'], PATHINFO_EXTENSION); ?>
        <img src="<?= $path ?>" alt="alt_photo"/> <br/>
<?php endforeach?>
