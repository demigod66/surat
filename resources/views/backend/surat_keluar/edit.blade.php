@extends('backend.template')
@section('sub-judul','Edit Surat Keluar')
@section('halaman-sekarang','Edit Surat Keluar')
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="{{ route('suratkeluar.index') }}" class="btn btn-warning btn-sm">Kembali</a>
          </div>
        </div>
        <div class="card-body">

          <div class="row justify-content-center">
            <div class="col-md-6">
              <form class="form-horizontal" id="form" enctype="multipart/form-data">
              @method('PUT')
                <div class="form-group">
                  <label>No.Surat</label>
                  <input type="text" class="form-control" name="no_surat" id="no_surat" value="{{ $suratkeluar->no_surat }}">
                </div>
                <div class="form-group">
                    <label>Tujuan Surat</label>
                    <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat" value="{{ $suratkeluar->no_surat }}">
                  </div>
                <div class="form-group">
                  <label>Isi Ringkas</label>
                  <textarea class="form-control" name="isi_surat" id="isi_surat">{{ $suratkeluar->isi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Surat</label>
                    <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" value="{{ $suratkeluar->tgl_surat}}" readonly>
                </div>
                <div class="form-group">
                  <label for="">Tanggal Catat</label>
                  <input type="date" name="tgl_catat" class="form-control" id="tgl_catat" value="{{ $suratkeluar->tgl_catat }}" readonly>
              </div>
                <div class="form-group">
                    <label>Kode Klasifikasi</label>
                    <select name="klasifikasi" class="form-control" id="klasifikasi"
                        value="{{$suratkeluar->kode}}" required>
                        <option selected>{{$suratkeluar->kode}}</option>
                        @foreach($klasifikasi as $result)
                        <option value="{{$result->kode}}">{{$result->nama}} ( {{$result->kode}} )
                        </option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $suratkeluar->keterangan }}">
                  </div>
                <div class="form-group">
                  <label>File</label>
                  <input type="file" class="form-control" name="filekeluar" id="filekeluar" placeholder="Input Nama">
                  <small id="validatedCustomFile" class="text-danger">
                    Pastikan file anda ( doc,docx,pdf ) !!!
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


<script>

function simpan(){
    const nosurat = $('#no_surat').val();
    const tujuan = $('#tujuan_surat').val();
    const isi = $('#isi_surat').val();
    const klasifikasi = $('#klasifikasi').val();
    const keterangan = $('#keterangan').val();
    if (nosurat.length == '') {
      swal({
        title: 'No.Surat Wajib Diisi!',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    } else if (tujuan.length == '') {
      swal({
        title: 'Tujuan Surat Wajib Diisi!',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    } else if (isi.length == '') {
      swal({
        title: 'Isi Ringkas Wajib Diisi!',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    } else if (klasifikasi.length == '') {
      swal({
        title: 'Pilih Klasifikasi!',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    } else if (keterangan.length == '') {
      swal({
        title: 'Keterangan Wajib Diisi!',
        type: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      })
    } else {
      $.ajax({
        url : "{{ route('suratkeluar.update', $suratkeluar->id) }}",
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


