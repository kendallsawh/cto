<?php

namespace App\Services\ProcessFlow;

use App\Models\ProcessStep;

class ProcessConditionService
{
    // Checks if a step's conditions are met before allowing it to be completed.
    public function check(ProcessStep $step, $model): bool
    {
        //\Log::debug("Checking step ID {$step->id} for model " . get_class($model));
        //If there are no conditions, we allow advancing
        if ($step->conditions->isEmpty()) {
           // \Log::debug("No conditions found for step ID {$step->id}");
            return true;
        }
        foreach ($step->conditions as $condition) {
           // \Log::debug("Evaluating condition: {$condition->type}");
            $class = app($condition->type); // dynamic resolution
            $params = json_decode($condition->parameter, true) ?? [];
            /* if (!method_exists($class, 'passes') || !$class->passes($model, $params)) {
                return false;
            } */
            if (!$class->passes($model, $params)) {
               // \Log::warning("Condition failed: {$condition->type}");
                return false;
            }
        }
        return true;  // No conditions = should return true
    }
}
