<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\FavoritesService;

class FavoritesController extends Controller
{
    protected $service;

    public function __construct(FavoritesService $service){
        $this->service = $service;
    }

    public function index(){
        $favorites = $this->service->index();
        return response()->json(['code' => 200, 'message' => 'List of favorites','data' => $favorites], 200);
    }

    public function store($id){
        $this->service->favorite($id);
        return response()->json(['code' => 200,'message' => 'Service added to favorites'], 200);
    }

    public function destroy($id){
        $this->service->unfavorite($id);
        return response()->json(['code' => 200,'message' => 'Service removed from favorites'], 200);
    }

    
}
