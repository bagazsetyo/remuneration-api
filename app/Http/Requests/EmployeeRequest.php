<?php

namespace App\Http\Requests;

class EmployeeRequest extends BaseFormRequest
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
        $employeeId = $this->route('employee') ? $this->route('employee')->id : $this->route('id');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employeeId,
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama pegawai wajib diisi.',
            'email.required' => 'Email pegawai wajib diisi.',
            'email.unique' => 'Email pegawai sudah terdaftar.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama pegawai',
            'email' => 'email pegawai',
        ];
    }
}
