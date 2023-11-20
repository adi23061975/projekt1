<?php

return [
    'attributes' => [
        'created_at' => 'Utworzono',
        'updated_at' => 'Zaktualizowano',
        'deleted_at' => 'Usunięto',
    ],
    'messages' => [
        'successes' => [
            'stored_title' => 'Utworzono',
            'updated_title' => 'Zaktualizowano',
            'destroyed_title' => 'Usunięto',
            'restored_title' => 'Przywrócono',
            'destroyed_description' => 'Usunięto :model',
            'restored_description' => 'Przywrócono :model',
        ],
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie',
            'description' => 'Czy na pewno usunąć :model',
        ],
        'restore' => [
            'title' => 'Przywracanie',
            'description' => 'Czy na pewno przywrócić :model',
        ],
    ],
    'actions' => [
        'edit' => 'Edytuj',
        'destroy' => 'Usuń',
        'restore' => 'Przywróć',
    ],
    'yes' => 'Tak',
    'no' => 'Nie',
    'cancel' => 'Anuluj',
    'store' => 'Utwórz',
    'update' => 'Aktualizuj',
    'save' => 'Zapisz',
    'back' => 'Wstecz',
    'enter' => 'Wprowadź wartość',
    'select' => 'Wybierz wartość',
    'account' => [
        'manage_account' => 'Zarządzanie profilem',
        'profile' => 'Profil',
        'name' => 'Nazwisko i imię',
        'password' => 'Hasło',
        'password_confirm' => 'Powtórz hasło',
        'password_reset' => 'Resetuj hasło',
        'email' => 'Email',
        'remember_me' => 'Zapamiętaj mnie',
        'already_registered' => 'Już zarejestrowany?',
        'confirm' => 'Potwierdź',
        'confirm_password_info' => 'Dostęp do tej funkcjonalności wymaga ponownego podania hasła.',
        'forgot_password' => 'Zapomniałeś hasła?',
        'forgot_password_info' => 'Zapomniałeś hasła? Podaj adres email, aby otrzymać link do resetowania hasła.',
        'send' => 'Wyślij',
        'logout' => 'Wyloguj się',
        'login' => 'Zaloguj się',
        'register' => 'Zarejestruj',
        'api_tokens' => [
            'manage' => 'Zarządzaj tokenami API',
            'create_new' => 'Stwórz nowy API token',
            'description' => 'API tokens allow third-party services to authenticate with our application on your behalf.',
            'toke_name' => 'Nazwa tokenu',
            'permissions' => 'Uprawnienia'
        ],
        'team' => [
            'manage' => 'Zarządzanie zespołem',
            'settings' => 'Ustawienia zespołu',
            'create_new' => 'Stwórz nowy zespól',
            'switch' => 'Zmień zespół',
        ]
    ],
    'navigation' => [
        'dashboard' => 'Dashboard',
        'users' => 'Użytkownicy',
        'authors' => 'Autorzy',
        'genres'=> 'Gatunki',
    ],
];
