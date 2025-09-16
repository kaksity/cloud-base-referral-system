<?php

namespace App\Http\Resources\Api\CaseWorker\Beneficiary;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBeneficiaryResource extends JsonResource
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
            'added_by_case_worker' => [
                'id' => $this->addedByCaseWorker->id,
                'full_name' => "{$this->addedByCaseWorker->first_name} {$this->addedByCaseWorker->middle_name}{$this->addedByCaseWorker->last_name}"
            ],
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'location' => [
                'id' => $this->location->id,
                'name' => $this->location->name,
                'state' => [
                    'id' => $this->location->state->id,
                    'name' => $this->location->state->name,
                ],
                'local_government_area' => [
                    'id' => $this->location->localGovernmentArea->id,
                    'name' => $this->location->localGovernmentArea->name,
                ]
            ],
            'address' => $this->address,
            'note' => $this->note,
            'profile_photo_url' => $this->profile_photo_url,
            'age_group' => $this->age_group,
            'other_attributes' => json_decode($this->other_attributes ?? '[]'),
            'status' => $this->status,
            'total_number_of_referrals' => $this->beneficiaryReferrals->count(),
        ];
    }
}
