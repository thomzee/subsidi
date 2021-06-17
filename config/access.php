<?php

return [

    'delimiter' => ',',

    /**
     * Menu action list that can be have.
     */
    'menu' => [
        'backend/user' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'status'],
        ],
        'backend/role' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'edit'],
        ],
        'backend/rdkk' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'backend/harian' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'backend/bulanan' => [
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'backend/import-rdkk' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
        'backend/setting' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'edit', 'delete'],
        ],
    ]
];
