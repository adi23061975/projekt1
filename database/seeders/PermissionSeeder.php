<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cache'a ról i uprawnień
        // php artisan permission:cache-reset
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);

        Permission::create(['name' => 'log-viewer']);

        Permission::create(['name' => 'genres.index']);
        Permission::create(['name' => 'genres.manage']);

        Permission::create(['name' => 'authors.index']);
        Permission::create(['name' => 'authors.manage']);

        $adminRole = Role::findByName(config('auth.roles.admin'));
        $adminRole->givePermissionTo('users.index');
        $adminRole->givePermissionTo('users.store');
        $adminRole->givePermissionTo('users.destroy');
        $adminRole->givePermissionTo('users.change_role');

        $adminRole ->givePermissionTo('log-viewer');

        $adminRole->givePermissionTo('genres.index');
        $adminRole->givePermissionTo('genres.manage');
        $adminRole->givePermissionTo('authors.index');
        $adminRole->givePermissionTo('authors.manage');

        $workerRole = Role::findByName(config('auth.roles.worker'));
        $workerRole->givePermissionTo('genres.index');
        $workerRole->givePermissionTo('authors.index');

        $userRole = Role::findByName(config('auth.roles.user'));
        $userRole->givePermissionTo('genres.index');
        $userRole->givePermissionTo('authors.index');
    }
}
