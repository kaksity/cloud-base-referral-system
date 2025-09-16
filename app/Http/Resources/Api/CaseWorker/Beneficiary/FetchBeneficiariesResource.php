<?php

namespace App\Http\Resources\Api\CaseWorker\Beneficiary;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchBeneficiariesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => "{$this->first_name} {$this->middle_name} {$this->last_name}",
            'age_group' => $this->age_group,
            'address' => $this->address,
            'referred_services' => [],
            'profile_photo_url' => $this->profile_photo_url,
            'status' => $this->status,
        ];
    }
}
