<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentsSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // TODO: validate input data if needed

        $result = \App\Services\ApartmentService::search($request->all());

        //sleep(1);

        return response()->json($result);
    }
}
