<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class AssignWorkerRoleAction extends Action
{
    public $title = '';
    public $icon = 'droplet';
    
    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.assign_worker_role');
    }

    public function handle($model, View $view)
    {
        $model->assignRole(config('auth.roles.worker'));
        $view->notification()->success(
            $title = __('translation.messages.successes.updated_title'),
            $description = __('users.messages.successes.worker_role_assigned', [
                'user' => $model->name
            ])
        );
    }
    
    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.worker'));
    }
}
