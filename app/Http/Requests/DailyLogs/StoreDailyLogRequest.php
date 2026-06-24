<?php

namespace App\Http\Requests\DailyLogs;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDailyLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
        ];
    }
}
