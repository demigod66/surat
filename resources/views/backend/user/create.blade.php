@extends('backend.template')
@section('sub-judul','Tambah Data User')
@section('halaman-sekarang','Tambah Data User')
@section('content')




<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="{{ route('user.index') }}" class="btn btn-warning btn-sm">Kembali</a>
          </div>
        </div>
        <div class="card-body">

          <div class="row justify-content-center">
            <div class="col-md-6">
              <form class="form-horizontal" id="form">

                <div class="form-group">
                  <label>Nama User</label>
                  <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Input Nama" required>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="input email" required>
                </div>
                <div class="form-group">
                    <label>Tipe User</label>
                    <select name="tipe" id="tipe" class="form-control">
                        <option value="" holder>Pilih Tipe User</option>
                        <option value="1" holder>Administrator</option>
                        <option value="0" holder>Guru</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                  </div>
                <button type="button" onclick="simpan()" class="btn btn-info">Simpan</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



  <script text="text/javascript">


    function simpan(){
      const nama = $('#nama_user').val();
      const email = $('#email').val();
      const tipe = $('#tipe').val();
      if (nama.length == '') {
        swal({
          title: 'Nama User Wajib Diisi',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else if (email.length == '') {
        swal({
          title: 'Email wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (tipe.length == '') {
        swal({
          title: 'Pilih Tipe!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else {
        $.ajax({
          url : "{{ route('user.store') }}",
          type : "POST",
          data: new FormData($('#form')[0]),
          dataType: "JSON",
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data){
            swal({
              title: 'Berhasil',
              type: 'success',
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false,
            })
            .then(function(){
              window.location.href = "{{ route('user.index') }}";
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
        })
      }
    }



  </script>



@endsection
