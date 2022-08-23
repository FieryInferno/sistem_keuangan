<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jurnal</title>
</head>
<body>
  <table class="table" id="tableJurnal" width="100%">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Jenis Pemasukan</th>
        <th>Nama Barang/Jasa</th>
        <th>Nama Kas Keluar</th>
        <th>Keterangan</th>
        <th>Debit</th>
        <th>Kredit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $key)
        <tr>
          <td>{{ $key->tanggal }}</td>
          <td>{{ $key->jenis_pemasukan }}</td>
          <td>
            <?php
              switch ($key->jenis_pemasukan) {
                case 'barang':
                  echo $key->barang->nama;
                  break;
                case 'jasa':
                  echo $key->jasa->nama;
                  break;
                
                default:
                  # code...
                  break;
              }
            ?>
          </td>
          <td>{{ $key->nama_kas_keluar }}</td>
          <td>{{ $key->keterangan }}</td>
          <td>
            <?php
              if ($key->jenis_pemasukan) {
                $harga = 0;
    
                switch ($key->jenis_pemasukan) {
                  case 'barang':
                    $harga = $key->barang->harga;
                    break;
                  case 'jasa':
                    $harga = $key->is_express === 'true' ? $key->tipe->harga + 10000 : $key->tipe->harga;
                    break;
                  
                  default:
                    # code...
                    break;
                }
    
                $totalHarga = $harga * $key->qty;
    
                if ($key->diskon) {
                  echo $totalHarga - ($totalHarga * $key->diskon / 100);
                } else {
                  echo $totalHarga;
                }
              }
            ?>
          </td>
          <td>
            <?php
              if ($key->nama_kas_keluar) {
                echo $key->harga * $key->qty;
              }
            ?>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
