@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.atestat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atestats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.id') }}
                        </th>
                        <td>
                            {{ $atestat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.name') }}
                        </th>
                        <td>
                            {{ $atestat->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.serie') }}
                        </th>
                        <td>
                            {{ $atestat->serie->mnemonic ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.number') }}
                        </th>
                        <td>
                            {{ $atestat->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.valid_year') }}
                        </th>
                        <td>
                            {{ $atestat->valid_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.region') }}
                        </th>
                        <td>
                            {{ $atestat->region->denj ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.place') }}
                        </th>
                        <td>
                            {{ $atestat->place->denloc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.address') }}
                        </th>
                        <td>
                            {{ $atestat->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.image') }}
                        </th>
                        <td>
                            @if($atestat->image)
                                <a href="{{ $atestat->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $atestat->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atestat.fields.created_by') }}
                        </th>
                        <td>
                            {{ $atestat->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atestats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection