<?php

namespace App\Services\ProcessFlow;

use App\Models\ProcessStep;

class ProcessActionService
{
    // Executes specific actions once a step is successfully completed.
    public function execute(ProcessStep $step, $model): void
    {
        foreach ($step->actions as $action) {
            $class = app($action->type);
            if (method_exists($class, 'run')) {
                $class->run($model, $action->parameters ?? []);
            }
        }
    }
}
