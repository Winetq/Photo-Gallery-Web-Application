<!DOCTYPE html>
<html>
<head>
    <title>WMK</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<?php
    $path_wmk = 'images/' . pathinfo($product['photo']['name'], PATHINFO_FILENAME) . '.wmk.' . pathinfo($product['photo']['name'], PATHINFO_EXTENSION);
?>
    
    <img src="<?= $path_wmk ?>" alt="alt_photo"/>

</body>
</html>
