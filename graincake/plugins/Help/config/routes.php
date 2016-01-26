<?php
use Cake\Routing\Router;

Router::plugin(
    'Help',
    ['path' => '/help'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
