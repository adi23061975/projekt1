<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class AssignWorkerRoleAction extends Action
{
    /**
     * Title
     * @var String
     * */
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.assign_worker_role');
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = 'droplet';

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $model->assignRole(config('auth.roles.worker'));
        $this->success(__('users.messages.successes.worker_role_assigned'));
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.worker'));
    }
}
