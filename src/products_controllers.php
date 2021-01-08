<?php
require_once 'business.php';
require_once 'controller_utils.php';
require_once 'others.php';


function products(&$model)
{
    $products = get_products();
    $model['products'] = $products;

    return 'products_views/products_view';
}

function product(&$model)
{
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];

        if ($product = get_product($id)) {
            $model['product'] = $product;
            return 'products_views/product_view';
        }
    }

    http_response_code(404);
    exit;
}

function edit(&$model)
{   
    $product = [
        'title' => null,
        'author' => null,
        'photo' => null,
        'watermark' => null,
        'private' => null,
        'id_user' => null, // id usera dla ktorego dane zdjecie jest prywatne
        '_id' => null
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['title']) &&
            !empty($_POST['author']) &&
            !empty($_FILES['photo']) &&
            !empty($_POST['watermark']) &&
            check_file($_FILES['photo']) /* && ... */
        ) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            
            if (isset($_SESSION['user_id']) && $_POST['prawo'] == "private") {
                $product = [
                    'title' => $_POST['title'],
                    'author' => $_POST['author'],
                    'photo' => $_FILES['photo'],
                    'watermark' => $_POST['watermark'],
                    'private' => true,
                    'id_user' => $_SESSION['user_id']
                ];
            } else {
                $product = [
                    'title' => $_POST['title'],
                    'author' => $_POST['author'],
                    'photo' => $_FILES['photo'],
                    'watermark' => $_POST['watermark'],
                    'private' => false,
                    'id_user' => false
                ];
            }

            if (save_product($id, $product)) {
                upload_file($product['photo'], $product['watermark']);
                return 'redirect:products';
            }
        }
    }

    $model['product'] = $product;

    return 'products_views/edit_view';
}

function delete(&$model)
{
    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            delete_product($id);
            return 'redirect:products';

        } else {
            if ($product = get_product($id)) {
                $model['product'] = $product;
                return 'products_views/delete_view';
            }
        }
    }

    http_response_code(404);
    exit;
}

function show_wmk(&$model)
{
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        
        $product = get_product($id);
        $model['product'] = $product;
        return 'products_views/wmk_view';
    }

    http_response_code(404);
    exit;
}

function search(&$model)
{
    if(isset($_GET['phrase'])) {
        $phrase = $_GET['phrase'];
        $results = search_products_by_phrase($phrase);
        $model['results'] = $results;
        
        return 'partial/search_result_view';
    } else {
        return 'products_views/search_view';
    }
}

function cart(&$model)
{
    $model['cart'] = get_cart();
    return 'partial/cart_view';
}

function add_to_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['box'])) {
            $ile = count($_POST['box']);
            for ($i = 0; $i < $ile; $i++) {
                $product = get_product($_POST['box'][$i]);

                $cart = &get_cart();

                $cart[$_POST['box'][$i]] = ['id' => $_POST['box'][$i], 'title' => $product['title'], 'amount' => 1];
            }
        }
        
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
}

function clear_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['cart'] = [];
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
}

function show_cart()
{
    return 'products_views/show_cart_view';
}

function delete_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete_box'])) {
            $ile = count($_POST['delete_box']);
            for ($i = 0; $i < $ile; $i++) {
                $cart = &get_cart();
                unset($cart[$_POST['delete_box'][$i]]);
            }
        }
        
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
}
