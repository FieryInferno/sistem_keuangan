@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($pemasukan) ? url('pemasukan/' . $pemasukan->id) : url('pemasukan'),
          'fields' => [
            'pemasukan' => [
              'label' => 'Pemasukan',
              'type' => 'input',
              'value' => isset($pemasukan) ? $pemasukan->nama : null,
            ],
          ],
          'mode' => isset($pemasukan) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection