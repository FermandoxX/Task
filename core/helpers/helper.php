<?php

use Core\Model;

function app() {
    global $app;
    return $app;
}

function dd(...$args) {
    foreach ($args as $arg) {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
    die();
}

function dp(...$args) {
    foreach ($args as $arg) {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}
