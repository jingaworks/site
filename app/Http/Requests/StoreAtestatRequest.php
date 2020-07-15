<?php

namespace App\Http\Requests;

use App\Atestat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAtestatRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('atestat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'       => [
                'min:5',
                'max:100',
                'required',
            ],
            'serie_id'   => [
                'required',
                'integer',
            ],
            'number'     => [
                'min:7',
                'max:7',
                'required',
            ],
            'valid_year' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'region_id'  => [
                'required',
                'integer',
            ],
            'place_id'   => [
                'required',
                'integer',
            ],
            'address'    => [
                'required',
            ],
            'image'      => [
                'required',
            ],
        ];
    }
}