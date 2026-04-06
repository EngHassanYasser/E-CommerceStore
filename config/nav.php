<?php

return [
    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard',
        'title'=>'Dashboard'
    ],
       [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'categories.index',
        'title'=>'Categories',
        'badege'=>'New',
        'ability'=>'categories.view'
    ],
     [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'products.index',
        'title'=>'products',
        'ability'=>'products.view'
    ],
    [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'roles.index',
        'title'=>'Roles',
        'active'=>'dashboard.roles.*',
        'ability'=>'roles.view'
    ]
];