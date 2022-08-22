@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($jasa) ? url('jasa/' . $jasa->id) : url('jasa'),
          'fields' => [
            'nama' => [
              'label' => 'Nama Jasa',
              'type' => 'input',
              'value' => isset($jasa) ? $jasa->nama : null,
            ],
          ],
          'mode' => isset($jasa) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection