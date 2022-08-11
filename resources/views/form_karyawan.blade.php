@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($user) ? url('karyawan/' . $user->id) : url('karyawan'),
          'fields' => [
            'nama' => [
              'label' => 'Nama',
              'type' => 'input',
              'value' => isset($user) ? $user->nama : null,
            ],
            'username' => [
              'label' => 'Username',
              'type' => 'input',
              'value' => isset($user) ? $user->username : null,
            ],
            'password' => [
              'label' => 'Password',
              'type' => 'password',
            ],
          ],
          'mode' => isset($user) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection