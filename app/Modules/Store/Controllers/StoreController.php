<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\ApiController;
use App\Modules\Store\Actions\StoreCreateAction;
use App\Modules\Store\Actions\StoreDeleteAction;
use App\Modules\Store\Actions\StoreShowAction;
use App\Modules\Store\Actions\StoreUpdateAction;
use App\Modules\Store\Actions\StoreViewAction;
use App\Modules\Store\DTO\StoreViewDTO;
use App\Modules\Store\Transformers\StoreShowTransformer;
use App\Modules\Store\Transformers\StoreViewTransformer;
use App\Modules\Store\Validators\StoreCreateValidator;
use App\Modules\Store\Validators\StoreUpdateValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends ApiController
{
    public function view(Request $request, StoreViewAction $action, StoreViewTransformer $transformer)
    {
        $result = $action->handle(
            StoreViewDTO::fromRequest($request)
        );

        return $this->response->paginator($result, $transformer);
    }

    public function show($id, StoreShowAction $action, StoreShowTransformer $transformer)
    {
        $result = $action->handle($id);

        return $this->response->item($result, $transformer);
    }

    public function create(StoreCreateValidator $validator, StoreCreateAction $action)
    {
        $validator->validate($this->request->all());

        DB::transaction(function () use ($action, $validator) {
            $action->handle(
                $validator->toDTO()
            );
        });

        return $this->responseSuccess();
    }

    public function update($id, StoreUpdateValidator $validator, StoreUpdateAction $action)
    {
        $this->request->merge([
            'id' => $id
        ]);

        $validator->validate($this->request->all());

        DB::transaction(function () use ($action, $validator) {
            $action->handle(
                $validator->toDTO()
            );
        });

        return $this->responseSuccess();
    }

    public function delete($id, StoreDeleteAction $action)
    {

        DB::transaction(function () use ($action, $id) {
            $action->handle($id);
        });

        return $this->responseSuccess();
    }
}