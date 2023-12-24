<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

final class CreatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'resume' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'tags' => ['required','array'],
        ];
    }
}
