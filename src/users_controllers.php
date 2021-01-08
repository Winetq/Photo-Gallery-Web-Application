<?php
require_once 'business.php';
require_once 'others.php';

function registration(&$model)
{
    $user = [
        'login' => null,
        'email' => null,
        'password1' => null,
        '_id' => null
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['login']) &&
            !empty($_POST['email']) &&
            !empty($_POST['password1']) &&
            !empty($_POST['password2']) &&
            check_data($_POST['login'], $_POST['password1'], $_POST['password2']) /* && ... */
        ) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            
            $password1_hash = password_hash($_POST['password1'], PASSWORD_DEFAULT);

            $user = [
                'login' => $_POST['login'],
                'email' => $_POST['email'],
                'password1' => $password1_hash
            ];

            if (save_user($id, $user)) {
                return 'redirect:products';
            }
        }
    }

    $model['user'] = $user;
    
    return 'users_views/registration_view';
}

function logging(&$model)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['login']) && !empty($_POST['password1'])) {
            $login = $_POST['login'];
            $password = $_POST['password1'];
            
            $user = get_user_by_login($login);
            
            if ($user !== null && password_verify($password, $user['password1'])) {
                // prawidlowy login i haslo
                session_regenerate_id();
                $_SESSION['user_id'] = $user['_id'];
                
                return 'redirect:products';
            } else {
                echo "Nieprawidlowy login lub haslo!<br/>";
            }
        }
    }
    
    return 'users_views/logging_view';
}

function logout(&$model)
{
    session_destroy();
    
    return 'redirect:products';
}
