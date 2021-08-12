@extends('backend.template')
@section('sub-judul','Manajemen User')
@section('halaman-sekarang','Manajemen User')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm" ><i
                            class="ti-pencil-alt"></i>Tambah</a>
                </div>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama Pegawai</th>
                            <th>Email</th>
                            <th>Tipe User</th>
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




<script type="text/javascript">
    $(document).ready(function() {
        table = $('#example2').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('user.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {data: function (data, type, row, meta) {
                if(data.tipe == 1) {
                    return 'Administrator';
                }
                return 'Guru';
                }
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

    function hapus(id){
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
      }).then(function(){
        $.ajax({
          url : "user/"+id,
          type: "delete",
          dataType: "JSON",
          success: function(){
            swal({
              title: 'Berhasil',
              type: 'success',
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false,
            }).then(function(){
              location.reload();
            })
          },
          error: function (jqXHR, textStatus, errorThrown){
            swal({
              title: 'Terjadi kesalahan',
              type: 'error',
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false,
            });
          }
        });
      }, function (dismiss) {
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
