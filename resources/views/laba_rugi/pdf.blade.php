<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div style="text-align:center">
    <b>Laporan Laba/Rugi</b>
  </div>
  <table class="table" width="100%">
    <tbody>
      <tr>
        <td colspan="2"><b>Pendapatan</b></td>
      </tr>
      <?php $totalPendapatan = 0; ?>
      @foreach ($pemasukan as $pemasukan)
        <tr>
          @switch ($pemasukan->jenis_pemasukan)
            @case ('barang')
              <?php $totalPendapatan += $pemasukan->barang->harga; ?>
              <td>{{ $pemasukan->barang->nama }}</td>
              <td>{{ format_rupiah($pemasukan->barang->harga) }}</td>
              @break
            @case ('jasa')
              <?php $totalPendapatan += $pemasukan->tipe->harga; ?>
              <td>{{ $pemasukan->jasa->nama }}</td>
              <td>{{ format_rupiah($pemasukan->tipe->harga) }}</td>
              @break
          @endswitch
        </tr>
      @endforeach
      <tr>
        <td>Total Pendapatan</td>
        <td><b>{{ format_rupiah($totalPendapatan) }}</b></td>
      </tr>
      <tr>
        <td colspan="2"><b>Beban</b></td>
      </tr>
      <?php $totalPengeluaran = 0; ?>
      @foreach ($pengeluaran as $pengeluaran)
        <?php $totalPengeluaran += $pengeluaran->harga; ?>
        <tr>
          <td>{{ $pengeluaran->nama_kas_keluar }}</td>
          <td>{{ format_rupiah($pengeluaran->harga) }}</td>
        </tr>
      @endforeach
      <tr>
        <td>Total Pengeluaran</td>
        <td><b>{{ format_rupiah($totalPengeluaran) }}</b></td>
      </tr>
      <tr>
        <td>Laba/Rugi Bersih</td>
        <td><b>{{ format_rupiah($totalPendapatan - $totalPengeluaran) }}</b></td>
      </tr>
    </tbody>
  </table>
</body>
</html>