<?php
    for ($i = 1; $i <= ceil(count($products) / 3); $i++) // pageSize = 3
    {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
        echo '<br/>';
    }
?>