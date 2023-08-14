@role('it|manager|spv')
<a href="{{ route('datakandidat.edit', $data->id) }}" class="btn btn-primary btn-sm">View/Update</a>
@endrole


@role('it')
<a href='#'  class="btn btn-danger btn-sm tombol-del">DELETE</a>
@endrole