<?php

namespace App\Services\Client;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function makeOrder($data, $serviceId)
    {
        $service = Service::findOrFail($serviceId);
        return Order::create(array_merge($data, [
            'service_id' => $serviceId,
            'client_id' => Auth::user()->id,
            'provider_id' => $service->provider_id,
            'status' => 'pending',
            'price' => $service->price

        ]));
    }

    public function getOrders()
    {
        return Order::where('client_id', Auth::user()->id)->get();
    }

    public function getOrder($id)
    {
        return Order::where('client_id', Auth::user()->id)->where('id', $id)->first();
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrfail($id);
        $order->status = 'canceled';
        $order->save();
        return $order;
    }
}
