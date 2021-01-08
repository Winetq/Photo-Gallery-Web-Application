<?php
require_once 'business.php';

function check_file($photo_file)
{
    // i tutaj sprawdzamy czy png czy jpg i czy 1MB
    
    $OK = true;
    
    $ext = strtolower(pathinfo($photo_file['name'], PATHINFO_EXTENSION));

    if ($ext == 'jpg' || $ext == 'png') {
        $OK = true;
    } else {
        $OK = false;
        echo "Akceptowane tylko rozszerzenie png lub jpg!!!";
    }
    
    if ($photo_file['size'] > 1024*1024) {
        $OK = false;
        echo "Maksymalny rozmiar pliku to 1MB!!!";
    }
    
    return $OK;
}

function upload_file($photo_file, $wmk) // wmk = watermark 
{
    // i tutaj zapisujemy $photo_file do folderu images 
    $path1 = '../web/images/' . $photo_file['name'];
    
    move_uploaded_file($photo_file['tmp_name'], $path1); // zdjecie oryginalne
    
    // tworzymy miniaturke
    $path2 = 'images/' . pathinfo($photo_file['name'], PATHINFO_FILENAME) .
        '.min.' . pathinfo($photo_file['name'], PATHINFO_EXTENSION);
    
    $ext = strtolower(pathinfo($photo_file['name'], PATHINFO_EXTENSION));

    $im1;
    if ($ext == 'png') {
        $im1 = imagecreatefrompng($path1);
    } else {
        $im1 = imagecreatefromjpeg($path1);
    }
    
    list($width, $height) = getimagesize($path1);
    $new_width = 200;
    $new_height = 125;
    
    $dst = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($dst, $im1, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    if ($ext == 'png') {
        imagepng($dst, $path2); // zdjecie miniturka
    } else {
        imagejpeg($dst, $path2); // zdjecie miniaturka
    }
    
    imagedestroy($im1);
    imagedestroy($dst);
    
    // tworzymy zdjecie ze znakiem wodnym
    $path3 = 'images/' . pathinfo($photo_file['name'], PATHINFO_FILENAME) .
        '.wmk.' . pathinfo($photo_file['name'], PATHINFO_EXTENSION);
    
    $im2;
    if ($ext == 'png') {
        $im2 = imagecreatefrompng($path1);
    } else {
        $im2 = imagecreatefromjpeg($path1);
    }
    
    $l = strlen($wmk);
    imagestring($im2, 5, ($width / 2) - ($l * 4), $height / 2, $wmk, imagecolorallocate($im2, 0, 255, 204));
    
    if ($ext == 'png') {
        imagepng($im2, $path3); // zdjecie ze znakiem wodnym
    } else {
        imagejpeg($im2, $path3); // zdjecie ze znakiem wodnym
    }
    
    imagedestroy($im2);
}

function check_data($login, $password1, $password2)
{
    $OK = true; // flaga
    
    // sprawdzenie loginu
    if (strlen($login) < 3 || strlen($login) > 20)
    {
        $OK = false;
        echo "Login musi posiadac od 3 do 20 znakow!<br/>";
    } 
    
    if (!ctype_alnum($login))
    {
        $OK = false;
        echo "Login moze skladac sie tylko z liter i cyfr (bez polskich znakow)!<br/>";
    }
    
    if (check_login($login))
    {
        $OK = false;
        echo "Taki login juz istnieje!<br/>";
    }
    
    // sprawdzenie hasla
    if (strlen($password1) < 8 || strlen($password1) > 20)
    {
        $OK = false;
        echo "Haslo musi posiadac od 8 do 20 znakow!<br/>";
    }
    
    if ($password1 != $password2)
    {
        $OK = false;
        echo "Podane hasla nie sa identyczne!<br/>";
    }
    
    return $OK;
}

function check_login($login)
{
    $users = get_users();
    
    foreach ($users as $user) {
        if ($user['login'] == $login)
            return true;
    }
    
    return false; // brak powtorzenia
}

function is_checked($id)
{
    $cart = &get_cart();
    foreach ($cart as $element) {
        if ($element['id'] == $id)
            return true;
    }
    
    return false;
}
