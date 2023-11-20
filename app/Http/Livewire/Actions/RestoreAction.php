<?php

namespace App\Http\Livewire\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Database\Eloquent\Model;

/**
 * Akcja przywracania usuniętego modelu
 */
class RestoreAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = '';

    public function __construct(?String $title = null)
    {
        parent::__construct();
        if ($title !== null) {
            $this->title = $title;
        } else {
            $this->title = __('translation.actions.restore');
        }
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = 'trash';

    /**
     * Tytuł okna dialogowego
     *
     * @return String
     */
    protected function dialogTitle(): String
    {
        return __('translation.dialogs.restore.title');
    }

    /**
     * Opis okna dialogowego
     *
     * @param Model $model
     * @return String
     */
    protected function dialogDescription(Model $model): String
    {
        return __('translation.dialogs.restore.description', [
            'model' => $model
        ]);
    }

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Manufacturer object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => $this->dialogTitle(),
            'description' => $this->dialogDescription($model),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'restore',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('restore', $model);
    }
}
