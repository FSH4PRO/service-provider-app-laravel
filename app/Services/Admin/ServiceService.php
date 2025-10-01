<?php

namespace App\Services\Admin;

use App\Models\Service;

class ServiceService
{
    public function index()
    {
        return Service::with(['provider', 'category'])->get();
    }

    public function changeStatus($id, $status)
    {
        $service = Service::findOrFail($id);
        $service->status = $status;
        $service->save();
        return $service;
    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);
        return $service->delete();
    }
}
