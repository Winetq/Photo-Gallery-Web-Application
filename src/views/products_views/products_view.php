<!DOCTYPE html>
<html>
<head>
    <title>Produkty</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<?php 
    if (isset($_SESSION['user_id'])) { // uzytkownik zalogowany
        $user = get_user_by_id($_SESSION['user_id']);
        
        echo "Witamy <b>" . $user['login'] . "</b>!";
        echo "<br/>";
        echo '<a href="logout">Wyloguj się!</a>';
        
    } else { // uzytkownik niezalogowany
        include '../views/partial/nav_std_view.php';
    }
?>

<form action="cart/add" method="post">

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
            if (isset($_SESSION['user_id'])) {
                include '../views/partial/tbody_view_logged.php';
            } else {
                include '../views/partial/tbody_view.php';
            }
        ?>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="2">Łącznie: <?= count($products) ?></td>
        <td>
            <a href="edit">dodaj zdjęcie</a>
        </td>
    </tr>
    </tfoot>
</table>

<?php include '../views/partial/paging_numbers_view.php' ?>

<input type="submit" value="Zapamiętaj wybrane!" style="width: 140px; margin: 5px 0px;"/>

</form>

<a href="show_cart">Pokaż wybrane!</a>
<br/>
<a href="search">Wyszukiwarka zdjęć!</a>

<?php dispatch($routing, '/cart') ?>

</body>
</html>
