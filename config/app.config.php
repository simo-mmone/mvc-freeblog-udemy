<?php

use \App\Controllers\PostController;

return [
    'routes' => [
        'GET' => [
            '/' => [PostController::class, 'getPosts'],
            'posts' => [PostController::class, 'getPosts'],
            'posts/create' => [PostController::class, 'create'],
            'posts/:id' => [PostController::class, 'show'],
            'posts/:id/edit' => [PostController::class, 'edit']
        ],
        'POST' => [
            'posts/save' => [PostController::class, 'save'],
            'posts/:id' => [PostController::class, 'save'],
            'posts/:id/delete' => [PostController::class, 'delete'],
            'posts/:id/comments' => [PostController::class, 'saveComment']
        ],
    ]
];