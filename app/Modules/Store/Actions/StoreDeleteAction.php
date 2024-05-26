<?php

namespace App\Modules\Store\Actions;

use App\Exceptions\UserException;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreDeleteAction
{
    public $id;
    public $store;

    public function handle($id)
    {
        $this->id = $id;
        $this->checkData()
            ->deleteStoreAndProduct();
    }

    protected function checkData()
    {
        $this->store = Store::query()
            ->where('owner_id', Auth::id())
            ->find($this->id);
        if (!$this->store) {
            throw new UserException("Store not found");
        }

        return $this;
    }

    protected function deleteStoreAndProduct()
    {
        $this->store->products()->delete();
        $this->store->delete();

        return $this;
    }
}
