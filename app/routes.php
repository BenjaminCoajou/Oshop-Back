<?php

// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);

// Connexion ----------------
$router->map(
    'GET',
    '/user/login/',
    [
        'method' => 'login',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-login'
);

$router->map(
    'POST',
    '/user/login/',
    [
        'method' => 'loginPost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-loginpost'
);

// Catégorie ------------------

$router->map(
    'GET',
    '/category/list/',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-list'
);

$router->map(
    'GET',
    '/category/add/',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-add'
);

$router->map(
    'POST',
    '/category/add/',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-addpost'
);

$router->map(
    'GET',
    '/category/[i:categoryId]/update/',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-update'
);

$router->map(
    'POST',
    '/category/update/',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-updatepost'
);

$router->map(
    'GET',
    '/category/[i:categoryId]/delete/',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-delete'
);

// Product ------------------
$router->map(
    'GET',
    '/product/add/',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-add'
);

$router->map(
    'POST',
    '/product/add/',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-addpost'
);

$router->map(
    'GET',
    '/product/list/',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-list'
);

$router->map(
    'GET',
    '/product/[i:productId]/update/',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-update'
);

$router->map(
    'POST',
    '/product/update/',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-updatepost'
);

$router->map(
    'GET',
    '/product/[i:productId]/delete/',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-delete'
);

// Déconnexion -----------------
$router->map(
    'GET',
    '/user/logout/',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-logout'
);

// Utilisateurs -------------
$router->map(
    'GET',
    '/user/list/',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-list'
);

$router->map(
    'GET',
    '/user/add/',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-add'
);

$router->map(
    'POST',
    '/user/add/',
    [
        'method' => 'addPost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-addpost'
);

$router->map(
    'GET',
    '/user/[i:userId]/delete/',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-delete'
);

$router->map(
    'GET',
    '/user/[i:userId]/update/',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-update'
);

$router->map(
    'POST',
    '/user/update/',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-updatepost'
);

// Catégorie de l'acceuil -------- 

$router->map(
    'GET',
    '/home-categories/',
    [
        'method' => 'homeCategories',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home-categories'
);

$router->map(
    'POST',
    '/home-categories/',
    [
        'method' => 'homeCategoriesPost',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home-categoriespost'
);