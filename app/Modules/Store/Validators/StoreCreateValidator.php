<?php

namespace App\Modules\Store\Validators;

use App\Modules\Store\DTO\StoreCreateDTO;
use App\Validators\AbstractValidator;

class StoreCreateValidator extends AbstractValidator
{
    public function rules($params = [])
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
        ];
    }

    public function toDTO()
    {
        return StoreCreateDTO::fromRequest();
    }
}
