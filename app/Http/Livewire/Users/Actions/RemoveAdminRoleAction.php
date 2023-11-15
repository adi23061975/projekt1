<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class RemoveAdminRoleAction extends Action
{
 
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.remove_admin_role');
    }

    public $icon = 'shield';

    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.admin'));
        $this->success(__('users.messages.successes.admin_role_removed'));
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.admin'));
    }
}