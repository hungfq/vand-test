<?php

namespace App\Models;

use App\Models\Traits\CreatedByRelationshipTrait;
use App\Models\Traits\UpdatedByRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseSoftModel
{
    use HasFactory, CreatedByRelationshipTrait, UpdatedByRelationshipTrait;

    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
