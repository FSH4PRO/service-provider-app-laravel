<?php

namespace App\Services\Provider;

use App\Models\Service;

class ServiceService
{

    public function index($providerId)
    {
        return Service::where('provider_id', $providerId)->get();
    }

    public function store($data, $providerId)
    {
        return Service::create(array_merge($data, [
            'provider_id' => $providerId,
            'status' => 'pending',
            'slug' => 'hi'
        ]));
    }

    public function update($id, $data, $providerId)
    {
        $service = Service::where('id', $id)
            ->where('provider_id', $providerId)
            ->firstOrFail();

        $service->update($data);
        return $service;
    }

    public function delete($id, $providerId)
    {
        $service = Service::where('id', $id)
            ->where('provider_id', $providerId)
            ->firstOrFail();

        return $service->delete();
    }
}