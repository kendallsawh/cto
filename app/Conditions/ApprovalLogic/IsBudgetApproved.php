<?php

namespace App\Conditions\ApprovalLogic;

class IsBudgetApproved
{
    public function passes($model, array $params): bool
    {
        return $model->budget_approved === true;
    }

    public static function parameterHelp(): string
    {
        return 'No parameters required';
    }
}
