<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
    ],
    'actions' => [
        'create' => 'Dodaj gatunek',
        'edit' => 'Edytuj gatunek',
        'destroy' => 'Usuń gatunek',
        'restore' => 'Przywróć gatunek',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego gatunku',
        'edit_form_title' => 'Edycja gatunku',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano gatunek :name',
            'updated' => 'Zaktualizowano gatunek :name',
            'destroyed' => 'Usunięto gatunek :name',
            'restored' => 'Przywrócono gatunek :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie gatunku',
            'description' => 'Czy na pewno usunąć gatunek :name',
        ],
        'restore' => [
            'title' => 'Przywracanie gatunku',
            'description' => 'Czy na pewno przywrócić gatunek :name',
        ],
    ]
];
