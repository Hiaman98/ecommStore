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
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route("admin.settings")}}" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                        <label for="setting-email">Admin name</label>
                        <input type="text" name="name" value="{{ $adminDetails->name }}" class="form-control" id="setting-name" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="setting-email">Email address</label>
                        <input type="email" name="email" value="{{ $adminDetails->email }}" class="form-control" id="setting-email" placeholder="Enter email">
                    </div>
                    
                    <div class="form-group">
                        <label for="setting-password">Admin type</label>
                        <input type="password" name="admin-type" value="{{ $adminDetails->type }}" class="form-control" id="setting-admin-type" placeholder="Admin type">
                    </div>

                    <div class="form-group">
                        <label for="setting-confirm-password">Current password</label>
                        <input type="password" name="current-password" value="{{ $adminDetails->name }}" class="form-control" id="setting-confirm-password" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <label for="setting-reset-password">Reset password</label>
                        <input type="password" name="reset-password" value="{{ $adminDetails->name }}" class="form-control" id="setting-reset-password" placeholder="Reset Password">
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

</div>
<!-- /.content-wrapper -->
@endsection
