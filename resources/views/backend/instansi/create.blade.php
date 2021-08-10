@extends('backend.template')
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="{{ route('suratmasuk.index') }}" class="btn btn-warning btn-sm">Kembali</a>
          </div>
        </div>
        <div class="card-body">

          <div class="row justify-content-center">
            <div class="col-md-6">
              <form class="form-horizontal" id="form" enctype="multipart/form-data">

                <div class="form-group">
                  <label>Nama Instansi</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Input Nama Instansi">
                </div>
                  <div class="form-group">
                    <label>Alamat Instansi</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Input Alamat Instansi">
                  </div>
                  <div class="form-group">
                    <label>Nama Pimpinan</label>
                    <input type="text" class="form-control" name="pimpinan" id="pimpinan" placeholder="Input Nama Pimpinan">
                  </div>
                  <div class="form-group">
                    <label>Email Instansi</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Input Email Instansi">
                  </div>
                <div class="form-group">
                    <input type="file" name="file" id="file" class="form-control" accept=".jpeg,.png,.jpg">
                    <small id="validatedCustomFile" class="text-danger">
                        Pastikan file anda ( jpg,jpeg,png ) !!!
                    </small>
                    <div id="thumbnail-preview"></div>
                </div>
                <button type="button" onclick="simpan()" class="btn btn-info">Simpan</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>





  <script>
    function simpan(){
    const nama = $('#nama').val();
    const alamat = $('#alamat').val();
    const email = $('#email').val();
    const file = $('#file').val();
    if (nama.length == '') {
      swal({
        title: 'Nama Pimpinan Wajib Diisi!',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    }else if (alamat.length == '') {
      swal({
        title: 'Alamat wajib diisi!',
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
    }else if (file.length == '') {
      swal({
        title: 'Pilih File',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    } else {
      $.ajax({
        url : "{{ route('instansi.store') }}",
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
            window.location.href = "{{ route('instansi.index') }}";
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
