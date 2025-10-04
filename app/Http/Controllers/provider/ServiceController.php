<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Provider\ServiceService;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Requests\Provider\StoreServiceRequest;
use App\Http\Requests\Provider\UpdateServiceRequest;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    // Dependency Injection هون
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->index(Auth::id());
        return $this->success(ServiceResource::collection($services), 'Services retrieved successfully', 200);
    }

    public function store(StoreServiceRequest $request)
    {
        $service = $this->serviceService->store($request->validated(), Auth::id());
        return $this->success(new ServiceResource($service), 'Service created successfully', 201);
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        $service = $this->serviceService->update($id, $request->validated(), Auth::id());
        return $this->success(new ServiceResource($service), 'Service updated successfully', 200);
    }

    public function destroy($id)
    {
        $this->serviceService->delete($id, Auth::id());
        return response()->json([ 'status' => 200,'message' => 'Service deleted successfully']);
    }
}