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
              'type' => 'select',
              'value' => isset($barang) ? $barang->nama : null,
              'data' => [
                (object) [
                  'id' => 'Parfum Fabolous Sunday',
                  'nama' => 'Parfum Fabolous Sunday',
                ],
                (object) [
                  'id' => 'Parfum Forget THR Sunday',
                  'nama' => 'Parfum Forget THR Sunday',
                ],
                (object) [
                  'id' => 'Parfum Glorious Fruity',
                  'nama' => 'Parfum Glorious Fruity',
                ],
              ],
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