@extends('backend.template')
@section('sub-judul','Tambah Surat Keluar')
@section('halaman-sekarang','Tambah Surat Keluar')
@section('content')




<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="{{ route('ijazah.index') }}" class="btn btn-warning btn-sm">Kembali</a>
          </div>
        </div>
        <div class="card-body">

          <div class="row justify-content-center">
            <div class="col-md-6">
              <form class="form-horizontal" id="form" enctype="multipart/form-data">
                @method('PUT')

                <div class="form-group">
                  <label>NISN</label>
                  <input type="text" class="form-control" name="nisn" id="nisn"  value="{{ $ijazah->nisn }}" required>
                  <div class="text-danger">@error('nisn') {{ $message }} @enderror</div>
                </div>
                <div class="form-group">
                  <label>No. Ijazah</label>
                  <input type="text" class="form-control" name="no_ijazah" id="no_ijazah" value="{{ $ijazah->no_ijazah }}"  required>
                  <div class="text-danger">@error('no_ijazah') {{ $message }} @enderror</div>
                </div>
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" value="{{ $ijazah->nama_siswa }}" required>
                    <div class="text-danger">@error('nama_siswa') {{ $message }} @enderror</div>
                  </div>
                  <div class="form-group">
                    <label>Jurusan</label>
                    <select class="form-control" name="jurusan" id="jurusan">
                        <option value="" holder>Pilih Jurusan</option>
                        <option value="IPA" holder
                        @if($ijazah->jurusan == "IPA")
                        selected
                        @endif
                        >IPA</option>
                        <option value="IPS" holder
                        @if($ijazah->jurusan == "IPS")
                        selected
                        @endif
                        >IPS</option>
                    </select>
                    <div class="text-danger">@error('jurusan') {{ $message }} @enderror</div>
                  </div>
                  <div class="form-group">
                      <label for="">Tanggal Lulus</label>
                      <input type="date" name="tgl_lulus" class="form-control" id="tgl_lulus" value="{{ $ijazah->tgl_lulus }}" required>
                      <div class="text-danger">@error('tgl_lulus') {{ $message }} @enderror</div>
                  </div>
                <div class="form-group">
                    <input type="file" name="filekeluar" id="filekeluar" class="form-control">
                    <div class="text-danger">@error('filekeluar') {{ $message }} @enderror</div>
                    <small id="validatedCustomFile" class="text-danger">
                        Pastikan file anda ( .pdf ) !!!
                    </small>
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
      const nisn = $('#nisn').val();
      const no_ijazah = $('#no_ijazah').val();
      const nama = $('#nama_siswa').val();
      const jurusan = $('#jurusan').val();
      const tgl_lulus = $('#tgl_lulus').val();
      if (nisn.length == '') {
        swal({
          title: 'nisn Wajib Diisi',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else if (no_ijazah.length == '') {
        swal({
          title: 'No.Ijazah wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (nama.length == '') {
        swal({
          title: 'Nama Siswa wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (jurusan.length == '') {
        swal({
          title: 'pilih jurusan!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }else if (tgl_lulus.length == '') {
        swal({
          title: 'Tanggal lulus wajib diisi!',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      } else {
        $.ajax({
          url : "{{ route('ijazah.update', $ijazah->id) }}",
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
              window.location.href = "{{ route('ijazah.index') }}";
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
