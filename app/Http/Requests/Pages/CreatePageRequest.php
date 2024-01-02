<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

final class CreatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Page::class);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:pages'],
            'resume' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'code' => ['required', 'string'],
            'tags' => ['required','array'],
            'is_public' => ['integer', 'min:1', 'nullable'],
            'is_accept_version' => ['integer', 'min:1', 'nullable'],
        ];
    }
}
