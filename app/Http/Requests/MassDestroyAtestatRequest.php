<?php

namespace App\Http\Requests;

use App\Atestat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAtestatRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('atestat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:atestats,id',
        ];
    }
}