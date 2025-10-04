<?php

namespace App\Services\Client;

use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class FavoritesService
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->get();
        return $favorites;
    }

    public function favorite($id)
    {
        $service = Service::where('id', $id)->where('status', 'active')->where('status', 'active')->firstOrFail();
        $exists = Auth::user()->favorites()->where('service_id', $service->id)->exists();
        if ($exists) {
            abort( 409,'You have already favorited this service.');
        }
        Auth::user()->favorites()->syncWithoutDetaching($service->id);
    }

    public function unfavorite($id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        $exists = Auth::user()->favorites()->where('service_id', $service->id)->exists();
        if (!$exists) {
            abort(404, 'Service not found');
        }
        Auth::user()->favorites()->detach($service->id);
    }
}
