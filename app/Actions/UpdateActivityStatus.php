<?php

namespace App\Actions;

class UpdateActivityStatus
{
    public function run($model, array $params): void
    {
        $model->status = $params['status'] ?? $model->status;
        $model->save();
    }

    public static function parameterHelp(): string
    {
        return '{ "status": 3 }';
    }
}
