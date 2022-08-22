@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $columns = [
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
          'Nama Kas Keluar' => 'nama_kas_keluar',
          'keterangan' => 'keterangan',
          'Debit' => ['render' => function ($data) {
            if ($data->jenis_pemasukan) {
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
            }
          }],
          'Kredit' => ['render' => function ($data) {
            if ($data->nama_kas_keluar) {
              return $data->harga * $data->qty;
            }
          }],
          'Aksi' => ['render' => function ($data) { ?>
            <a href="{{url($data->jenis_pemasukan ? 'pemasukan/' : 'pengeluaran/') . '/' . $data->id}}/edit" class="btn btn-success">Edit</a>
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
                    <form action="{{url('barang/' . $data->id)}}" method="post">
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
      <x-table
        :columns=$columns
        :dataList=$data
        idTable="tableJurnal"
        excel="{{ url('jurnal/excel') }}"
      />
    </div><!-- /.container-fluid -->
  </div>
@endsection