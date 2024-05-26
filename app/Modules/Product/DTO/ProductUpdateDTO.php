<?php

namespace App\Modules\Product\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ProductUpdateDTO extends DataTransferObject
{
    public $id;
    public $store_id;
    public $name;
    public $description;

    public static function fromRequest($request = null)
    {
        $request = $request ?? app('request');

        return new self([
            'id' => $request->input('id'),
            'store_id' => $request->input('store_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    }
}