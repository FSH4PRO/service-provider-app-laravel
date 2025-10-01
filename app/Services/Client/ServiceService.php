<?php

namespace App\Services\Client;

use App\Models\Service;

class ServiceService
{

    public function listActive()
    {
        return Service::where('status', 'active')->with('category')->get();
    }

    public function listByCategory($categoryId)
    {
        return Service::where('status', 'active')
            ->where('category_id', $categoryId)
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
