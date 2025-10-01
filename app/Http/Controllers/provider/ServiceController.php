<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Services\Provider\ServiceService;
use App\Http\Requests\Provider\StoreServiceRequest;
use App\Http\Requests\Provider\UpdateServiceRequest;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        return response()->json($this->serviceService->index(Auth::id()));
    }

    public function store(StoreServiceRequest $request)
    {
        $service = $this->serviceService->store($request->validated(), Auth::id());
        return response()->json(['message' => 'Service created successfully', 'data' => $service], 201);
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        $service = $this->serviceService->update($id, $request->validated(), Auth::id());
        return response()->json(['message' => 'Service updated successfully','data'=> $service]);
    }

    public function destroy($id)
    {
        $this->serviceService->delete($id, Auth::id());
        return response()->json(['message' => 'Service deleted successfully']);
    }
}