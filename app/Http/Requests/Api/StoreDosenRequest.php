<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nip'     => 'required|string|unique:dosens,nip',
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|unique:dosens,email',
            'jurusan' => 'required|string|max:100',
            'no_hp'   => 'nullable|string|max:20',
        ];
    }
}