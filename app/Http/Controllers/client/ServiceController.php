<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ServiceService;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        return response()->json($this->serviceService->listActive());
    }

    public function byCategory($id)
    {
        return response()->json($this->serviceService->listByCategory($id));
    }

    public function show($id)
    {
        return response()->json($this->serviceService->getDetails($id));
    }
}