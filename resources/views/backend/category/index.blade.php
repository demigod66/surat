@extends('backend.index')
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
                                <th>Nama Kategori</th>
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
                    <h4 class="modal-title" id="categoryModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="categoryForm" method="POST" name="categoryForm"
                        class="form-horizontal">
                        <input type="hidden" name="categoryId" id="categoryId">
                        <div class="form-group">
                            <label for="category_name" class="col-sm-6 control-label">Nama Category</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    placeholder="Masukkan Nama Kategori" maxlength="50" required="">
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




    <script type="text/javascript">
        $(document).ready(function() {
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
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
        })
        function tambah() {
            $('#categoryId').val('');
            $('#categoryForm').trigger("reset");
            $('.help-block').empty();
            $('#ajaxModal').modal('show');
            $('.modal-title').text('Tambah Kategori');
        }
        function get(id) {
            $.ajax({
                url: "{{ route('category.index') }}" + "/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="categoryId"]').val(data.id);
                    $('[name="category_name"]').val(data.nama);
                    $('#ajaxModal').modal('show');
                    $('.modal-title').text('Edit Kategori');
                    $('.help-block').empty();
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
        function simpan() {
            $.ajax({
                url: "{{ route('category.store') }}",
                data: new FormData($('#categoryForm')[0]),
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
        function hapus(id) {
            swal({
                title: 'Apakah kamu yakin?',
                type: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                buttons: true
            }).then(function() {
                $.ajax({
                    url: "category/" + id,
                    type: "delete",
                    dataType: "JSON",
                    success: function() {
                        swal({
                            title: 'Berhasil',
                            type: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        }).then(function() {
                            location.reload();
                        })
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
            }, function(dismiss) {
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Batal',
                        type: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    })
                }
            });
        }
    </script>


@endsection
