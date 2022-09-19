@extends('template')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <form>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                  <input type="date" class="form-control" name="tanggal_awal"/>
                </div>
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <input type="date" class="form-control" name="tanggal_akhir"/>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button
              type="submit"
              name="pdf"
              value="pdf"
              class="btn btn-primary"
            >
              PDF
            </button>
          </form>
        </div>
        <div class="card-body">
          <table class="table" width="100%">
            <tbody>
              <tr>
                <td>Periode</td>
                <td>
                  {{ $from . '/' . $to }}
                </td>
              </tr>
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
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
@endsection