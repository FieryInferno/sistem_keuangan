@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $columns = [
          'No Pemasukan' => 'no_pemasukan',
          'Tanggal' => 'tanggal',
          'Jenis Pemasukan' => 'jenis_pemasukan',
          'Nama Barang/Jasa' => ['render' => function ($data) {
            switch ($data->jenis_pemasukan) {
              case 'barang':
                return $data->barang->nama;
                break;
              case 'jasa':
                return $data->jasa->nama;
                break;
              
              default:
                # code...
                break;
            }
          }],
          'Harga' => ['render' => function ($data) {
            switch ($data->jenis_pemasukan) {
              case 'barang':
                return $data->barang->harga;
                break;
              case 'jasa':
                return $data->tipe->harga;
                break;
              
              default:
                # code...
                break;
            }
          }],
          'Express' => ['render' => function ($data) {
            if ($data->jenis_pemasukan === 'jasa') {
              return $data->is_express === 'true' ? 'Ya' : 'Tidak';
            } else {
              return '';
            }
          }],
          'QTY' => 'qty',
          'diskon' => 'diskon',
          'Total Harga' => ['render' => function ($data) {
            $harga = 0;

            switch ($data->jenis_pemasukan) {
              case 'barang':
                $harga = $data->barang->harga;
                break;
              case 'jasa':
                $harga = $data->is_express === 'true' ? $data->tipe->harga + 10000 : $data->tipe->harga;
                break;
              
              default:
                # code...
                break;
            }

            $totalHarga = $harga * $data->qty;

            if ($data->diskon) {
              return $totalHarga - ($totalHarga * $data->diskon / 100);
            }

            return $totalHarga;
          }],
          'keterangan' => 'keterangan',
          'Aksi' => ['render' => function ($data) { ?>
            <a href="{{url('pemasukan/' . $data->id . '/edit')}}" class="btn btn-success">Edit</a>
            <button
              type="button"
              class="btn btn-danger"
              data-toggle="modal"
              data-target="#hapus{{ $data->id }}"
            >
              Hapus
            </button>
            <div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Apakah anda yakin akan menghapus data ini?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #58dfa0;">Close</button>
                    <form action="{{url('pemasukan/' . $data->id)}}" method="post">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php }]
        ];
      ?>
      <x-table :columns=$columns :dataList=$data url="{{ url('pemasukan/create' )}}"/>
    </div><!-- /.container-fluid -->
  </div>
@endsection