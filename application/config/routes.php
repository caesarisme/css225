<?php

return [

    // MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],

    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
    ],

    'api/getpost/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'getpost',
    ],

    'api/getpostlist' => [
        'controller' => 'main',
        'action' => 'getpostlist',
    ],


    // AdminController
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],

    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],

    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],

    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],

    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],

    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],
];