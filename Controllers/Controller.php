<?php

namespace Controllers;

use Classes\Request;

class Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }
}