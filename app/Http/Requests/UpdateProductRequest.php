<?php

namespace App\Http\Requests;

use App\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'category_id'  => [
                'required',
                'integer',
            ],
            'name'         => [
                'max:100',
                'required',
            ],
            'description'  => [
                'required',
            ],
            'price_starts' => [
                'required',
            ],
            'price_ends'   => [
                'required',
            ],
            'region_id'    => [
                'required',
                'integer',
            ],
            'place_id'     => [
                'required',
                'integer',
            ],
        ];
    }
}