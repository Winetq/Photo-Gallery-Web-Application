<!DOCTYPE html>
<html>
<head>
    <title>Edycja</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    <label>
        <span>Tytuł:</span>
        <input type="text" name="title" value="<?= $product['title'] ?>" required/>
    </label>
    <label>
        <span>Autor:</span>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php $user = get_user_by_id($_SESSION['user_id']) ?>
            <input type="text" name="author" value="<?= $user['login'] ?>" required> 
        <?php else: ?>
            <input type="text" name="author" value="<?= $product['author'] ?>" required/>
        <?php endif ?> 
    </label>
    <label>
        <span>Zdjęcie:</span>
        <input type="file" name="photo" value="<?= $product['photo'] ?>" required/>
    </label>
    <label>
        <span>Znak wodny:</span>
        <input type="text" name="watermark" value="<?= $product['watermark'] ?>" required/>
    </label>
    <?php if (isset($_SESSION['user_id'])): ?>
    <fieldset>
        <legend> Prawo dostępu: </legend>

        <input type="radio" value="public" name="prawo" checked> publiczne
        <input type="radio" value="private" name="prawo"> prywatne
    </fieldset>
    <?php endif ?>
    
    <input type="hidden" name="id" value="<?= $product['_id'] ?>">

    <div>
        <a href="products" class="cancel">Anuluj</a>
        <input type="submit" value="Zapisz"/>
    </div>
</form>

</body>
</html>
