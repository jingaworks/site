@can('atestat_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.atestats.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.atestat.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.atestat.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-createdByAtestats">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.serie') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.number') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.valid_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.region') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.place') }}
                        </th>
                        <th>
                            {{ trans('cruds.atestat.fields.created_by') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($atestats as $key => $atestat)
                        <tr data-entry-id="{{ $atestat->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $atestat->id ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->name ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->serie->mnemonic ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->number ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->valid_year ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->region->denj ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->place->denloc ?? '' }}
                            </td>
                            <td>
                                {{ $atestat->created_by->name ?? '' }}
                            </td>
                            <td>
                                @can('atestat_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.atestats.show', $atestat->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('atestat_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.atestats.edit', $atestat->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('atestat_delete')
                                    <form action="{{ route('admin.atestats.destroy', $atestat->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('atestat_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.atestats.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-createdByAtestats:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection