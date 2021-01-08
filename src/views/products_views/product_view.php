<!DOCTYPE html>
<html>
<head>
    <title>Produkt</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<h1><?= $product['title'] ?></h1>

<p>Autor: <?= $product['author'] ?></p>

<?php
    $path = 'images/' . pathinfo($product['photo']['name'], PATHINFO_FILENAME) . '.min.' . pathinfo($product['photo']['name'], PATHINFO_EXTENSION);
?>

<p class="description"><img src="<?= $path ?>" alt="alt_photo"/></p>

<a href="products" class="cancel">&laquo; Wróć</a>

</body>
</html>
