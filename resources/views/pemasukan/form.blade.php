@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($pemasukan) ? url('pemasukan/' . $pemasukan->id) : url('pemasukan'),
          'fields' => [
            'nama' => [
              'label' => 'Nama Pemasukan',
              'type' => 'input',
              'value' => isset($pemasukan) ? $pemasukan->nama : null,
            ],
            'jasa_id' => [
              'label' => 'Nama Jasa',
              'type' => 'select',
              'value' => isset($pemasukan) ? $pemasukan->jasa_id : null,
              'data' => $jasa,
            ],
            'tip' => [
              'label' => 'Tip',
              'type' => 'input',
              'value' => isset($pemasukan) ? $pemasukan->tip : null,
            ],
          ],
          'mode' => isset($pemasukan) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection