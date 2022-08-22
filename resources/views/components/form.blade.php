<div class="card">
  <form method="post" action="{{$form['action']}}" enctype="multipart/form-data">
    @csrf
    {{ $form['mode'] === 'edit' ? method_field('PUT') : '' }}
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @foreach ($form['fields'] as $key => $value)
        <div class="form-group">
          @if ($value['label'])
            <label>{{$value['label']}}</label>
          @endif
          @switch ($value['type'])
            @case('input')
              <input
                type="text"
                class="form-control"
                placeholder="Ketik disini..."
                name="{{$key}}"
                value="{{$value['value']}}"
              >
              @break
            @case('password')
              <input
                type="password"
                class="form-control"
                placeholder="Ketik disini..."
                name="{{$key}}"
              >
              @break
            @case('date')
              <input
                type="date"
                class="form-control"
                placeholder="Ketik disini..."
                name="{{$key}}"
                value="{{$value['value']}}"
              >
              @break
            @case('textarea')
              <textarea
                name="{{$key}}"
                cols="20"
                rows="5"
                placeholder="Ketik disini..."
                class="form-control"
              >{{$value['value']}}</textarea>
              @break
            @case('file')
              <input
                type="file"
                class="form-control-file"
                name="foto"
                onchange="previewImg()"
                id="foto"
              >
              <div class="text-center">
                <img class="img-preview" width="100%" src="{{asset('images/' . $value['value'])}}")>
              </div>
              @break
            @case('select')
              <select
                name="{{ $key }}"
                class="form-control select2bs4"
                onchange="{{ isset($value['onchange']) ? $value['onchange'] : '' }}"
                id="{{ isset($value['id']) ? $value['id'] : '' }}"
              >
                @if (isset($value['data']))
                  <option disabled selected></option>
                  @foreach ($value['data'] as $valueData)
                    <option value="{{ $valueData->id }}" <?= $value['value'] === $valueData->id ? 'selected' : ''; ?>>{{ isset($value['labelSelect']) ? $value['labelSelect']($valueData) : $valueData->nama }}</option>
                  @endforeach
                @endif
              </select>
              @break
          @endswitch
        </div>
      @endforeach
      @if (str_contains($form['action'], 'jasa'))
        <div class="form-group" id="fieldTipe">
          <div class="row">
            <div class="col-5">
              <label>Tipe Pelayanan</label>
              <input
                type="text"
                class="form-control"
                placeholder="Ketik disini..."
                name="tipe[]"
              >
            </div>
            <div class="col-5">
              <label>Harga</label>
              <input
                type="text"
                class="form-control"
                placeholder="Ketik disini..."
                name="harga[]"
              >
            </div>
            <div class="col-2" style="padding-top: 2rem;">
              <button class="btn btn-primary" onClick="tambahField(0)" type="button"><i class="fas fa-plus"></i></button>
            </div>
          </div>
        </div>
      @endif
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>