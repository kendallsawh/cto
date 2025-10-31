<?php

namespace App\Services\ProcessFlow;

use App\Models\ProcessInstance;
use App\Models\ProcessLog;
use Illuminate\Support\Facades\Auth;

class ProcessEngineService
{
    protected $conditionService;
    protected $actionService;

    public function __construct(
        ProcessConditionService $conditionService,
        ProcessActionService $actionService
    ) {
        $this->conditionService = $conditionService;
        $this->actionService = $actionService;
    }

    public function advance(ProcessInstance $instance): bool
    {

        $step = $instance->currentStep;
        $model = $instance->model;

        \Log::debug('✅ Step and model loaded: step_id=' . ($step ? $step->id : 'null') . ', model_id=' . ($model ? $model->id : 'null'));

        if (!$step || !$this->conditionService->check($step, $model)) {
            \Log::error("❌ Step null or condition check failed");
            return false;
        }

        $this->actionService->execute($step, $model);
        \Log::debug("✅ Actions executed for step_id={$step->id}");

        $flow = $instance->flow; // correct usage of belongsTo

        if (!$flow) {
            \Log::error("❌ Flow is null for instance ID {$instance->id}");
            return false;
        }

        $nextStep = $flow->steps()
            ->where('order', '>', $step->order)
            ->orderBy('order')
            ->first();

        if ($nextStep) {
            \Log::debug("➡️ Moving to next step: ID {$nextStep->id}");
        } else {
            \Log::debug("✅ Final step reached. Completing flow.");
        }

        $instance->update([
            'current_step_id' => $nextStep ? $nextStep->id : null,
            'completed_at' => ($nextStep && $nextStep->is_final) ? now() : null,

        ]);

        ProcessLog::create([
            'process_instance_id' => $instance->id,
            'step_id' => $step->id,
            'user_id' => Auth::id(),
            'note' => 'Step completed',
            'completed_at' => now(),
            'metadata' => [
                'model_type' => get_class($model),
                'model_id' => $model->id,
            ],
        ]);
        \Log::debug("✅ Step advanced and log created.");
        return true;
    }
}
