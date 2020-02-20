<?php
    function views(string $name) {
        return __DIR__.'/../views/'.$name.'.php';
    }

function layout(string $name) {
    return __DIR__.'/../layout/'.$name.'.php';
}
