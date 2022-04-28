@extends('layouts.admin_layout.admin_layout')
@section('head')
<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
@endsection

@section('content') 
<section class="content-header bg-white">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Add Category</h1>
            </div>
        </div>
    </div>
</section>
<section class="content bg-white mt-2">
    <div class="container-fluid">
        <div class="card-body">
            <div class="m-2">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}                                    
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
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
            <form action="{{route("admin.category.add")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- text input -->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Category Name <span style="color: red">*</span></label>
                            <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control" placeholder="Enter category name">
                            @error('category_name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Select Section <span style="color: red">*</span></label>
                        <select id="category-section" name="section_id" value="{{old('section_id')}}" class="form-control select2" style="width: 100%;">
                            <option selected>Select</option>
                            @foreach ($sections as $section)
                                <option value="{{$section->id}}">{{$section->name}}</option>
                                {{-- @if (isset($section["categories"]))
                                    @foreach ($section["categories"] as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                @endif --}}
                            @endforeach
                        </select>
                        @error('section_id')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Select category level <span style="color: red">*</span></label>
                        <select  id="section-category" name="parent_id" value="{{old('parent_id')}}" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="0">Main Category</option>
                        </select>
                        @error('parent_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>                         
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_image">Category image <span style="color: red">*</span></label>
                            <div class="custom-file">
                                <input type="file" id="category_image"  class="custom-file-input"  name="image" value="{{old('category_image')}}">
                                <label class="custom-file-label" for="category_image">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <!-- text input -->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Category Discount <span style="color: red">*</span></label>
                            <input type="number" id="category_discount" name="category_discount" value="{{old('category_discount')}}" class="form-control" placeholder="Enter discount amount">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Category Url <span style="color: red">*</span></label>
                            <input type="text" id="category_url" name="url" value="{{old('url')}}" class="form-control" placeholder="Enter url">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <!-- textarea -->
                        <div class="form-group">
                        <label>Category description <span style="color: red">*</span></label>
                        <textarea id="description" name="description" value="{{old('description')}}" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <!-- textarea -->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                        <label>Meta Title <span style="color: red">*</span></label>
                        <textarea id="meta_tilte" name="meta_title" value="{{old('meta_title')}}" class="form-control" rows="3" placeholder="Enter title"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <!-- textarea -->
                        <div class="form-group">
                        <label>Meta Description <span style="color: red">*</span></label>
                        <textarea id="meta_description" name="meta_description" value="{{old('meta_description')}}" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <!-- textarea -->
                        <div class="form-group">
                        <label>Meta keywords <span style="color: red">*</span></label>
                        <textarea id="meta_keywords" name="meta_keywords" value="{{old('meta_keywords')}}" class="form-control" rows="3" placeholder="Enter keywords"></textarea>
                        </div>
                    </div>
                </div>  
                
                <div class="col-sm-3 col-md-3 float-right">
                    <button type="submit" class="btn btn-block btn-outline-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('footer')
    <script src="{{ asset("js/admin_js/category/category.js")}}"></script>
    <script>
        $("#category-section").change(function (e) { 
            var section_id = $("#category-section option:selected").val();

            $.ajax({
                url: "{{route('admin.category.section')}}",
                data: {
                    section_id: section_id
                },
                success: function (response) {
                    if(response.categories.length > 0) {
                        Category.appendCategoryOptions(response);
                    } else {

                        $("#section-category option:not(:first)").remove()

                        //show alert messages
                        Swal.fire({
                            icon: 'info',
                            text: 'This section doesn"t have any category',
                        });
                    }
                }, 
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            });
        });
    </script>
@endsection