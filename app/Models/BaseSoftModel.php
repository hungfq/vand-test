<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class BaseSoftModel extends BaseModel
{
    use SoftDeletes;
}