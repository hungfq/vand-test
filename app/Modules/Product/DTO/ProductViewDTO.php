<?php

namespace App\Modules\Product\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ProductViewDTO extends DataTransferObject
{
    public $name;
    public $description;
    public $store_id;
    public $limit;
    public $page;
    public $sort;

    public static function fromRequest($request = null)
    {
        $request = $request ?? app('request');

        return new self([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'store_id' => $request->input('store_id'),
            'limit' => $request->input('limit'),
            'page' => $request->input('page'),
            'sort' => $request->input('sort'),
        ]);
    }
}