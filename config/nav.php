<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard',
        'title' => 'Dashboard',
    ],
    [
        'icon' => 'nav-icon fas fa-layer-group',
        'route' => 'categories.index',
        'title' => 'Categories',
        'badege' => 'New',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'nav-icon fas fa-box-open',
        'route' => 'products.index',
        'title' => 'products',
        'ability' => 'products.view',
    ]
];
