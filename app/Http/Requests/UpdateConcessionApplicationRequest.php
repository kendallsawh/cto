<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateConcessionApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'applicant_type' => ['sometimes', Rule::in(['App\\Models\\Company', 'App\\Models\\Individual'])],
            'applicant_id' => ['sometimes', 'integer', $this->applicantExistsRule()],
            'concession_status_id' => ['nullable', 'exists:concession_statuses,id'],
            'notes' => ['nullable', 'string'],
            'items' => ['sometimes', 'array', 'min:1'],
            'items.*.item_name' => ['required_with:items', 'string'],
            'items.*.unit_id' => ['required_with:items', 'exists:measurement_units,id'],
            'items.*.quantity' => ['required_with:items', 'numeric', 'min:0.01'],
            'items.*.unit_value' => ['required_with:items', 'numeric', 'min:0'],
            'items.*.item_id' => ['sometimes', 'nullable', 'exists:items,id'],
            'items.*.category' => ['sometimes', 'nullable', 'string'],
            'items.*.specification' => ['sometimes', 'nullable', 'string'],
        ];
    }

    protected function applicantExistsRule(): Rule
    {
        $type = $this->input('applicant_type', $this->route('applicant_type'));
        $table = $type === 'App\\Models\\Company' ? 'companies' : 'individuals';

        return Rule::exists($table, 'id');
    }
}
