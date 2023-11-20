<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Users\Filters\RoleFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Users\Filters\EmailVerifiedFilter;
use App\Http\Livewire\Users\Actions\AssignAdminRoleAction;
use App\Http\Livewire\Users\Actions\RemoveAdminRoleAction;
use App\Http\Livewire\Users\Actions\AssignWorkerRoleAction;
use App\Http\Livewire\Users\Actions\RemoveWorkerRoleAction;

class UsersTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    // protected $model = User::class;


    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'email',
        'roles.name',
        'email_verified_at',
        'created_at'
    ];

    /**
     * Set number elements per page
     */
    protected $paginate = 5;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return User::query()->with('roles');
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('users.attributes.name'))->sortBy('name'),
            Header::title(__('users.attributes.email'))->sortBy('email'),
            __('users.attributes.roles'),
            Header::title(__('users.attributes.email_verified_at'))->sortBy('email_verified_at'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->email,
            $model->roles->implode('name', ','),
            $model->email_verified_at,
            $model->created_at
        ];
    }

    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new RoleFilter,
            new EmailVerifiedFilter,
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new AssignAdminRoleAction,
            new RemoveAdminRoleAction,
            new AssignWorkerRoleAction,
            new RemoveWorkerRoleAction,
        ];
    }
}
