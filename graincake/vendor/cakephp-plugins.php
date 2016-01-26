<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Help' => $baseDir . '/plugins/Help/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'PhotoGallery' => $baseDir . '/plugins/PhotoGallery/'
    ]
];
