<div class="card" style="background-color: #58dfa0;box-shadow: 0 0 0;">
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
          @endswitch
        </div>
      @endforeach
    </div>
    <div class="card-footer text-center">
      <button type="submit" class="btn btn-light">{{$form['buttonText']}}</button>
    </div>
  </form>
</div>