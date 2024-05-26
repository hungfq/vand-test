<?php

namespace App\Modules\Product\Actions;

use App\Libraries\Helpers;
use App\Models\Product;
use App\Modules\Product\DTO\ProductViewDTO;
use Illuminate\Support\Facades\Auth;

class ProductViewAction
{
    /**
     * @param ProductViewDTO $dto
     */
    public function handle($dto)
    {
        $query = Product::query()
            ->select([
                'products.*',
                'stores.name as store_name',
                'uc.name as created_by_name',
                'uu.name as updated_by_name',
            ])
            ->join('stores', 'stores.id', '=', 'products.store_id')
            ->leftJoin('users as uc', 'uc.id', '=', 'products.created_by')
            ->leftJoin('users as uu', 'uu.id', '=', 'products.updated_by')
            ->where('products.owner_id', Auth::id());

        if ($name = $dto->name) {
            $query->where('products.name', 'LIKE', "%$name%");
        }

        if ($description = $dto->description) {
            $query->where('products.description', 'LIKE', "%$description%");
        }

        if ($store_id = $dto->store_id) {
            $query->where('products.store_id', $store_id);
        }

        Helpers::sortBuilder($query, $dto->toArray(), [
            'product_id' => 'products.id',
            'store_name' => 'stores.name',
            'created_by_name' => 'uc.name',
            'updated_by_name' => 'uu.name',
        ]);

        return $query->paginate($dto->limit ?? ITEM_PER_PAGE);
    }
}
