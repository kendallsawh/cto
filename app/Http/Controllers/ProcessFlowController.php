<?php

namespace App\Http\Controllers;

use App\Models\ProcessInstance;
use Illuminate\Http\Request;
use App\Services\ProcessFlow\ProcessEngineService;

class ProcessFlowController extends Controller
{
    protected $engine;

    public function __construct(ProcessEngineService $engine)
    {
        //$this->middleware('permission'); // uses route name
        $this->engine = $engine;
    }

    public function advance(Request $request, ProcessInstance $instance)
    {
        //return $instance->currentStep->conditions;
        //dd($this->engine->advance($instance)); // Temporary debugging
        $instance->load(['currentStep.conditions', 'flow.steps', 'model']); // <- load all required relationships
        \Log::debug("Current Step ID: " . optional($instance->currentStep)->id);
        \Log::debug("Model Class: " . get_class($instance->model));
        if (!$instance->currentStep) {
            return back()->with('error', 'No current step defined for this instance.');
        }
        $success = $this->engine->advance($instance);

        if ($success) {
            return back()->with('success', 'Step completed and flow advanced.');
        }

        return back()->with('error', 'Conditions not met. Cannot advance step.');
    }
}
