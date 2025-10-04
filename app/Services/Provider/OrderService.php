<?php

namespace App\Services\Provider;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getOrders($filters)
    {
        $query = Order::whereHas('service', function ($q) {
            $q->where('provider_id', Auth::id());
        })->with(['service', 'client']);

        // 🔍 بحث باسم العميل
        if (!empty($filters['search'])) {
            $query->whereHas('client', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        // ⚙️ فلترة حسب الحالة
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // ⏱️ ترتيب حسب التاريخ
        if (!empty($filters['sort']) && in_array($filters['sort'], ['asc', 'desc'])) {
            $query->orderBy('created_at', $filters['sort']);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->get();
    }


    public function getOrder($id)
    {
        return Order::where('id', $id)->where('provider_id', Auth::user()->id)->first();
    }
}
