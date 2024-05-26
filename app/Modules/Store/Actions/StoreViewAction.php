<?php

namespace App\Modules\Store\Actions;

use App\Libraries\Helpers;
use App\Models\Store;
use App\Modules\Store\DTO\StoreViewDTO;
use Illuminate\Support\Facades\Auth;

class StoreViewAction
{
    /**
     * @param StoreViewDTO $dto
     */
    public function handle($dto)
    {
        $query = Store::query()
            ->select([
                'stores.*',
                'uc.name as created_by_name',
                'uu.name as updated_by_name',
            ])
            ->leftJoin('users as uc', 'uc.id', '=', 'stores.created_by')
            ->leftJoin('users as uu', 'uu.id', '=', 'stores.updated_by')
            ->where('owner_id', Auth::id());

        if ($name = $dto->name) {
            $query->where('stores.name', 'LIKE', "%$name%");
        }

        if ($description = $dto->description) {
            $query->where('stores.description', 'LIKE', "%$description%");
        }

        Helpers::sortBuilder($query, $dto->toArray(), [
            'store_id' => 'stores.id',
            'created_by_name' => 'uc.name',
            'updated_by_name' => 'uu.name',
        ]);

        return $query->paginate($dto->limit ?? ITEM_PER_PAGE);
    }
}
