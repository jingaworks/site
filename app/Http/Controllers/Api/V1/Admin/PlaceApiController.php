<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PlaceResource;
use App\Place;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlaceApiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('place_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return PlaceResource::collection(Place::with(['judet'])
        ->whereNotIn('tip', [40, 23])
        ->whereNotIn('codp', [0])
        ->orderBy('denloc')
        ->get());
    }
}