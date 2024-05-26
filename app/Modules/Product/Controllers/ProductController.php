<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\ApiController;
use App\Modules\Product\Actions\ProductCreateAction;
use App\Modules\Product\Actions\ProductDeleteAction;
use App\Modules\Product\Actions\ProductShowAction;
use App\Modules\Product\Actions\ProductUpdateAction;
use App\Modules\Product\Actions\ProductViewAction;
use App\Modules\Product\DTO\ProductViewDTO;
use App\Modules\Product\Transformers\ProductShowTransformer;
use App\Modules\Product\Transformers\ProductViewTransformer;
use App\Modules\Product\Validators\ProductCreateValidator;
use App\Modules\Product\Validators\ProductUpdateValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiController
{
    public function view(Request $request, ProductViewAction $action, ProductViewTransformer $transformer)
    {
        $results = $action->handle(
            ProductViewDTO::fromRequest($request)
        );

        return $this->response->paginator($results, $transformer);
    }

    public function create(ProductCreateValidator $validator, ProductCreateAction $action)
    {
        $validator->validate($this->request->all());

        DB::transaction(function () use ($action, $validator) {
            $action->handle(
                $validator->toDTO()
            );
        });

        return $this->responseSuccess();
    }

    public function show($id, ProductShowAction $action, ProductShowTransformer $transformer)
    {
        $result = $action->handle($id);

        return $this->response->item($result, $transformer);
    }

    public function update($id, ProductUpdateValidator $validator, ProductUpdateAction $action)
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

    public function delete($id, ProductDeleteAction $action)
    {

        DB::transaction(function () use ($action, $id) {
            $action->handle($id);
        });

        return $this->responseSuccess();
    }
}