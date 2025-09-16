<?php

namespace App\Http\Resources\Api\CaseWorker\Authentication;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $token = $this->createToken('Case Worker Access Token')->plainTextToken;

        $accessTokenInformation = [
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => '60 minutes',
        ];

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'access_credentials' => $accessTokenInformation
        ];
    }
}
