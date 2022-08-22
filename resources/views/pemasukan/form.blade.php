@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <form method="post" action="{{ isset($pemasukan) ? url('pemasukan/' . $pemasukan->id) : url('pemasukan') }}" enctype="multipart/form-data">
          @csrf
          {{ isset($pemasukan) ? method_field('PUT') : '' }}
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="form-group">
              <label>No. Pemasukan</label>
              <input
                type="text"
                class="form-control"
                placeholder="Ketik disini..."
                name="no_pemasukan"
                value="{{ isset($pemasukan) ? $pemasukan->no_pemasukan : '' }}"
              >
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <input
                type="date"
                class="form-control"
                name="tanggal"
                value="{{ isset($pemasukan) ? $pemasukan->tanggal : '' }}"
              >
            </div>
            <div class="form-group">
              <label>Jenis Pemasukan</label>
              <select
                name="jenis_pemasukan"
                class="form-control select2bs4"
                onchange="getBarangJasa(this, 'barang_jasa_id')"
              >
                <option disabled selected></option>
                <option value="barang" <?=
                  isset($pemasukan) ?
                    $pemasukan->jenis_pemasukan === 'barang' ?
                      'selected' :
                      '' :
                    ''; ?>>Barang</option>
                <option value="jasa" <?=
                  isset($pemasukan) ?
                    $pemasukan->jenis_pemasukan === 'jasa' ?
                      'selected' :
                      '' :
                    ''; ?>>Jasa</option>
              </select>
            </div>
            <div class="form-group">
              <label>Nama Barang/Jasa</label>
              <select
                name="barang_jasa_id"
                id="barang_jasa_id"
                class="form-control select2bs4"
              >
                @if (isset($barang_jasa))
                  @foreach ($barang_jasa as $valueData)
                    <option value="{{ $valueData->id }}" <?= $value['value'] === $valueData->id ? 'selected' : ''; ?>>{{ isset($value['labelSelect']) ? $value['labelSelect']($valueData) : $valueData->nama }}</option>
                  @endforeach
                @endif
              </select>
            </div>
            <div id="tipePelayanan"></div>
            <div class="form-group">
              <label>QTY</label>
              <input
                type="text"
                class="form-control"
                placeholder="Ketik disini..."
                name="qty"
                value="{{ isset($pemasukan) ? $pemasukan->qty : '' }}"
              >
            </div>
            <div class="form-group">
              <label>Diskon</label>
              <input
                type="text"
                class="form-control"
                placeholder="Ketik disini..."
                name="diskon"
                value="{{ isset($pemasukan) ? $pemasukan->diskon : '' }}"
              >
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea
                name="keterangan"
                cols="20"
                rows="5"
                placeholder="Ketik disini..."
                class="form-control"
              >{{ isset($pemasukan) ? $pemasukan->keterangan : '' }}</textarea>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div><!-- /.container-fluid -->
  </div>
@endsection