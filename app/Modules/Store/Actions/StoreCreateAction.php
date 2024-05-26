<?php

namespace App\Modules\Store\Actions;

use App\Exceptions\UserException;
use App\Models\Store;
use App\Modules\Store\DTO\StoreCreateDTO;
use Illuminate\Support\Facades\Auth;

class StoreCreateAction
{
    public StoreCreateDTO $dto;

    /***
     * @param StoreCreateDTO $dto
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
        $existStore = Store::query()
            ->where('owner_id', Auth::id())     // authorization
            ->where('name', $this->dto->name)
            ->exists();
        if ($existStore) {
            throw new UserException("Store with this name already exists");
        }

        return $this;
    }

    protected function create()
    {
        Store::query()->create([
            'name' => $this->dto->name,
            'description' => $this->dto->description,
            'owner_id' => Auth::id(),
        ]);

        return $this;
    }
}
