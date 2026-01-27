<?php

namespace App\Domains\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'surname' => $this->surname,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->role_name
        ];
    }
}
