<?php

return [
    'attributes' => [
        'name' => 'Nazwisko i imię',
        'email' => 'Email',
        'email_verified_at' => 'Email zweryfikowano',
        'roles' => 'Role',
    ],
    'actions' => [
        'assign_admin_role' => 'Ustaw rolę admina',
        'remove_admin_role' => 'Odbierz rolę admina',
        'assign_worker_role' => 'Ustaw rolę pracownika',
        'remove_worker_role' => 'Odbierz rolę pracownika',
    ],
    'messages' => [
        'successes' => [
            'admin_role_assigned' => 'Ustawiono rolę admina',
            'admin_role_removed' => 'Odebrano rolę admina',
            'worker_role_assigned' => 'Ustawiono rolę pracownika',
            'worker_role_removed' => 'Odebrano rolę pracownika',
        ]
    ]
];
