<?php


use MongoDB\BSON\ObjectID;


function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function get_products()
{
    $db = get_db();
    return $db->products->find()->toArray();
}

function get_products_by_category($cat)
{
    $db = get_db();
    $products = $db->products->find(['cat' => $cat]);
    return $products;
}

function get_product($id)
{
    $db = get_db();
    return $db->products->findOne(['_id' => new ObjectID($id)]);
}

function save_product($id, $product)
{
    $db = get_db();

    if ($id == null) {
        $db->products->insertOne($product);
    } else {
        $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
    }

    return true;
}

function delete_product($id)
{
    $db = get_db();
    $db->products->deleteOne(['_id' => new ObjectID($id)]);
}

function search_products_by_phrase($phrase)
{
    $db = get_db();
    $query = [
        '$and' => [
            [ 'private' => false ],
            [ 'title' => ['$regex' => $phrase]],
        ]
    ];

    $results = $db->products->find($query)->toArray();
    return $results;
}

function get_users()
{
    $db = get_db();
    return $db->users->find()->toArray();
}

function get_user_by_id($id)
{
    $db = get_db();
    return $db->users->findOne(['_id' => new ObjectID($id)]);
}

function get_user_by_login($login)
{
    $db = get_db();
    return $db->users->findOne(['login' => $login]);
}

function save_user($id, $user)
{
    $db = get_db();

    if ($id == null) {
        $db->users->insertOne($user);
    } else {
        $db->users->replaceOne(['_id' => new ObjectID($id)], $user);
    }

    return true;
}
