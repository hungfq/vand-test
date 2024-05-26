<?php

namespace App\Modules\Store\Transformers;

use League\Fractal\TransformerAbstract;

class StoreViewTransformer extends TransformerAbstract
{
    public function transform($model)
    {
        return [
            'store_id' => data_get($model, 'id'),
            'name' => data_get($model, 'name'),
            'description' => data_get($model, 'description'),
            'created_by_name' => data_get($model, 'created_by_name'),
            'created_at' => data_get($model, 'created_at'),
            'updated_by_name' => data_get($model, 'updated_by_name'),
            'updated_at' => data_get($model, 'updated_at'),
        ];
    }
}