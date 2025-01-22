<?php

namespace App\Http\Requests\Petstore;

use App\Services\API\Petstore\PetStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePetRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'photoUrls' => ['required', 'array'],
            'name' => ['required', 'string'],
            'status' => ['required', 'string', Rule::enum(PetStatus::class)]
        ];
    }
}
