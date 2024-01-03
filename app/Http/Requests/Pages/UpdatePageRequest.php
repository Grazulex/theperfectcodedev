<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class UpdatePageRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:pages,title,' . $this->route('page')->id],
            'resume' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'code' => ['required', 'string'],
            'tags' => ['required','array'],
            'is_public' => ['integer', 'min:1', 'nullable'],
            'is_accept_version' => ['integer', 'min:1', 'nullable'],
        ];
    }
}
