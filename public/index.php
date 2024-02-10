<?php

require_once('../vendor/autoload.php');

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable("c:\\xampp\htdocs\PHP\Api_PHP_3");
$dotenv->load();


date_default_timezone_set("America/Fortaleza");

// definindo o dado esperado
header("Content-type: application/json");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type");


use src\Core\Router;

new Router();
