<?php

namespace App\Modules\Product\Actions;

use App\Exceptions\UserException;
use App\Models\Product;
use App\Models\Store;
use App\Modules\Product\DTO\ProductUpdateDTO;
use Illuminate\Support\Facades\Auth;

class ProductUpdateAction
{
    public ProductUpdateDTO $dto;
    public $product;

    /***
     * @param ProductUpdateDTO $dto
     * @return void
     */
    public function handle($dto)
    {
        $this->dto = $dto;

        $this->checkData()
            ->update();
    }

    protected function checkData()
    {
        $this->product = Product::query()
            ->where('owner_id', Auth::id())
            ->find($this->dto->id);
        if (!$this->product) {
            throw new UserException("Product not found");
        }

        $store = Store::query()
            ->where('owner_id', Auth::id())
            ->find($this->dto->store_id);
        if (!$store) {
            throw new UserException("Store not found");
        }

        $existProduct = Product::query()
            ->where('owner_id', Auth::id())     // authorization
            ->where('id', '<>', $this->dto->id)
            ->where('store_id', $this->dto->store_id)
            ->where('name', $this->dto->name)
            ->exists();
        if ($existProduct) {
            throw new UserException("Product with this name already exists");
        }

        return $this;
    }

    protected function update()
    {
        $this->product->update([
            'store_id' => $this->dto->store_id,
            'name' => $this->dto->name,
            'description' => $this->dto->description,
        ]);

        return $this;
    }
}
