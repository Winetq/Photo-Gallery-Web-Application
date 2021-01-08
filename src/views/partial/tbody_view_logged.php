<?php if (count($products)): ?>
    <?php
        $page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $pageSize = 3;
        $opts = [
            'skip' => ($page - 1) * $pageSize,
            'limit' => $pageSize
        ];
        
        $results = get_db()->products->find([],$opts);
        
    foreach ($results as $product):
    ?>
        <?php if ($product['private'] == false): ?>
        <tr>
            <td>
                <a href="view?id=<?= $product['_id'] ?>"><?= $product['title'] ?></a>
            </td>
            <td><?= $product['author'] ?></td>
            <td>
            <?php
                $path = 'images/' . pathinfo($product['photo']['name'], PATHINFO_FILENAME) . '.min.' . pathinfo($product['photo']['name'], PATHINFO_EXTENSION);
            ?>
                <a href="wmk?id=<?= $product['_id'] ?>" target="_blank"><img src="<?= $path ?>" alt="alt_photo"/></a>
                <?= "<br/>" ?>
                <a href="delete?id=<?= $product['_id'] ?>">Usuń</a> | Wybierz: 
                <?php 
                if (is_checked($product['_id'])): 
                ?>
                <input type="checkbox" name="box[]" value="<?= $product['_id'] ?>" checked> 
                <?php else: ?>
                <input type="checkbox" name="box[]" value="<?= $product['_id'] ?>">
                <?php endif ?> 
            </td>
        </tr>
        <?php else: ?>
            <?php if ($product['id_user'] == $_SESSION['user_id']): ?>
                <tr>
                    <td>
                        <a href="view?id=<?= $product['_id'] ?>"><?= $product['title'] ?></a>
                    </td>
                    <td><?= $product['author'] ?></td>
                    <td>
                    <?php
                        $path = 'images/' . pathinfo($product['photo']['name'], PATHINFO_FILENAME) . '.min.' . pathinfo($product['photo']['name'], PATHINFO_EXTENSION);
                    ?>
                        <a href="wmk?id=<?= $product['_id'] ?>" target="_blank"><img src="<?= $path ?>" alt="alt_photo"/></a>
                        <?= "<br/>" ?>
                        <a href="delete?id=<?= $product['_id'] ?>">Usuń</a> | Wybierz: 
                        <?php 
                        if (is_checked($product['_id'])): 
                        ?>
                        <input type="checkbox" name="box[]" value="<?= $product['_id'] ?>" checked> 
                        <?php else: ?>
                        <input type="checkbox" name="box[]" value="<?= $product['_id'] ?>">
                        <?php endif ?> | PRYWATNE
                    </td>
                </tr>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
<?php else: ?>
    <tr>
        <td colspan="3">Brak produktów</td>
    </tr>
<?php endif ?>
    