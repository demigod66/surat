@extends('backend.template')
@section('sub-judul','Edit Instansi')
@section('halaman-sekarang','AEdit Instansi')
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
                @method('PUT')
                <div class="form-group">
                  <label>Nama Instansi</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="{{ $instansi->nama }}" placeholder="Input Nama Instansi">
                </div>
                  <div class="form-group">
                    <label>Alamat Instansi</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $instansi->alamat }}" placeholder="Input Alamat Instansi">
                  </div>
                  <div class="form-group">
                    <label>Nama Pimpinan</label>
                    <input type="text" class="form-control" name="pimpinan" id="pimpinan" value="{{ $instansi->pimpinan }}" placeholder="Input Nama Pimpinan">
                  </div>
                  <div class="form-group">
                    <label>Email Instansi</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $instansi->email }}" placeholder="Input Email Instansi">
                  </div>
                <div class="form-group">
                    <input type="file" name="file" id="file" class="form-control" accept=".jpeg,.png,.jpg">
                    <small id="validatedCustomFile" class="text-danger">
                        Pastikan file anda ( jpg,jpeg,png ) !!!
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



@endsection
