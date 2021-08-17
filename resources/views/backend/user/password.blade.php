@extends('backend.template')
@section('sub-judul','Password')
@section('halaman-sekarang','Password')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">

				@if(session()->has('error'))
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h6><i class="icon fas fa-exclamation-triangle"></i> {{ session()->get('error') }}</h6>
							</div>
						</div>
					</div>
				</div>
				@endif

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

				<form action="{{ url('user/ubah-password') }}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="" class="col-sm-2">Password Lama</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="pass_lama">
							<div class="text-danger">@error('pass_lama') {{ $message }} @enderror</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-sm-2">Password Baru</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="pass_baru">
							<div class="text-danger">@error('pass_baru') {{ $message }} @enderror</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-sm-2">Confirmasi Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="pass_conf">
							<div class="text-danger">@error('pass_conf') {{ $message }} @enderror</div>
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
