<?php

namespace App\Http\Controllers\provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Provider\OrderService;
use App\Http\Resources\Order\OrderResource;

class OrderController extends Controller
{
    protected $service ;
    
    public function __construct(OrderService $service){
        $this->service = $service;

    }
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search'),
            'status' => $request->query('status'),
            'sort'   => $request->query('sort'),
        ];

        $orders = $this->service->getOrders($filters);
        return $this->success(OrderResource::collection($orders), 'Orders retrieved successfully', 200);
    }

    public function show($id)
    {
        $order = $this->service->getOrder($id);
        return $this->success(new OrderResource($order), 'Order retrieved successfully', 200);
    }
    
}
