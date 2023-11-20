<?php

namespace App\Http\Livewire\Users\Filters;

use LaravelViews\Filters\Filter;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class RoleFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.attributes.roles');
    }

    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('roles', function (Builder $query) use ($value) {
            $query->where('id', '=', $value);
        });
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): array
    {
        $roles = Role::all();
        $labels = $roles->pluck('name');
        $values = $roles->pluck('id');
        return $labels->combine($values)->toArray();
    }
}
