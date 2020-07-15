@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.product.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ ($product->category ? $product->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subcategory_id">{{ trans('cruds.product.fields.subcategory') }}</label>
                <select class="form-control select2 {{ $errors->has('subcategory') ? 'is-invalid' : '' }}" name="subcategory_id" id="subcategory_id">
                    @foreach($subcategories as $id => $subcategory)
                        <option value="{{ $id }}" {{ ($product->subcategory ? $product->subcategory->id : old('subcategory_id')) == $id ? 'selected' : '' }}>{{ $subcategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('subcategory'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subcategory') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.subcategory_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $product->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="images">{{ trans('cruds.product.fields.images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.images_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_starts">{{ trans('cruds.product.fields.price_starts') }}</label>
                <input class="form-control {{ $errors->has('price_starts') ? 'is-invalid' : '' }}" type="number" name="price_starts" id="price_starts" value="{{ old('price_starts', $product->price_starts) }}" step="0.01" required>
                @if($errors->has('price_starts'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_starts') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_starts_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_ends">{{ trans('cruds.product.fields.price_ends') }}</label>
                <input class="form-control {{ $errors->has('price_ends') ? 'is-invalid' : '' }}" type="number" name="price_ends" id="price_ends" value="{{ old('price_ends', $product->price_ends) }}" step="0.01" required>
                @if($errors->has('price_ends'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_ends') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_ends_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="region_id">{{ trans('cruds.product.fields.region') }}</label>
                <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id" required>
                    @foreach($regions as $id => $region)
                        <option value="{{ $id }}" {{ ($product->region ? $product->region->id : old('region_id')) == $id ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place_id">{{ trans('cruds.product.fields.place') }}</label>
                <select class="form-control select2 {{ $errors->has('place') ? 'is-invalid' : '' }}" name="place_id" id="place_id" required>
                    @foreach($places as $id => $place)
                        <option value="{{ $id }}" {{ ($product->place ? $product->place->id : old('place_id')) == $id ? 'selected' : '' }}>{{ $place }}</option>
                    @endforeach
                </select>
                @if($errors->has('place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.place_helper') }}</span>
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
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 2048,
      height: 2048
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->images)
      var files = {!! json_encode($product->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
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
@endsection