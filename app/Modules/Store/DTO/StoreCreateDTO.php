<?php

namespace App\Modules\Store\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class StoreCreateDTO extends DataTransferObject
{
    public $name;
    public $description;

    public static function fromRequest($request = null)
    {
        $request = $request ?? app('request');

        return new self([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    }
}