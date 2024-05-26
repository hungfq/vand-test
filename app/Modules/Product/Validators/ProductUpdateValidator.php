<?php

namespace App\Modules\Product\Validators;

use App\Modules\Product\DTO\ProductUpdateDTO;
use App\Validators\AbstractValidator;

class ProductUpdateValidator extends AbstractValidator
{
    public function rules($params = [])
    {
        return [
            'id' => 'required',
            'store_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
        ];
    }

    public function toDTO()
    {
        return ProductUpdateDTO::fromRequest();
    }
}
