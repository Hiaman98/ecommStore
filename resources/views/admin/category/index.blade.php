@extends('layouts.admin_layout.admin_layout')
@section('head')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
{{-- datatable styling --}}
<link rel="stylesheet" href="{{asset("css\datatable.css")}}">

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid bg-white">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h3 class="m-2">Category</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-12 m-2">
                    <table class="table table-bordered text-center" id="category-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            // category Data Table
            $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('admin.category.table')}}",
                },
                columns: [
                    {
                        data: "category_name", 
                        name: 'category_name',
                    },
                    {
                        data: "url", 
                        name: 'url'
                    },
                    {
                        data: "status",
                        name: 'status',
                        orderable: false,
                        searchable:false
                    },
                ],
            });
        });

        function updateCategoryStatus(e) {  
            var status =  $(e).attr("data-status");
            var id = $(e).attr("data-id");
            var url = "{{route('update.category.status', [':id'])}}";
            url = url.replace(":id", id);

            $.ajax({
                type: "post",
                url: url,
                data: {
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#category-table').DataTable().ajax.reload();

                }, 
                error: function (e) {
                    console.log("Something went wrong");
                }
            });
        }
    </script>
@endsection