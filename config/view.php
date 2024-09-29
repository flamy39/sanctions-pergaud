<?php

function render($view, $data = [])
{
    extract($data);
    ob_start();
    include __DIR__ . "/../templates/{$view}.php";
    return ob_get_clean();
}