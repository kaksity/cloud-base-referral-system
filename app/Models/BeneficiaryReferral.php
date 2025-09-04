<?php

namespace App\Models;

class BeneficiaryReferral extends AbstractModel
{
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
