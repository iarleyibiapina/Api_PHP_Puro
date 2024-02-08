<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->safeLoad();
$dotenv->load();

header("Location: public/");
