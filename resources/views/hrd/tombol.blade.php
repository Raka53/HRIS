@role('it|manager|spv')
<a href="{{ route('datakaryawanAjax.edit', $data->id) }}" class="btn btn-primary btn-sm">View/Update</a>
@endrole


@role('it')
<a href='#' data-id="{{ $data->id }}" data-karyawan-id="{{ $data->karyawan_id }}" class="btn btn-danger btn-sm tombol-del">DELETE</a>
@endrole