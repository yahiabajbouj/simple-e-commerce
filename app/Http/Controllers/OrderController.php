<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Repositories\IRepositories\{IOrderRepository, IProductRepository};
use App\Helpers\{
    JsonResponse,
    ResponseStatus,
};

class OrderController extends Controller
{
    private $orderRepository, $productRepository;

    public function __construct(IOrderRepository $orderRepository, IProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $orders = $this->orderRepository->all();
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_SUCCESS), $orders);
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
    public function store(OrderRequest $request)
    {
        try{
            $data = $request->all();
            $data['total_amount'] = $this->getTotal($request->items);
            $model = $this->orderRepository->create($data);
            $this->orderRepository->syncItems($model, $data['items']); 
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_ADDED_SUCCESSFULLY) ,$model);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        try{
            if($order){
                $order = new OrderResource($order);
                return JsonResponse::respondSuccess(trans(JsonResponse::MSG_SUCCESS),$order);
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        try{
            $data = $request->except('items');
            $data['total_amount'] = $this->getTotal($request->items);
            $this->orderRepository->update($data, $order->id);
            $this->orderRepository->syncItems($order, $request->items); 
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY),null);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try{
            $this->orderRepository->delete($order->id);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY));
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function getTotal($items){
        $total = 0;
        foreach($items as $item){
            $total += $this->productRepository->find($item['product_id'])->unit_price * $item['quantity'];
        }
        return $total;
    }
}
