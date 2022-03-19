@extends('layouts.admin_layout.admin_layout')

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard Settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
            <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <div class="m-2">
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
                <h3 class="card-title">Update admin details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route("update.admin.details")}}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="setting-email">Email address</label>
                        <input type="email" name="email" value="{{ $adminDetails->email }}" class="form-control" id="admin-email" placeholder="Enter email" disabled required>
                        @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="setting-password">User type</label>
                        <input type="text" name="type" value="{{ $adminDetails->type }}" class="form-control" id="admin-type" placeholder="Admin type" disabled required>
                        @error('type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                    <label for="admin-name">Name</label>
                    <input type="text" name="name" value="{{ $adminDetails->name}}" class="form-control" id="admin-name" placeholder="Admin Name" required>
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>     
                
                
                <div class="form-group">
                    <label for="admin-contact">Contact</label>
                    <input type="number" name="mobile" value="{{ $adminDetails->mobile}}" class="form-control" id="admin-contact" placeholder="Contact" required>
                    @error('mobile')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                </div>

                    <div class="form-group">
                        <label for="admin-image">Image</label>
                        <input type="file" name="image" value="" class="form-control" id="admin-image" placeholder="Choose image">
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
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

</div>
<!-- /.content-wrapper -->
@endsection


@section('footer')
<script src="{{ asset("js/admin_js/admin-settings.js") }}"></script>
@endsection
