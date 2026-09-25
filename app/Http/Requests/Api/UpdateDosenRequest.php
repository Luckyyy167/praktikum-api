<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosenId = $this->route('dosen'); // Mengambil ID dari URL

        return [
            'nip'     => 'required|string|unique:dosens,nip,' . $dosenId,
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|unique:dosens,email,' . $dosenId,
            'jurusan' => 'required|string|max:100',
            'no_hp'   => 'nullable|string|max:20',
        ];
    }
}