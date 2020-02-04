<?php

// Définition du role qui est attribut à chaque route (liste)
// On liste les routes où il faut un controle []
// Pour chaque route on donne la liste des role qui peuvent y accéder

$controlList = [
    'main-home' => ['admin', 'catalog-manager'],
    'category-list' => ['admin', 'catalog-manager'],
    'category-add' => ['admin', 'catalog-manager'],
    'category-addpost' => ['admin', 'catalog-manager'],
    'category-update' => ['admin', 'catalog-manager', 'catalog-manager'],
    'category-updatepost' => ['admin', 'catalog-manager'],
    'category-delete' => ['admin', 'catalog-manager'],
    'product-add' => ['admin', 'catalog-manager'],
    'product-addpost' => ['admin', 'catalog-manager'],
    'product-list' => ['admin', 'catalog-manager'],
    'product-update' => ['admin', 'catalog-manager'],
    'product-updatepost' => ['admin', 'catalog-manager'],
    'product-delete' => ['admin', 'catalog-manager'],
    'user-list' => ['admin'],
    'user-add' => ['admin'],
    'user-addpost' => ['admin'],
    'user-delete' => ['admin'],
    'user-update' => ['admin'],
    'user-updatepost' => ['admin']       
];