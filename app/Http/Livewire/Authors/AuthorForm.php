<?php

namespace App\Http\Livewire\Authors;

use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class AuthorForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Author $author;
    public Bool $editMode;

    public function rules()
    {
        return [
            'author.name' => [
                'required',
                'string',
                'min:2',
                'unique:authors,name' .
                    ($this->editMode ? (',' . $this->author->id) : ''),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('authors.attributes.name')),
        ];
    }

    public function mount(Author $author, Bool $editMode)
    {
        $this->author = $author;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.authors.author-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->author);
        } else {
            $this->authorize('create', Author::class);
        }
        sleep(1);
        $this->validate();
        $this->author->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('authors.messages.successes.updated', ['name' => $this->author->name])
                : __('authors.messages.successes.stored', ['name' => $this->author->name])
        );
        $this->editMode = true;
    }
}
