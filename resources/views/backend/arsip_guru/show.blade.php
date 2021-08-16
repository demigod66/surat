@extends('backend.template')
@section('sub-judul','File Arsip Guru')
@section('halaman-sekarang','File Arsip Guru')
@section('content')


<div class="row">
    @foreach ( $arsip as $a )
<div class="col-md-3">
<div class="card" style="width: 10rem; height: 10rem;">
    <img src="{{ asset('backend/assets/dist/img/pdfimage.jpg') }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $a->nama_file }}</h5>
      <a href="{{ asset('uploads/arsipguru')  }}/{{ $a->nama_file }}" class="btn btn-primary btn-sm">Lihat/ Download</a>
      <br><br>
      <form action="{{ route('arsipguru.destroy', $a->id )}}" method="POST">
        @csrf
		@method('delete')
      <button type="submit" class="btn btn-danger  btn-sm ">Hapus</button>
    </div>
  </div>
</div>
@endforeach
</div>

@endsection
