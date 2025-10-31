<?php

namespace App\Http\Controllers;

use App\Models\ProcessFlow;
use App\Models\ProcessStep;
use Illuminate\Http\Request;
use App\Services\ProcessFlow\ClassScannerService;

class ProcessBuilderController extends Controller
{
    public function index()
    {
        $flows = ProcessFlow::withCount('steps')->latest()->get();
        return view('process_builder.index', compact('flows'));
    }

    public function create()
    {
        return view('process_builder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'model_type' => 'required|string',
            'model_id' => 'required|integer',
        ]);

        $flow = ProcessFlow::create($request->only(['name', 'description', 'model_type', 'model_id']));

        return redirect()->route('process_builder.edit', $flow)->with('success', 'Flow created!');
    }

    public function edit(ProcessFlow $flow)
    {
        $flow->load('steps.actions', 'steps.conditions');
        return view('process_builder.edit', compact('flow'));
    }

    public function update(Request $request, ProcessFlow $flow)
    {
        $flow->update($request->only(['name', 'description']));
        return back()->with('success', 'Flow updated.');
    }

    public function destroy(ProcessFlow $flow)
    {
        $flow->delete();
        return redirect()->route('process_builder.index')->with('success', 'Flow deleted.');
    }

    // Step handlers...

    public function createStep(ProcessFlow $flow)
    {
        $conditionGroups  = ClassScannerService::getGroupedClassMap('conditions');
        $actionGroups  = ClassScannerService::getGroupedClassMap('actions');

        return view('process_builder.steps.create', compact('flow', 'conditionGroups', 'actionGroups'));
    }

    public function storeStep(Request $request, ProcessFlow $flow)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'conditions' => 'array',
            'conditions.*.type' => 'nullable|string',
            'conditions.*.parameter' => 'nullable|string',
            'actions' => 'array',
            'actions.*.type' => 'nullable|string',
            'actions.*.parameter' => 'nullable|string',
        ]);

        $step = $flow->steps()->create($request->only('name', 'order'));

        foreach ($request->input('conditions', []) as $cond) {
            if (!empty($cond['type'])) {
                $step->conditions()->create($cond);
            }
        }

        foreach ($request->input('actions', []) as $action) {
            if (!empty($action['type'])) {
                $step->actions()->create($action);
            }
        }

        return redirect()->route('process_builder.edit', $flow)->with('success', 'Step and logic saved.');
    }


    public function editStep(ProcessStep $step)
    {
        $conditionGroups = ClassScannerService::getGroupedClassMap('conditions');
        $actionGroups  = ClassScannerService::getGroupedClassMap('actions');
        return view('process_builder.steps.edit', compact('step', 'conditionGroups', 'actionGroups'));
    }

    public function updateStep(Request $request, ProcessStep $step)
    {
        $step->update($request->only(['name', 'order']));

        // Update or insert conditions
        $conditionData = $request->input('conditions', []);
        $existingConditionIds = $step->conditions()->pluck('id')->toArray();
        $submittedConditionIds = [];

        foreach ($conditionData as $cond) {
            if (!empty($cond['type'])) {
                if (!empty($cond['id'])) {
                    $step->conditions()->where('id', $cond['id'])->update([
                        'type' => $cond['type'],
                        'parameter' => $cond['parameter'],
                    ]);
                    $submittedConditionIds[] = $cond['id'];
                } else {
                    $new = $step->conditions()->create($cond);
                    $submittedConditionIds[] = $new->id;
                }
            }
        }

        // Delete removed conditions
        $toDelete = array_diff($existingConditionIds, $submittedConditionIds);
        $step->conditions()->whereIn('id', $toDelete)->delete();

        // Repeat for actions
        $actionData = $request->input('actions', []);
        $existingActionIds = $step->actions()->pluck('id')->toArray();
        $submittedActionIds = [];

        foreach ($actionData as $act) {
            if (!empty($act['type'])) {
                if (!empty($act['id'])) {
                    $step->actions()->where('id', $act['id'])->update([
                        'type' => $act['type'],
                        'parameter' => $act['parameter'],
                    ]);
                    $submittedActionIds[] = $act['id'];
                } else {
                    $new = $step->actions()->create($act);
                    $submittedActionIds[] = $new->id;
                }
            }
        }

        $toDeleteActions = array_diff($existingActionIds, $submittedActionIds);
        $step->actions()->whereIn('id', $toDeleteActions)->delete();

        return redirect()->route('process_builder.edit', $step->flow)->with('success', 'Step updated.');
    }


    public function destroyStep(ProcessStep $step)
    {
        $flowId = $step->process_flow_id;
        $step->delete();
        return redirect()->route('process_builder.edit', $flowId)->with('success', 'Step removed.');
    }

    public function reorderSteps(Request $request, ProcessFlow $flow)
    {
        $stepIds = $request->input('order', []);

        foreach ($stepIds as $index => $stepId) {
            ProcessStep::where('id', $stepId)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Step order saved.']);
    }

}
