<?php

namespace App\Http\Livewire\Genres;

use App\Http\Livewire\Genres\Actions\EditGenreAction;
use App\Http\Livewire\Genres\Actions\RestoreGenreAction;
use App\Http\Livewire\Genres\Actions\SoftDeleteGenreAction;
use App\Http\Livewire\Genres\Filters\SoftDeleteFilter;
use App\Models\Genre;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use WireUi\Traits\Actions;

class GenresTableView extends TableView
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

    protected function filters()
    {
        return [
            new SoftDeleteFilter,
        ];
    }

    protected function actionsByRow()
    {
        return [
            new EditGenreAction('genres.edit', __('translation.actions.edit')),
            new SoftDeleteGenreAction(),
            new RestoreGenreAction(),
        ];
    }

    public function softDelete(int $id)
    {
        $genre = Genre::find($id);
        $genre->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroy_title'),
            $description = __('genres.messages.successes.destroy', [
                'name' => $genre->name,
            ])
        );
    }

    public function restore(int $id)
    {
        $genre = Genre::withTrashed()->find($id);
        $genre->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restore_title'),
            $description = __('genres.messages.successes.restore', [
                'name' => $genre->name,
            ])
        );
    }
}
