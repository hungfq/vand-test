<?php

namespace App\Modules\Product\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ProductCreateDTO extends DataTransferObject
{
    public $store_id;
    public $name;
    public $description;

    public static function fromRequest($request = null)
    {
        $request = $request ?? app('request');

        return new self([
            'store_id' => $request->input('store_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    }
}