<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConcessionApprovalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action' => ['required', Rule::in(['review_started', 'request_info', 'recommend_approve', 'recommend_reject', 'approve', 'reject'])],
            'comment' => ['nullable', 'string'],
        ];
    }
}
