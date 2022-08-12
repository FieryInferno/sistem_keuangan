@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($pengeluaran) ? url('pengeluaran/' . $pengeluaran->id) : url('pengeluaran'),
          'fields' => [
            'no_pengeluaran' => [
              'label' => 'No Pengeluaran',
              'type' => 'input',
              'value' => isset($pengeluaran) ? $pengeluaran->no_pengeluaran : null,
            ],
            'tanggal' => [
              'label' => 'Tanggal',
              'type' => 'date',
              'value' => isset($pengeluaran) ? $pengeluaran->tanggal : null,
            ],
            'nama_kas_keluar' => [
              'label' => 'Nama Kas Keluar',
              'type' => 'input',
              'value' => isset($pengeluaran) ? $pengeluaran->nama_kas_keluar : null,
            ],
            'harga' => [
              'label' => 'Harga',
              'type' => 'input',
              'value' => isset($pengeluaran) ? $pengeluaran->harga : null,
            ],
            'qty' => [
              'label' => 'QTY',
              'type' => 'input',
              'value' => isset($pengeluaran) ? $pengeluaran->qty : null,
            ],
            'keterangan' => [
              'label' => 'Keterangan',
              'type' => 'textarea',
              'value' => isset($pengeluaran) ? $pengeluaran->keterangan : null,
            ],
          ],
          'mode' => isset($pengeluaran) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection