<form method="POST" action="{{ route('simpan') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">Upload</button>
</form>


@foreach ($imangess as $item)
<img src="{{ asset($item->path) }}" alt="" srcset="">
<br>
{{ $item->path }} <br>

@endforeach


