<?php

return [
    'attributes' => [
        'name' => 'Imię i nazwisko',
    ],
    'actions' => [
        'create' => 'Dodaj autora',
        'edit' => 'Edycja autora',
        'destroy' => 'Usuń autora',
        'restore' => 'Przywróć autora',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego autora',
        'edit_form_title' => 'Edycja autora',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano autora :name',
            'updated' => 'Zaktualizowano autora :name',
            'destroyed' => 'Usunięto autora :name',
            'restored' => 'Przywrócono autora :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie autora',
            'description' => 'Czy na pewno usunąć autora :name ?',
        ],
        'restore' => [
            'title' => 'Przywracanie autora',
            'description' => 'Czy na pewno przywrócić autora :name',
        ],
    ],
];
