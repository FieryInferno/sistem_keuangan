<div class="card">
  <div class="card-header">
    @if ($idTable !== 'tableJurnal')
      <div class="row mb-1 d-flex justify-content-end">
        <a href="{{ $url }}" class="btn btn-primary">Tambah</a>
      </div>
    @endif
    @if ($excel)
      <div class="row mb-1 d-flex justify-content-end">
        <a href="{{ $excel }}" class="btn btn-primary">Excel</a>
      </div>
    @endif
  </div>
  <div class="card-body">
    <x-alert-success/>
    <table class="table" id="{{ $idTable }}" width="100%">
      <thead>
        <tr>
          @foreach ($columns as $key => $value)
            <th>{{$key}}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($dataList as $key)
          <tr>
            @foreach ($columns as $keyTh => $valueTh)
              <td>
                @if (isset($valueTh['render']))
                  {{$valueTh['render']($key)}}
                @else
                  {{$key->$valueTh}}
                @endif
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
      @if ($idTable === 'tableJurnal')
        <tfoot>
          <tr>
            <th colspan="5" style="text-align:right">Total:</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      @endif
    </table>
  </div>
</div>
