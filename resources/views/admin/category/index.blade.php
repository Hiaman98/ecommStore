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
<section class="content-header bg-white">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category</h1>
            </div>
        </div>
    </div>
</section>
<section class="content bg-white mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 m-2">
                <table class="table table-bordered text-center" id="category-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Parent category</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</section>
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
                        data: "section", 
                        name: 'section',
                    },
                    {
                        data: "parent_category", 
                        name: 'parent_category',
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
                    {
                        data: "action",
                        name: 'action',
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

        function destroyCategory (e) {
            var id = $(e).attr("data-id");
            var url = "{{ route('admin.category.destroy, ['id' => 'id']')}}",
            console.log(url);

            $.ajax({
                url:url,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Delete',
                        text: response.success,
                    })
                }, 
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            });
        }

        function editCategory (e) {
            var id = $(e).attr("data-id");
        }
    </script>
@endsection