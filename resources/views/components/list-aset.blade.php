<div class="row">
  @foreach ($aset as $aset)
    <div class="col-lg-2">
      <div class="card">
        <div class="card-body text-center" style="padding: 0;">
          <img src="{{asset('images/' . $aset->gambar)}}" width="100%" style="width: 100%;height: 170px;">
          <div><b>{{$aset->kode}}</b></div>
          <div>{{$aset->nama}}</div>
          <div><a href="{{url($status ? 'status_aset/' . $aset->id : 'aset/' . $aset->id)}}">Detail</a></div>
        </div>
      </div>
    </div>
  @endforeach
</div>