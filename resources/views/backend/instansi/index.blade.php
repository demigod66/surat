@extends('backend.template')
@section('sub-judul','Edit Instansi')
@section('halaman-sekarang','AEdit Instansi')
@section('content')


<section class="content card" style="padding: 10px 10px 10px 10px ">
    <h3><i class="nav-icon fas fa-warehouse my-1 btn-sm-1"></i> Profil Instansi</h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-9">
                        <h3 class="font-weight-bold">{{ $instansi->nama }}</h3>
                        <ul class="ml-4 mb-0 fa-ul text-black">
                            <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-user-tie"></i></span>
                                <h4>Pimpinan
                                    &nbsp;: {{ $instansi->pimpinan }}</h4>
                            </li>
                            <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt"></i></span>
                                <h4>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $instansi->alamat }}</h4>
                            </li>
                            <li><span class="fa-li"><i class="fas fa-lg fa-at"></i></span>
                                <h4>Email
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $instansi->email }}</h4>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ asset($instansi->file) }}" data-toggle="lightbox" data-title="Lihat Logo Instansi">
                        <center>
                            <img id="logo" src="{{ asset($instansi->file) }}" alt="Logo Instansi" class="rounded"
                                width="200"><br>
                        </center>
                    </a>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-md-6">
        <a class="btn btn-primary btn-md" href="{{ route('instansi.show', $instansi->id) }}" role="button"><i
                class="fas fa-plus"></i> Setting Data Instansi</a>
    </div>
</section>



@endsection
