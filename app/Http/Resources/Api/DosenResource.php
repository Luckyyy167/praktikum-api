<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'nip'       => $this->nip,
            'nama'      => $this->nama,
            'email'     => $this->email,
            'jurusan'   => $this->jurusan,
            'no_hp'     => $this->no_hp ?? '-',
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}