<?php

namespace App\Modules\Store\Actions;

use App\Exceptions\UserException;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreShowAction
{
    public function handle($id)
    {
        $store = Store::query()
            ->where('owner_id', Auth::id())
            ->find($id);
        if (!$store) {
            throw new UserException('Store not found');
        }

        return $store;
    }
}
