<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\IRepositories\IProductRepository;
use App\Helpers\{
    JsonResponse,
    ResponseStatus,
};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try{
            $products = $this->productRepository->all();
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_SUCCESS), $products);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            $data = $request->all();
            $model = $this->productRepository->create($data);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_ADDED_SUCCESSFULLY) ,$model);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try{
            if($product){
                $product = new ProductResource($product);
                return JsonResponse::respondSuccess(trans(JsonResponse::MSG_SUCCESS),$product);
            }
            return JsonResponse::respondError(trans(JsonResponse::MSG_FAILED),ResponseStatus::NOT_FOUND);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try{
            $this->productRepository->update($request->all(),$product->id);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY),null);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $this->productRepository->delete($product->id);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY));
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }
}
