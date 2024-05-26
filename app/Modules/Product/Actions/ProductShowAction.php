<?php

namespace App\Modules\Product\Actions;

use App\Exceptions\UserException;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductShowAction
{
    public function handle($id)
    {
        $product = Product::query()
            ->where('owner_id', Auth::id())
            ->find($id);
        if (!$product) {
            throw new UserException('Product not found');
        }

        return $product;
    }
}
