@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.atestat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.atestats.store") }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="required" for="region_id">{{ trans('cruds.atestat.fields.region') }}</label>
                <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id" required>
                    @foreach($regions as $id => $region )
                        <option data-auto="{{ $region }}" value="{{ $id }}" {{ old('region_id') == $id ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place_id">{{ trans('cruds.atestat.fields.place') }}</label>
                <select class="form-control select2 {{ $errors->has('place') ? 'is-invalid' : '' }}" name="place_id" id="place_id" required>
                    
                </select>
                @if($errors->has('place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.place_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.atestat.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.address_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.atestat.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="serie_id">{{ trans('cruds.atestat.fields.serie') }}</label>
                <select class="form-control select2 {{ $errors->has('serie') ? 'is-invalid' : '' }}" name="serie_id" id="serie_id" required>
                </select>
                @if($errors->has('serie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('serie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.serie_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.atestat.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text" name="number" id="number" value="{{ old('number', '') }}" required>
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="valid_year">{{ trans('cruds.atestat.fields.valid_year') }}</label>
                <input class="form-control date {{ $errors->has('valid_year') ? 'is-invalid' : '' }}" type="text" name="valid_year" id="valid_year" value="{{ old('valid_year') }}" required>
                @if($errors->has('valid_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valid_year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.valid_year_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.atestat.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atestat.fields.image_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.atestats.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($atestat) && $atestat->image)
      var file = {!! json_encode($atestat->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function () {

                $('#region_id').on('change',function(e) {
                 
                 var cat_id = e.target.value;

                 $.ajax({
                       
                       url:"{{ route('admin.places.get_ajax') }}",
                       type:"POST",
                       data: {
                           cat_id: cat_id
                        },
                      
                       success:function (data) {

                        $('#serie_id').empty();
                        $('#serie_id').append('<option value="'+data.serie.id+'">'+data.serie.mnemonic+'</option>');

                        $('#place_id').empty();
                        $('#place_id').append('<option>{{trans('global.pleaseSelect')}}</option>');

                        $.each(data.places,function(index,place){
                            
                            $('#place_id').append('<option value="'+place.id+'">'+place.denloc+'</option>');
                        })

                       }
                   })
                });

            });
        </script>
@endsection