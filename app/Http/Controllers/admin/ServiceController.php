<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        return response()->json($this->serviceService->index());
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,active,inactive'
        ]);

        $service = $this->serviceService->changeStatus($id, $request->status);
        return response()->json(['message' => 'Service status updated successfully', 'data' => $service]);
    }

    public function destroy($id)
    {
        $this->serviceService->delete($id);
        return response()->json(['message' => 'Service deleted successfully']);
    }
}
