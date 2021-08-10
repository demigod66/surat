@extends('backend.template')
@section('content')


<div class="row">
    @foreach ( $arsip as $a )
<div class="col-md-3">
<div class="card" style="width: 10rem; height: 10rem;">
    <img src="{{ asset('backend/assets/images/pdf.png') }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $a->nama_file }}</h5>
      <a href="{{ asset('uploads/arsipguru')  }}/{{ $a->nama_file }}" class="btn btn-primary">Lihat/ Download</a>
    </div>
  </div>
</div>
@endforeach
</div>

@endsection
