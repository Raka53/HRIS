<a href="{{ route('datakaryawanAjax.edit', $data->id) }}" class="btn btn-primary btn-sm">View/Update</a>
<a href='#' data-id="{{ $data->id }}" class="btn btn-danger btn-sm tombol-del">DELETE</a>

{{-- <form action="{{ route('datakaryawan.destroy', $data->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Hapus</button>
</form> --}}