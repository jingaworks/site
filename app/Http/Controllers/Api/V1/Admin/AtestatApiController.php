<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AtestatResource;
use App\Atestat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtestatApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('atestat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return AtestatResource::collection(Atestat::with(['created_by' ,'products', 'serie', 'place', 'region'])->get());
    }
}