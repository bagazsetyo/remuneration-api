<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContributionRequest extends BaseFormRequest
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
            'workRecordId' => 'required|exists:work_records,id',
            'employeeId' => 'required|exists:employees,id',
            'taskDescription' => 'string|nullable',
            'hoursSpent' => 'integer|nullable',
            'hourlyRate' => 'integer|nullable',
            'date' => 'date|nullable',
        ];
    }



    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'workRecordId.required' => 'ID Work Record wajib diisi.',
            'workRecordId.exists' => 'Work Record yang dipilih tidak ditemukan dalam database.',
            'employeeId.required' => 'ID Karyawan wajib diisi.',
            'employeeId.exists' => 'Karyawan yang dipilih tidak ditemukan dalam database.',
            'taskDescription.string' => 'Deskripsi tugas harus berupa teks yang valid.',
            'hoursSpent.integer' => 'Jam kerja harus berupa angka bulat.',
            'hoursSpent.min' => 'Jam kerja tidak boleh kurang dari 1 jam.',
            'hourlyRate.integer' => 'Tarif per jam harus berupa angka bulat.',
            'hourlyRate.min' => 'Tarif per jam tidak boleh kurang dari 1.',
            'date.date' => 'Format tanggal tidak valid. Gunakan format YYYY-MM-DD.',
        ];
    }
}
