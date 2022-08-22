@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <?php
        $form = [
          'action' => isset($pemasukan) ? url('pemasukan/' . $pemasukan->id) : url('pemasukan'),
          'fields' => [
            'no_pemasukan' => [
              'label' => 'No Pemasukan',
              'type' => 'input',
              'value' => isset($pemasukan) ? $pemasukan->no_pemasukan : null,
            ],
            'tanggal' => [
              'label' => 'Tanggal',
              'type' => 'date',
              'value' => isset($pemasukan) ? $pemasukan->tanggal : null,
            ],
            'jenis_pemasukan' => [
              'label' => 'Jenis Pemasukan',
              'type' => 'select',
              'value' => isset($pemasukan) ? $pemasukan->jenis_pemasukan : null,
              'data' => [
                (object) [
                  'id' => 'barang',
                  'nama' => 'Barang',
                ],
                (object) [
                  'id' => 'jasa',
                  'nama' => 'Jasa',
                ],
              ],
              'onchange' => 'getBarangJasa(this, "barang_jasa_id")',
            ],
            'barang_jasa_id' => [
              'label' => 'Nama Barang/Jasa',
              'type' => 'select',
              'value' => isset($pemasukan) ?
                $pemasukan->jenis_pemasukan === 'barang' ?
                  $pemasukan->barang_id :
                  $pemasukan->jasa_id :
                null,
              'id' => 'barang_jasa_id',
              'data' => isset($pemasukan) ? $barang_jasa : null,
              'labelSelect' => function ($data) {
                return $data->nama . ' - ' . $data->harga;
              },
            ],
            'qty' => [
              'label' => 'QTY',
              'type' => 'input',
              'value' => isset($pemasukan) ? $pemasukan->qty : null,
            ],
            'diskon' => [
              'label' => 'Diskon',
              'type' => 'input',
              'value' => isset($pemasukan) ? $pemasukan->diskon : null,
            ],
            'keterangan' => [
              'label' => 'Keterangan',
              'type' => 'textarea',
              'value' => isset($pemasukan) ? $pemasukan->keterangan : null,
            ],
          ],
          'mode' => isset($pemasukan) ? 'edit' : null,
        ];
      ?>
      <x-form :form=$form/>
    </div><!-- /.container-fluid -->
  </div>
@endsection