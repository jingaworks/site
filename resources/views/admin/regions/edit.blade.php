@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.region.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.regions.update", [$region->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="denj">{{ trans('cruds.region.fields.denj') }}</label>
                <input class="form-control {{ $errors->has('denj') ? 'is-invalid' : '' }}" type="text" name="denj" id="denj" value="{{ old('denj', $region->denj) }}">
                @if($errors->has('denj'))
                    <div class="invalid-feedback">
                        {{ $errors->first('denj') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.denj_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mnemonic">{{ trans('cruds.region.fields.mnemonic') }}</label>
                <input class="form-control {{ $errors->has('mnemonic') ? 'is-invalid' : '' }}" type="text" name="mnemonic" id="mnemonic" value="{{ old('mnemonic', $region->mnemonic) }}">
                @if($errors->has('mnemonic'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mnemonic') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.mnemonic_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection