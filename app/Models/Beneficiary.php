<?php

namespace App\Models;

class Beneficiary extends AbstractModel
{
    public function beneficiaryReferrals()
    {
        return $this->hasMany(BeneficiaryReferral::class, 'beneficiary_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function addedByCaseWorker()
    {
        return $this->belongsTo(CaseWorker::class, 'added_by_case_worker_id');
    }
}
