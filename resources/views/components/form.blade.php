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
          <label>{{$value['label']}}</label>
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
                  <option disabled></option>
                  @foreach ($value['data'] as $valueData)
                    <option value="{{ $valueData->id }}" <?= $value['value'] === $valueData->id ? 'selected' : ''; ?>>{{ isset($value['labelSelect']) ? $value['labelSelect']($valueData) : $valueData->nama }}</option>
                  @endforeach
                @endif
              </select>
              @break
          @endswitch
        </div>
      @endforeach
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>