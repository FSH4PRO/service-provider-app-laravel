<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Services\Client\OrderService;
use App\Http\Resources\Order\OrderResource;
use App\Http\Requests\Client\MakeOrderRequest;

class OrderController extends Controller
{
    protected OrderService $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function makeOrder(MakeOrderRequest $request) {
        $order = $this->service->makeOrder($request->validated(),$request->service_id);

        return $this->success(new OrderResource($order), 'Order created successfully', 201);
    }

    public function index() {
        $orders = $this->service->getOrders();
        return $this->success(OrderResource::collection($orders), 'Orders retrieved successfully', 200);
    }

    public function show($id) {
        $order = $this->service->getOrder($id);
        return $this->success(new OrderResource($order), 'Order retrieved successfully', 200);
    }
    
    public function cancel($id) {
        $this->service->cancelOrder($id);
        return $this->success([], 'Order cancelled successfully', 200);
    }
}
