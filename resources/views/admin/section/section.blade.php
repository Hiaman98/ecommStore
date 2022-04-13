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
                <h1>Sections</h1>
            </div>
        </div>
    </div>
</section>
<section class="content bg-white mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 m-2">
                <table class="table table-bordered text-center" id="section-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
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
            // Section Data Table
            $('#section-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('admin.section.table')}}",
                },
                columns: [
                    {
                        data: "id", 
                        name: 'id',
                        orderable: false,
                        searchable:false
                    },
                    {
                        data: "name", 
                        name: 'name'
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

        function updateSectionStatus(e) {  
            var status =  $(e).attr("data-status");
            var id = $(e).attr("data-id");
            var url = "{{route('update.section.status', [':id'])}}";
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
                    $('#section-table').DataTable().ajax.reload();

                }, 
                error: function (e) {
                    console.log("Something went wrong");
                }
            });
        }
    </script>
@endsection