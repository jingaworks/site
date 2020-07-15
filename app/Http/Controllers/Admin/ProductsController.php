<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Place;
use App\Product;
use App\Region;
use App\Subcategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if($canPost = auth()->user()->canPost || Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['category', 'subcategory', 'region', 'place', 'created_by'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_show';
                $editGate      = 'product_edit';
                $deleteGate    = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('region_denj', function ($row) {
                return $row->region ? $row->region->denj : '';
            });

            $table->addColumn('place_denloc', function ($row) {
                return $row->place ? $row->place->denloc : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->editColumn('created_by.email', function ($row) {
                return $row->created_by ? (is_string($row->created_by) ? $row->created_by : $row->created_by->email) : '';
            });
            $table->editColumn('created_by.phone', function ($row) {
                return $row->created_by ? (is_string($row->created_by) ? $row->created_by : $row->created_by->phone) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'region', 'place', 'created_by']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $subcategories = Subcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        return view('admin.products.create', compact('categories', 'subcategories'));
    }
    
    public function store(StoreProductRequest $request)
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $address = auth()->user()->createdByAtestats()->first();
        $request['region_id'] = $address->region_id;
        $request['place_id'] = $address->place_id;
        $product = Product::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategories = Subcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('category', 'subcategory', 'created_by');

        return view('admin.products.edit', compact('categories', 'subcategories', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $address = auth()->user()->createdByAtestats()->first();
        $request['region_id'] = $address->region_id;
        $request['place_id'] = $address->place_id;
        $product->update($request->all());

        if (count($product->images) > 0) {
            foreach ($product->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('category', 'subcategory', 'region', 'place', 'created_by');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}