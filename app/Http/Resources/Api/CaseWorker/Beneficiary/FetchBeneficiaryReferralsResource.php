<?php

namespace App\Http\Resources\Api\CaseWorker\Beneficiary;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchBeneficiaryReferralsResource extends JsonResource
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
            'location' => [
                'id' => $this->location->id,
                'name' => $this->location->name,
            ],
            'organization' => [
                'id' => $this->organization->id,
                'name' => $this->organization->name,
            ],
            'beneficiary' => [
                'id' => $this->beneficiary?->id,
                'full_name' => "{$this->beneficiary?->first_name} {$this->beneficiary?->middle_name} {$this->beneficiary?->last_name}"
            ],
            'services' => json_decode($this->services ?? '[]'),

        ];
    }
}
