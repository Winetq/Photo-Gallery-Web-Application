<!DOCTYPE html>
<html>
<head>
    <title>Koszyk</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<form action="cart/delete" method="post">

<table>
    <thead>
    <tr>
        <th>Tytuł</th>
        <th>Autor</th>
        <th>Zdjęcie</th>
    </tr>
    </thead>
    
    <tbody>
        <?php
            $cart = &get_cart();
            if (count($cart)): 
        ?>
            <?php
                foreach ($cart as $element): 
                $product = get_product($element['id']);
            ?>
            <tr>
                <td><?= $product['title'] ?></td>
                <td><?= $product['author'] ?></td>
                <td>
                <?php
                    $path = 'images/' . pathinfo($product['photo']['name'], PATHINFO_FILENAME) . '.min.' . pathinfo($product['photo']['name'], PATHINFO_EXTENSION);
                ?>
                    <img src="<?= $path ?>" alt="alt_photo"/>
                    <?= "<br/>" ?>
                    Wybierz: <input type="checkbox" name="delete_box[]" value="<?= $product['_id'] ?>">
                </td>
            </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Brak produktów</td>
            </tr>
        <?php endif ?>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="3">Łącznie: <?= count($cart) ?></td>
    </tr>
    </tfoot>
</table>

<input type="submit" value="Usuń zaznaczone z zapamiętanych!" style="width: 225px; margin: 5px 0px;"/>

</form>

<a href="products" class="cancel">&laquo; Wróć</a>

</body>
</html>
