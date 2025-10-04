<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\ServiceService;
use App\Http\Resources\Service\ServiceResource;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    // هنا Laravel بيعمل Dependency Injection
    public function __construct(ServiceService $serviceService)
    {
        // Laravel Service Container بينشئ ServiceService ويحقنه هون
        $this->serviceService = $serviceService;
    }

    public function index(Request $request)
    {
        // استخرج القيم المطلوبة من الاستعلام
        $filters = $request->only(['search', 'category_id', 'sort_by', 'sort_order']);

        // مرّر الفلاتر إلى الـ service
        $services = $this->serviceService->listActive($filters);

        // رجّع النتائج كـ resource منسّق
        return $this->success(
            ServiceResource::collection($services),
            'Services retrieved successfully',
            200
        );
    }

    public function byCategory($id)
    {
        $services = $this->serviceService->listByCategory($id);
        return $this->success(ServiceResource::collection($services), 'Services retrieved successfully', 200);
    }

    public function show($id)
    {
        $service = $this->serviceService->getDetails($id);
        return $this->success(new ServiceResource($service), 'Service retrieved successfully', 200);
    }
}
