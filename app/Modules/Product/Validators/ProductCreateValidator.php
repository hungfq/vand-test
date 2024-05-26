<?php

namespace App\Modules\Product\Validators;

use App\Modules\Product\DTO\ProductCreateDTO;
use App\Validators\AbstractValidator;

class ProductCreateValidator extends AbstractValidator
{
    public function rules($params = [])
    {
        return [
            'store_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
        ];
    }

    public function toDTO()
    {
        return ProductCreateDTO::fromRequest();
    }
}
