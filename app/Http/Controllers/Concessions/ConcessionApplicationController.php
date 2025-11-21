<?php

namespace App\Http\Controllers\Concessions;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConcessionApplicationRequest;
use App\Http\Requests\StoreConcessionApprovalRequest;
use App\Http\Requests\UpdateConcessionApplicationRequest;
use App\Models\ConcessionApplication;
use App\Models\ConcessionStatus;
use App\Models\MeasurementUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ConcessionApplicationController extends Controller
{
    public function store(StoreConcessionApplicationRequest $request): JsonResponse
    {
        $this->authorize('create', ConcessionApplication::class);

        $data = $request->validated();

        $application = DB::transaction(function () use ($data) {
            $application = ConcessionApplication::create($this->extractApplicationFields($data));
            $this->syncItems($application, $data['items'] ?? []);

            return $application;
        });

        return response()->json($application->load(['items', 'status']), 201);
    }

    public function update(UpdateConcessionApplicationRequest $request, ConcessionApplication $application): JsonResponse
    {
        $this->authorize('update', $application);

        $data = $request->validated();

        $application = DB::transaction(function () use ($application, $data) {
            $application->fill($this->extractApplicationFields($data));
            $application->save();

            if (array_key_exists('items', $data)) {
                $application->items()->delete();
                $this->syncItems($application, $data['items'] ?? []);
            }

            return $application;
        });

        return response()->json($application->load(['items', 'status']));
    }

    public function submit(ConcessionApplication $application): JsonResponse
    {
        $this->authorize('submit', $application);

        $application->concession_status_id = $this->getStatusId('submitted');
        $application->save();

        return response()->json($application->load('status'));
    }

    public function approve(StoreConcessionApprovalRequest $request, ConcessionApplication $application): JsonResponse
    {
        $this->authorize('approve', $application);

        return $this->recordDecision($request, $application, $request->validated(), 'approved');
    }

    public function reject(StoreConcessionApprovalRequest $request, ConcessionApplication $application): JsonResponse
    {
        $this->authorize('reject', $application);

        return $this->recordDecision($request, $application, $request->validated(), 'rejected');
    }

    protected function recordDecision(StoreConcessionApprovalRequest $request, ConcessionApplication $application, array $data, string $statusCode): JsonResponse
    {
        $application->concession_status_id = $this->getStatusId($statusCode);
        $application->save();

        $application->approvals()->create([
            'reviewer_id' => $request->user()->id ?? null,
            'action' => $data['action'],
            'comment' => $data['comment'] ?? null,
            'created_at' => now(),
        ]);

        return response()->json($application->load(['status', 'approvals']));
    }

    protected function syncItems(ConcessionApplication $application, array $items): void
    {
        foreach ($items as $itemData) {
            $unit = MeasurementUnit::find($itemData['unit_id'] ?? null);

            $application->items()->create([
                'item_id' => $itemData['item_id'] ?? null,
                'item_name' => $itemData['item_name'],
                'category' => $itemData['category'] ?? null,
                'specification' => $itemData['specification'] ?? null,
                'unit_id' => $itemData['unit_id'],
                'unit_name_snapshot' => $unit?->name,
                'unit_symbol_snapshot' => $unit?->symbol,
                'quantity' => $itemData['quantity'],
                'unit_value' => $itemData['unit_value'],
                'notes' => $itemData['notes'] ?? null,
            ]);
        }
    }

    protected function extractApplicationFields(array $data): array
    {
        return [
            'user_id' => $data['user_id'] ?? request()->user()?->id,
            'applicant_type' => $data['applicant_type'],
            'applicant_id' => $data['applicant_id'],
            'concession_status_id' => $data['concession_status_id'] ?? null,
            'reference_no' => $data['reference_no'] ?? null,
            'submitted_at' => $data['submitted_at'] ?? null,
            'decision_at' => $data['decision_at'] ?? null,
            'notes' => $data['notes'] ?? null,
        ];
    }

    protected function getStatusId(string $code): ?int
    {
        return ConcessionStatus::where('code', $code)->value('id');
    }
}
