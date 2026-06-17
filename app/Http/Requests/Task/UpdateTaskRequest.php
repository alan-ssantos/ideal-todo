<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string', 'min:2', 'max:255'],
            'due_date' => ['sometimes', 'date', 'date_format:Y-m-d H:i:s', 'after:now'],
            'status' => ['sometimes', Rule::enum(TaskEnum::class)],
        ];
    }
}
