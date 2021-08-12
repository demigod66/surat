@extends('backend.template')
@section('sub-judul','Arsip Guru')
@section('halaman-sekarang','Arsip Guru')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <button class="btn btn-primary btn-sm" onclick="tambah()"><i
                            class="ti-pencil-alt"></i>Tambah</button>
                </div>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="form" method="POST" name="categoryForm"
                    class="form-horizontal">
                    <input type="hidden" name="id" id="id">

                    @if (Auth::user()->tipe == 1)
                        <div class="form-group">
                            <label for="namauser" class="col-sm-6 control-label">Nama User</label>
                            <div class="col-sm-12">
                                <select name="iduser" id="iduser" class="form-control">
                                    <option value="">- Pilih -</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="" class="col-sm-6 control-label">File</label>
                        <div class="col-sm-12">
                            <input type="file" name="file[]" id="file" class="form-control" accept=".pdf" multiple>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" onclick="simpan()" id="btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function() {
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ route('arsipguru.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'asc']
                ]
            });
    });

    function tambah() {
            $('#categoryId').val('');
            $('#form').trigger("reset");
            $('.help-block').empty();
            $('#ajaxModal').modal('show');
            $('.modal-title').text('Tambah Arsip');
    }

    function simpan() {
            $.ajax({
                url: "{{ route('arsipguru.store') }}",
                data: new FormData($('#form')[0]),
                type: "POST",
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#categoryForm').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    swal({
                        title: 'Berhasil',
                        type: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title: 'Terjadi kesalahan',
                        type: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                }
            });
        }
</script>

@endsection
