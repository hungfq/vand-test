<?php

namespace App\Modules\Store\Validators;

use App\Modules\Store\DTO\StoreUpdateDTO;
use App\Validators\AbstractValidator;

class StoreUpdateValidator extends AbstractValidator
{
    public function rules($params = [])
    {
        return [
            'id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
        ];
    }

    public function toDTO()
    {
        return StoreUpdateDTO::fromRequest();
    }
}
