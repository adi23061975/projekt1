<?php

namespace App\Http\Livewire\Genres;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class GenreForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Genre $genre;
    public Bool $editMode;

    public function rules()
    {
        return [
            'genre.name' => [
                'required',
                'string',
                'min:2',
                'unique:genres,name' .
                    ($this->editMode ? (',' . $this->genre->id) : ''),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('genres.attributes.name')),
        ];
    }

    public function mount(Genre $genre, Bool $editMode)
    {
        $this->genre = $genre;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.genres.genre-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->genre);
        } else {
            $this->authorize('create', Genre::class);
        }
        sleep(1);
        $this->validate();
        $this->genre->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('genres.messages.successes.updated', ['name' => $this->genre->name])
                : __('genres.messages.successes.stored', ['name' => $this->genre->name])
        );
        $this->editMode = true;
    }
}
