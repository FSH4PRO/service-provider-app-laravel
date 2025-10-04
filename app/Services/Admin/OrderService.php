<?php

namespace App\Services\Admin;

use App\Models\Order;

class OrderService
{
    public function getOrders($request)
    {
        $orders = Order::query();

        // 🔍 البحث
        if ($request->filled('search_service')) {
            $search_service = $request->input('search_service');
            $orders->where(function ($q) use ($search_service) {
                $q->where('service_id', 'LIKE', "%{$search_service}%");
            });}
             if ($request->filled('search_client')) {
            $search_client = $request->input('search_client');
            $orders->where(function ($q) use ($search_client) {
                $q->where('client_id', 'LIKE', "%{$search_client}%");
            });}
            if ($request->filled('search_provider')) {
            $search_provider = $request->input('search_provider');
            $orders->where(function ($q) use ($search_provider) {
                $q->where('provider_id', 'LIKE', "%{$search_provider}%");
            });}
            
        

        // 📂 الفلترة حسب الحالة
        if ($request->filled('status')) {
            $orders->where('status', $request->input('status'));
        }

        // ↕️ الترتيب
        $sortField = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');

        $allowedSorts = ['id', 'price', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $orders->orderBy($sortField, $sortOrder);

        return $orders->paginate(10);
    }
}