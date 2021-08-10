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
                  <label>Nomor Surat</label>
                  <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Input Nomor Surat" required>
                </div>
                <div class="form-group">
                  <label>Tujuan Surat</label>
                  <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat" placeholder="Input Tujuan Surat" required>
                </div>
                <div class="form-group">
                    <label>Isi Ringkas</label>
                    <textarea class="form-control"  name="isisurat" id="isisurat"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Kode Klasifikasi</label>
                    <select class="form-control" name="klasifikasi" id="klasifikasi">
                      <option value="" holder>Pilih Kode Klasifikasi</option>
                      @foreach ($klasifikasi as $result)
                      <option value="{{$result->kode }}">{{ $result->nama }} ( {{$result->kode}} )</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="">Tanggal Surat</label>
                      <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" required>
                  </div>
                  <div class="form-group">
                    <label for="">Tanggal Catat</label>
                    <input type="date" name="tgl_catat" class="form-control" id="tgl_catat" required>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Input Keterangan" required>
                </div>
                <div class="form-group">
                    <input type="file" name="filekeluar" id="filekeluar" class="form-control">
                    <small id="validatedCustomFile" class="text-danger">
                        Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
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



  <script text="text/javascript">


    function simpan(){
      const nosurat = $('#no_surat').val();
      const tujuan = $('#tujuan_surat').val();
      const isisurat = $('#isisurat').val();
      const klasifikasi = $('#klasifikasi').val();
      const tglsurat = $('#tgl_surat').val();
      const tglcatat = $('#tgl_catat').val();
      const keterangan = $('#keterangan').val();
      const filekeluar = $('#filekeluar').val();
      if (nosurat.length == '') {
        swal({
          title: 'No.Surat Wajib Diisi',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else if (tujuan.length == '') {
        swal({
          title: 'Tujuan wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (isisurat.length == '') {
        swal({
          title: 'Isi surat wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (klasifikasi.length == '') {
        swal({
          title: 'Kode Klasifikasi wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (tglsurat.length == '') {
        swal({
          title: 'Tanggal Surat wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else if (tglcatat.length == '') {
        swal({
          title: 'Tanggal Catat wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (keterangan.length == '') {
        swal({
          title: 'Keterangan wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (filekeluar.length == '') {
        swal({
          title: 'Pilih File',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else {
        $.ajax({
          url : "{{ route('suratkeluar.store') }}",
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
              window.location.href = "{{ route('suratkeluar.index') }}";
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
