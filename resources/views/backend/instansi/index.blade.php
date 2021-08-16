@extends('backend.template')
@section('sub-judul','Instansi')
@section('halaman-sekarang','Instansi')
@section('content')



<section class="content pt-2">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex p-0">
            <ul class="nav nav-pills p-2">
              <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Profil</a></li>
            </ul>
          </div>
          <div class="card-body">
            @if(session()->has('success'))
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fas fa-exclamation-triangle"></i> {{ session()->get('success') }}</h6>
                  </div>
                </div>
              </div>
            </div>
            @endif

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <form action="{{ route('instansi.update', $instansi->id) }}" class="form-horizontal" enctype="multipart/form-data" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row justify-content-center">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $instansi->nama }}" maxlength="15">
                        <div class="text-danger">@error('nama') {{ $message }} @enderror</div>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $instansi->email }}">
                        <div class="text-danger">@error('email') {{ $message }} @enderror</div>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $instansi->alamat }}">
                        <div class="text-danger">@error('alamat') {{ $message }} @enderror</div>
                      </div>
                      <div class="form-group">
                        <label for="sambutan">Pimpinan</label>
                        <input type="text" name="pimpinan" id="pimpinan" class="form-control" value="{{ $instansi->pimpinan }}">
                        <div class="text-danger">@error('pimpinan') {{ $message }} @enderror</div>
                      </div>
                      <div class="form-group">
                        <label for="preview">Preview</label>
                        <div class="row">
                          <div class="col-12">
                            <img src="{{ asset($instansi->file) }}" class="img-thumbnail">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="foto">Ganti Logo</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".jpg, .png, .jpeg">
                      </div>
                      <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
  </section>

@endsection
