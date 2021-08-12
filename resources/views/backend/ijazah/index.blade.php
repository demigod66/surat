@extends('backend.template')
@section('sub-judul','Surat Keluar')
@section('halaman-sekarang','Surat Keluar')
@section('content')



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="{{ route('ijazah.create') }}" class="btn btn-primary btn-sm"><i
                            class="ti-pencil-alt"></i>Tambah</a>
                </div>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>NISN</th>
                            <th>No.Ijazah</th>
                            <th>Nama Siswa</th>
                            <th>Jurusan</th>
                            <th>Tgl.Lulus</th>
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
                ajax: "{{ route('ijazah.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'no_ijazah',
                        name: 'no_ijazah'
                    },

                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'tgl_lulus',
                        name: 'tgl_lulus'
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
          url : "ijazah/"+id,
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
