<?php

namespace App\Models;

use App\Models\Traits\CreatedByRelationshipTrait;
use App\Models\Traits\UpdatedByRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends BaseSoftModel
{
    use HasFactory, CreatedByRelationshipTrait, UpdatedByRelationshipTrait;

    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }
}
