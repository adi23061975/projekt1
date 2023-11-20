<?php

namespace App\Http\Livewire\Genres;

use App\Models\Genre;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Genres\Actions\EditGenreAction;
use App\Http\Livewire\Genres\Actions\RestoreGenreAction;
use App\Http\Livewire\Genres\Actions\SoftDeletesGenreAction;

class GenresTableView extends TableView
{
    use Actions;

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Genre::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('genres.attributes.name'))->sortBy('name'),
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

    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new SoftDeletedFilter,
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new EditGenreAction(
                'genres.edit',
                __('genres.actions.edit')
            ),
            new SoftDeletesGenreAction(),
            new RestoreGenreAction(),
        ];
    }

    public function softDeletes(int $id)
    {
        $genre = Genre::find($id);
        $genre->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('genres.messages.successes.destroyed', [
                'name' => $genre->name
            ])
        );
    }

    public function restore(int $id)
    {
        $genre = Genre::withTrashed()->find($id);
        $genre->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('genres.messages.successes.restored', [
                'name' => $genre->name
            ])
        );
    }
}
