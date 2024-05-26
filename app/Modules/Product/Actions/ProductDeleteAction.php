<?php

namespace App\Modules\Product\Actions;

use App\Exceptions\UserException;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductDeleteAction
{
    public $id;
    public $product;

    public function handle($id)
    {
        $this->id = $id;
        $this->checkData()
            ->deleteProduct();
    }

    protected function checkData()
    {
        $this->product = Product::query()
            ->where('owner_id', Auth::id())
            ->find($this->id);
        if (!$this->product) {
            throw new UserException("Product not found");
        }

        return $this;
    }

    protected function deleteProduct()
    {
        $this->product->delete();

        return $this;
    }
}
