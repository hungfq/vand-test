<?php

namespace App\Http\Controllers;

use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use Helpers;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function responseSuccess($message = null, $code = 200)
    {
        $data = [
            'message' => 'Successfully.'
        ];

        if ($message) {
            $data = array_merge($data, ['message' => $message]);
        }

        return response()->json(['data' => $data], $code);
    }
}
