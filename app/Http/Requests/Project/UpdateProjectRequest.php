<?php

namespace App\Http\Requests\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class UpdateProjectRequest extends StoreProjectRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * Re-uses the store rules but makes every field optional for a partial update.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return collect(parent::rules())
            ->map(function (array|string $rules) {
                $rules = (array) $rules;

                return in_array('sometimes', $rules, true)
                    ? $rules
                    : Arr::prepend($rules, 'sometimes');
            })
            ->toArray();
    }
}
