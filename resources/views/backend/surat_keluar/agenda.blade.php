@extends('backend.template')
@section('sub-judul','Agenda Surat Keluar')
@section('halaman-sekarang','Agenda Surat Keluar')
@section('content')


@if(Session::has('success'))
<div class="alert alert-success" role="alert">
{{ Session('success') }}
</div>
@endif


<div class="row">
    <span style="float: right">
    <a href="{{ route('auth.cetakkeluar_pdf') }}" class="btn btn-danger" target="_blank" role="button"><i class="ti-printer"></i>Cetak Pdf</a>
</span>
</div>

<br><br>

<table class="table table-striped table-hover table-sm table-bordered">
  <thead>
      <tr>
          <th>No</th>
          <th>Isi Surat</th>
          <th>Tujuan Surat</th>
          <th>Kode</th>
          <th>No.Surat</th>
          <th>Tgl.Surat</th>
          <th>Tgl.Catat</th>
          <th>Keterangan</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($suratkeluar as $result)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $result->isi }}</td>
          <td>{{ $result->tujuan_surat }}</td>
          <td>{{ $result->kode }}</td>
          <td>{{ $result->no_surat }}</td>
          <td>{{ $result->tgl_surat }}</td>
          <td>{{ $result->tgl_catat }}</td>
          <td>{{ $result->keterangan }}</td>

      </tr>
      @endforeach

  </tbody>
</table>


@endsection
