<?php

namespace App\Http\Livewire\Actions;

use Illuminate\Database\Eloquent\Model;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

/**
 * Akcja usuwanie typu soft modelu
 */
class SoftDeletesAction extends Action
{
    /**
     * Tytuł wyświetlany po najechaniu na przycisk akcji
     * @var String
     * */
    public $title = '';

    public function __construct(?String $title = null)
    {
        parent::__construct();
        if ($title !== null) {
            $this->title = $title;
        } else {
            $this->title = __('translation.actions.destroy');
        }
    }

    /**
     * Ikona akcji
     * @var String
     */
    public $icon = 'trash-2';

    /**
     * Tytuł okna dialogowego
     *
     * @return String
     */
    protected function dialogTitle(): String
    {
        return __('translation.dialogs.soft_deletes.title');
    }

    /**
     * Opis okna dialogowego
     *
     * @param Model $model
     * @return String
     */
    protected function dialogDescription(Model $model): String
    {
        return __('translation.dialogs.soft_deletes.description', [
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
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'softDeletes',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('delete', $model);
    }
}
