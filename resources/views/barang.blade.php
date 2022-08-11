@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $columns = [
          'Nama Barang' => 'nama',
          'Harga' => 'harga',
          'Aksi' => ['render' => function ($data) { ?>
            <a href="{{url('barang/' . $data->id . '/edit')}}" class="btn btn-success">Edit</a>
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
      <x-table :columns=$columns :dataList=$data url="{{ url('barang/create' )}}"/>
    </div><!-- /.container-fluid -->
  </div>
@endsection