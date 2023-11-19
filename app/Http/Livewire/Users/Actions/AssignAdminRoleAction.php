<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class AssignAdminRoleAction extends Action
{
    public $title = '';
    public $icon = 'shield';
    
    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.assign_admin_role');
    }

    public function handle($model, View $view)
    {
        $model->assignRole(config('auth.roles.admin'));
        // $this->success(__('users.messages.successes.admin_role_assigned'));
        $view->notification()->success(
            $title = __('translation.messages.successes.updated_title'),
            $description = __('users.messages.successes.admin_role_assigned', [
                'user' => $model->name
            ])
        );
    }
    
    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.admin'));
    }
}
