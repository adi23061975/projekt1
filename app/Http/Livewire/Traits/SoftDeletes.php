<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;

trait SoftDeletes
{
    protected function softDeletesNotificationTitle()
    {
        return __('translation.messages.successes.destroyed_title');
    }

    protected function softDeletesNotificationDescription(Model $model)
    {
        return __('translation.messages.successes.destroyed_description', [
            'model' => $model
        ]);
    }

    /**
     * Usuwanie wybranego modelu
     */
    public function softDeletes(int $id)
    {
        $model = $this->model::find($id);
        $model->delete();
        $this->notification()->success(
            $title = $this->softDeletesNotificationTitle(),
            $description = $this->softDeletesNotificationDescription($model)
        );
    }
}
