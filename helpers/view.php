<?php

function view($view, $data = [])
{

    extract($data);

    require_once __DIR__ . "/../views/{$view}.php";
}

function redirect($path)
{
    header("Location: {$path}");
}