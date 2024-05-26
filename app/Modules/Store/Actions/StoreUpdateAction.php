<?php

namespace App\Modules\Store\Actions;

use App\Exceptions\UserException;
use App\Models\Store;
use App\Modules\Store\DTO\StoreUpdateDTO;
use Illuminate\Support\Facades\Auth;

class StoreUpdateAction
{
    public StoreUpdateDTO $dto;
    public $store;

    /***
     * @param StoreUpdateDTO $dto
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
        $this->store = Store::query()
            ->where('owner_id', Auth::id())
            ->find($this->dto->id);
        if (!$this->store) {
            throw new UserException("Store not found");
        }

        $existStore = Store::query()
            ->where('owner_id', Auth::id())     // authorization
            ->where('id', '<>', $this->dto->id)
            ->where('name', $this->dto->name)
            ->exists();
        if ($existStore) {
            throw new UserException("Store with this name already exists");
        }

        return $this;
    }

    protected function update()
    {
        $this->store->update([
            'name' => $this->dto->name,
            'description' => $this->dto->description,
        ]);

        return $this;
    }
}
