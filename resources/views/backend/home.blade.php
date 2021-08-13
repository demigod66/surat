@extends('backend.template')
@section('title', 'Home')
@section('content')


<div class="text-center">
    <h3 style="font-family:Lobster Two"><u>SELAMAT DATANG DI SISTEM INFORMASI ARSIP SURAT SMANSA</u></h3>
</div>


<div class="pt-4">
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $suratmasukcount }}</h3>

          <p>Surat Masuk</p>
        </div>
        <div class="icon">
          <i class="ion ion-email"></i>
        </div>
        <a href="{{ route('suratmasuk.index') }}" class="small-box-footer">Klik Untuk Membuka <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $suratkeluarcount }}</h3>

          <p>Surat Keluar</p>
        </div>
        <div class="icon">
          <i class="ion ion-email"></i>
        </div>
        <a href="{{ route('suratkeluar.index') }}" class="small-box-footer">Klik Untuk Membuka <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $arsipgurucount }}</h3>

          <p>Arsip Staff/Guru</p>
        </div>
        <div class="icon">
          <i class="ion ion-archive"></i>
        </div>
        <a href="{{ route('arsipguru.index') }}" class="small-box-footer">Klik Untuk Membuka <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $userscount }}</h3>

          <p>Total User</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <a href="{{ route('user.index') }}" class="small-box-footer">Klik Untuk Membuka<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <div class="col-lg-3 col-6" style="width: 21.5em;margin:0 auto;">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $ijazahcount }}</h3>

        <p>Arsip Ijazah</p>
      </div>
      <div class="icon">
        <i class="ion ion-person"></i>
      </div>
      <a href="{{ route('user.index') }}" class="small-box-footer">Klik Untuk Membuka<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
</div>


@endsection
