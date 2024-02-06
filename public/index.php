<?php

require_once('../vendor/autoload.php');

date_default_timezone_set("America/Fortaleza");

// definindo o dado esperado
header("Content-type: application/json");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type");

// echo "hello";


use src\Core\Router;

new Router();
