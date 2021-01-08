<?php
require '../../vendor/autoload.php';

require_once '../dispatcher.php';
require_once '../routing.php';
require_once '../products_controllers.php';
require_once '../users_controllers.php';

//aspekty globalne
session_start();

//wybór kontrolera do wywołania:
$action_url = $_GET['action'];
dispatch($routing, $action_url);
