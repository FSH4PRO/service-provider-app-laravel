<?php

namespace App\Services\Client;

use App\Models\Service;

class ServiceService
{
    public function listActive($filters = [])
    {
        $query = Service::query()
            ->where('status', 'active')
            ->with(['category', 'provider']);

        // 🔍 البحث (في العنوان أو الوصف)
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // 📂 الفلترة حسب التصنيف
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // ↕️ الترتيب حسب السعر أو الاسم
        if (!empty($filters['sort_by'])) {
            $sortField = in_array($filters['sort_by'], ['price', 'title']) ? $filters['sort_by'] : 'title';
            $sortOrder = $filters['sort_order'] ?? 'asc';
            $query->orderBy($sortField, $sortOrder);
        }

        return $query->get();
    }


    public function listByCategory($categoryId)
    {
        return Service::where('status', 'active')
            ->where('category_id', $categoryId)
            ->with('category')
            ->get();
    }

    public function getDetails($id)
    {
        return Service::where('id', $id)
            ->where('status', 'active')
            ->with(['provider', 'category'])
            ->firstOrFail();
    }
}
