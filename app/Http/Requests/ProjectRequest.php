<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends BaseFormRequest
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
            'additionalCharges' => 'nullable|string',

            // Employee work contribution
            'employeWorkContribution' => 'required|array|min:1',
            'employeWorkContribution.*.employeeId' => 'required|integer|exists:employees,id',
            'employeWorkContribution.*.taskDescription' => 'required|string',
            'employeWorkContribution.*.hoursSpent' => 'required|numeric|max:24',
            'employeWorkContribution.*.hourlyRate' => 'required|numeric|min:0',
            'employeWorkContribution.*.date' => 'required|date',
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
            'startDate.date_format' => 'Format tanggal tidak sesuai.',
            'employeWorkContribution.required' => 'Data kontribusi karyawan wajib diisi.',
            'employeWorkContribution.array' => 'Data kontribusi karyawan harus berupa array.',
            'employeWorkContribution.min' => 'Minimal harus ada 1 kontribusi karyawan.',
            'employeWorkContribution.*.employeeId.required' => 'ID karyawan pada kontribusi wajib diisi.',
            'employeWorkContribution.*.employeeId.integer' => 'ID karyawan harus berupa angka.',
            'employeWorkContribution.*.employeeId.exists' => 'Karyawan tidak ditemukan.',
            'employeWorkContribution.*.taskDescription.required' => 'Deskripsi tugas wajib diisi.',
            'employeWorkContribution.*.hoursSpent.required' => 'Jam kerja wajib diisi.',
            'employeWorkContribution.*.hoursSpent.numeric' => 'Jam kerja harus berupa angka.',
            'employeWorkContribution.*.hoursSpent.max' => 'Jam kerja maksimal 24 jam per hari.',
            'employeWorkContribution.*.hourlyRate.required' => 'Tarif per jam wajib diisi.',
            'employeWorkContribution.*.hourlyRate.numeric' => 'Tarif per jam harus berupa angka.',
            'employeWorkContribution.*.hourlyRate.min' => 'Tarif per jam harus lebih dari 0.',
            'employeWorkContribution.*.date.required' => 'Tanggal kontribusi wajib diisi.',
            'employeWorkContribution.*.date.date' => 'Format tanggal kontribusi tidak valid.',
            'employeWorkContribution.*.date.date_format' => 'Format tanggal kontribusi tidak sesuai.',
        ];
    }
}
