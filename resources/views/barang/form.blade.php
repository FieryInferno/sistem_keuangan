@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($barang) ? url('barang/' . $barang->id) : url('barang'),
          'fields' => [
            'nama' => [
              'label' => 'Nama Barang',
              'type' => 'input',
              'value' => isset($barang) ? $barang->nama : null,
            ],
            'qty' => [
              'label' => 'QTY',
              'type' => 'input',
              'value' => isset($barang) ? $barang->qty : null,
            ],
            'harga' => [
              'label' => 'Harga',
              'type' => 'input',
              'value' => isset($barang) ? $barang->harga : null,
            ],
          ],
          'mode' => isset($barang) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection