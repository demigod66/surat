@extends('backend.template')
@section('sub-judul','Update Profil')
@section('halaman-sekarang','Update Profil')
@section('content')


<div class="row">
    <div class="col-md-3">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
            src="{{ asset($user->foto) }}"
            alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{ $user->name }}</h3>
          <p class="text-muted text-center">{{ $user->email }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card">
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

          <form action="{{ url('user/update-profil', $user->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group row">
              <label for="" class="col-sm-2">Email</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2">Nama</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="{{ $user->name }}" name="nama">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2">Foto</label>
              <div class="col-sm-6">
                <input type="file" class="form-control" name="foto">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
