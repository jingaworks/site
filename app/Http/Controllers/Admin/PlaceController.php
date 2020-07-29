<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlaceRequest;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Place;
use App\Region;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('place_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Place::where('niv', 3)->orderBy('denloc')->with(['judet'])->select(sprintf('%s.*', (new Place)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'place_show';
                $editGate      = 'place_edit';
                $deleteGate    = 'place_delete';
                $crudRoutePart = 'places';

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
            $table->addColumn('judet_denj', function ($row) {
                return $row->judet ? $row->judet->denj : '';
            });
            $table->editColumn('denloc', function ($row) {
                return $row->denloc ? $row->denloc : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'judet']);

            return $table->make(true);
        }

        return view('admin.places.index');
    }

    public function create()
    {
        abort_if(Gate::denies('place_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $juds = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.places.create', compact('juds'));
    }

    public function store(StorePlaceRequest $request)
    {
        $place = Place::create($request->all());

        return redirect()->route('admin.places.index');
    }

    public function edit(Place $place)
    {
        abort_if(Gate::denies('place_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $juds = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        $place->load('jud');

        return view('admin.places.edit', compact('juds', 'place'));
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->all());

        return redirect()->route('admin.places.index');
    }

    public function show(Place $place)
    {
        abort_if(Gate::denies('place_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $place->load('jud');

        return view('admin.places.show', compact('place'));
    }

    public function destroy(Place $place)
    {
        abort_if(Gate::denies('place_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $place->delete();

        return back();
    }

    public function ajax_call(Request $request)
    {
        // dd($request->all());
        $places = Place::where('region_id', $request['cat_id'])->where('niv', 3)->orderBy('denloc')->get();
        $serie = Region::findOrFail($request['cat_id']);

        return ['places' => $places, 'serie' => $serie];
    }

    public function massDestroy(MassDestroyPlaceRequest $request)
    {
        Place::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}