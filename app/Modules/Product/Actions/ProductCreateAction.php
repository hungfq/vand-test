<?php

namespace App\Modules\Product\Actions;

use App\Exceptions\UserException;
use App\Models\Product;
use App\Models\Store;
use App\Modules\Product\DTO\ProductCreateDTO;
use Illuminate\Support\Facades\Auth;

class ProductCreateAction
{
    public ProductCreateDTO $dto;

    /***
     * @param ProductCreateDTO $dto
     * @return void
     */
    public function handle($dto)
    {
        $this->dto = $dto;

        $this->checkData()
            ->create();
    }

    protected function checkData()
    {
        $store = Store::query()
            ->where('owner_id', Auth::id())
            ->find($this->dto->store_id);
        if (!$store) {
            throw new UserException("Store not found");
        }

        $existProduct = Product::query()
            ->where('owner_id', Auth::id())     // authorization
            ->where('store_id', $this->dto->store_id)
            ->where('name', $this->dto->name)
            ->exists();
        if ($existProduct) {
            throw new UserException("Product with this name already exists");
        }

        return $this;
    }

    protected function create()
    {
        Product::query()->create([
            'owner_id' => Auth::id(),
            'store_id' => $this->dto->store_id,
            'name' => $this->dto->name,
            'description' => $this->dto->description,
        ]);

        return $this;
    }
}
