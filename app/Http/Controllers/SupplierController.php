<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Helpers\{
    JsonResponse,
};

class SupplierController extends Controller
{
    public function index()
    {
        try{
            $suppliers = Supplier::all();
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_SUCCESS), $suppliers);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }   
    }
}
