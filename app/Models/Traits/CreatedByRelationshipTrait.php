<?php

namespace App\Models\Traits;

use App\Models\User;

trait CreatedByRelationshipTrait
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}