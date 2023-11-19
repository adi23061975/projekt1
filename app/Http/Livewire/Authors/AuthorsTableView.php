<?php

namespace App\Http\Livewire\Authors;

use App\Models\Author;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Authors\Actions\EditAuthorAction;
use App\Http\Livewire\Authors\Actions\RestoreAuthorAction;
use App\Http\Livewire\Authors\Filters\SoftDeleteFilter;
use App\Http\Livewire\Authors\Actions\SoftDeleteAuthorAction;

class AuthorsTableView extends TableView
{
    use Actions;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function repository(): Builder
    {
        return Author::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('authors.attributes.name'))->sortBy('name'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
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
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function filters()
    {
        return [
            new SoftDeleteFilter,
        ];
    }

    protected function actionsByRow()
    {
        return [
            new EditAuthorAction('authors.edit', __('translation.actions.edit')),
            new SoftDeleteAuthorAction(),
            new RestoreAuthorAction(),
        ];
    }

    public function softDelete(int $id)
    {
        $author = Author::find($id);
        $author->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroy_title'),
            $description = __('authors.messages.successes.destroy', [
                'name' => $author->name,
            ])
        );
    }

    public function restore(int $id)
    {
        $author = Author::withTrashed()->find($id);
        $author->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restore_title'),
            $description = __('authors.messages.successes.restore', [
                'name' => $author->name,
            ])
        );
    }
}
