<?php

namespace App\Models\Traits;

use App\Models\User;

trait UpdatedByRelationshipTrait
{
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}