<div class="card">
  <div class="card-header">
    @if ($idTable !== 'tableJurnal')
      <div class="row mb-1 d-flex justify-content-end">
        <a href="{{ $url }}" class="btn btn-primary">Tambah</a>
      </div>
    @endif
    @if ($excel)
      <form action="{{ $excel }}" method="get">
        <div class="form-group">
          <div class="row">
            <div class="col-1">
              <select name="tanggal" class="form-control select2bs4">
                <option></option>
                @for ($i = 1; $i <= 31; $i++)
                  <option value="{{ strlen((string) $i) === 1 ? '0' . $i : $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
            <div class="col-4">
              <select name="bulan" class="form-control select2bs4">
                <option></option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Mei</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
            <div class="col-2">
              <select name="tahun" class="form-control select2bs4">
                <option></option>
                <?php
                  $tg_awal= date('Y')-10;
                  $tgl_akhir= date('Y');
                ?>
                @for ($i = $tgl_akhir; $i >= $tg_awal; $i--)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
            <div class="col-1">
              <button class="btn btn-primary" type="submit">Excel</button>
            </div>
          </div>
        </div>
      </form>
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
