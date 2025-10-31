<?php

namespace App\Conditions;

class HasGeneralDocuments
{
    public function passes($model, array $params): bool
    {
        return $model->has_general_documents === true;
    }

    public static function parameterHelp(): string
    {
        return 'No parameters required';
    }
}
