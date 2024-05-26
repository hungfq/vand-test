<?php

namespace App\Modules\Store\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class StoreViewDTO extends DataTransferObject
{
    public $name;
    public $description;
    public $limit;
    public $page;
    public $sort;

    public static function fromRequest($request = null)
    {
        $request = $request ?? app('request');

        return new self([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'limit' => $request->input('limit'),
            'page' => $request->input('page'),
            'sort' => $request->input('sort'),
        ]);
    }
}