<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return ProductResource::collection(Product::with(
                ['region', 
                'place', 
                'category', 
                'subcategory',
                'created_by' ])
                ->get());
    }
    public function show($id)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return ProductResource::collection(Product::with(['region', 'place', 'category', 'subcategory','created_by' ])
                ->where('id' ,$id)
                ->get());
    }
}