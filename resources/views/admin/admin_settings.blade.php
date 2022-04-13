@extends('layouts.admin_layout.admin_layout')

@section('content') 
<section class="content-header bg-white">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-md-3"></div>
			<div class="col-sm-6">
				<h1>Dashboard Settings</h1>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</section>
<section class="content bg-white mt-2">
  <div class="container-fluid">
	<div class="row">
		<!-- left column -->
		<div class="col-md-3"></div>
		<div class="col-md-6">
		  <div class="m-2">
			@if ($errors->any())
			  <div class="alert alert-danger alert-dismissible">
				  <ul>
					  @foreach ($errors->all() as $error)
						  <li>{{ $error }}</li>
					  @endforeach
				  </ul>
			  </div>
			@endif

			@if(Session::has("error_message")) 
			  <div class="alert alert-danger alert-dismissible" role="alert">
					  {{ Session::get("error_message") }}                
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
			  </div>
			@endif

			@if(Session::has("success_message")) 
			<div class="alert alert-success alert-dismissible" role="alert">
					{{ Session::get("success_message") }}                
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		  @endif
		  </div>
		  <!-- general form elements -->
		  <div class="card">
			<div class="card-header">
			  <h3 class="card-title">Update Admin Password</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form action="{{route("admin.update.password")}}" method="POST">
			  @csrf
			  <div class="card-body">

				<div class="form-group">
					<label for="setting-email">Email address</label>
					<input type="email" name="email" value="{{ $adminDetails->email }}" class="form-control" id="setting-email" placeholder="Enter email" required>
				</div>
				<div class="form-group">
					<label for="setting-password">Admin type</label>
					<input type="text" name="admin-type" value="" class="form-control" id="setting-admin-type" placeholder="Admin type" required>
				</div>
				<div class="form-group">
				  <label for="setting-current-password">Current password</label>
				  <input type="password" name="current-password" value="" class="form-control" id="setting-current-password" placeholder="Current Password" required>
				  <small id="current-password-message"></small>
			  </div>     
			  <div class="form-group">
				<label for="setting-confirm-password">Confirm password</label>
				<input type="password" name="confirm-password" value="" class="form-control" id="setting-confirm-password" placeholder="Confirm Password" required>
				<small id="confirm-password-message"></small>
			  </div>
				<div class="form-group">
					<label for="setting-new-password">New password</label>
					<input type="password" name="new-password" value="" class="form-control" id="setting-new-password" placeholder="New Password" required>
				</div>
			  </div>
			  <!-- /.card-body -->
			  <div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</form>
		  </div>
		</div>
		<div class="col-md-3"></div>
	  </div>
  </div>
</section>   
@endsection


@section('footer')
  <script src="{{ asset("js/admin_js/admin-settings.js") }}"></script>
@endsection
