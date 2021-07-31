@extends('backend.template')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-primary btn-sm" onclick="tambah()"><i
                            class="ti-pencil-alt"></i>Tambah</button>
                    </div>
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#importKlasifikasi">
                        <i class="ti-import"></i> Import Klasifikasi
                        </button>
                        {{-- notifikasi form validasi --}}
                        <div class="pt-4">
                        @if ($errors->has('file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                        @endif

                        {{-- notifikasi sukses --}}
                        @if ($sukses = Session::get('sukses'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $sukses }}</strong>
                        </div>
                        @endif
                    </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Uraian</th>
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

    {{-- tambah klasifikasi --}}
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalId"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="Form" method="POST" name="Form"
                        class="form-horizontal">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="" class="col-sm-6 control-label">Nama *</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama Klasifikasi" maxlength="50" required>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6 control-label">Kode *</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kode" name="kode"
                                    placeholder="Masukkan Kode Klasifikasi" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-6 control-label">Uraian *</label>
                        <div class="col-sm-12">
                            <textarea name="uraian" class="form-control bg-light" id="uraian" rows="3"
                            placeholder="Uraian Klasifikasi" required></textarea>
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
    {{-- end of tambah data --}}


    {{-- modal import data --}}
    <div class="modal fade" id="importKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i
                                class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Import File Klasifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="{{ url('klasifikasi.import') }}" method="POST" name="importform"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="klasifikasi" class="form-control">
                                <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-sm btn-primary" value="Import">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end of import data --}}




    <script type="text/javascript">
        $(document).ready(function() {
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ route('klasifikasi.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'uraian',
                        name: 'uraian'
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
            $('#Form').trigger("reset");
            $('.help-block').empty();
            $('#ajaxModal').modal('show');
            $('.modal-title').text('Tambah Klasifikasi');
        }


        function get(id) {
            $.ajax({
                url: "{{ route('klasifikasi.index') }}" + "/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="kode"]').val(data.kode);
                    $('[name="uraian"]').val(data.uraian);
                    $('#ajaxModal').modal('show');
                    $('.modal-title').text('Edit Klasifikasi');
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
                url: "{{ route('klasifikasi.store') }}",
                data: new FormData($('#Form')[0]),
                type: "POST",
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#Form').trigger("reset");
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
                    url: "klasifikasi/" + id,
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
