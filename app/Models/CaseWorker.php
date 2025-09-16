<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CaseWorker extends Authenticatable
{
    use HasUuids, HasFactory, Notifiable, SoftDeletes, HasApiTokens;
    protected $guarded = [];

    public function currentOrganization()
    {
        return $this->belongsTo(Organization::class, 'current_organization_id');
    }

    public function addedBySystemAdmin()
    {
        return $this->belongsTo(SystemAdmin::class, 'added_by_system_admin_id');
    }

    public function addedByOrganizationAdmin()
    {
        return $this->belongsTo(OrganizationAdmin::class, 'added_by_organization_admin_id');
    }

    public function currentLocation()
    {
        return $this->belongsTo(Location::class, 'current_location_id');
    }
}
