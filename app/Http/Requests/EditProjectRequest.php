<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectRequest extends BaseFormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'nullable|in:active,completed,cancelled',
            'startDate' => 'required|date',
            'additionalCharges' => 'nullable',
        ];
    }


    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama project wajib diisi.',
            'name.max' => 'Nama project maksimal 255 karakter.',
            'description.required' => 'Deskripsi project wajib diisi.',
            'status.in' => 'Status harus salah satu dari: active, completed, cancelled.',
            'startDate.required' => 'Tanggal mulai project wajib diisi.',
            'startDate.date' => 'Format tanggal mulai tidak valid.',
            'startDate.date_format' => 'Format tanggal tidak sesuai.'
        ];
    }
}
