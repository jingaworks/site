<?php

namespace App\Http\Requests;

use App\Subcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSubcategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'name'        => [
                'max:50',
                'required',
                'unique:subcategories,name,' . request()->route('subcategory')->id,
            ],
        ];
    }
}