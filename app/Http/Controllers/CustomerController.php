<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Helpers\{
    JsonResponse,
};

class CustomerController extends Controller
{
    public function index()
    {
        try{
            $customers = Customer::all();
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_SUCCESS), $customers);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }   
    }
}
