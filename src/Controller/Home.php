<?php

use src\Core\Controller;


class Home extends Controller
{
    public function index()
    {
        echo json_encode([
            'welcome' => 'this is the homepage'
        ]);
    }
}
