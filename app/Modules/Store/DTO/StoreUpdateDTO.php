<?php

namespace App\Modules\Store\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class StoreUpdateDTO extends DataTransferObject
{
    public $id;
    public $name;
    public $description;

    public static function fromRequest($request = null)
    {
        $request = $request ?? app('request');

        return new self([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    }
}