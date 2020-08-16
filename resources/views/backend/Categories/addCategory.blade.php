@extends('backend.layouts.admin')
@section('content')



<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                ADD Category
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data" class="kt-form kt-form--label-right">
        @csrf
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Name:</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category name">
                    <span class="form-text text-muted">Please enter Category name</span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Image Browser</label>
                <div class=" custom-file col-lg-4 col-md-9 col-sm-12">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label text-left" for="customFile">Choose image</label>
                </div>
            </div>
           
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-8 ml-lg-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('admin.category')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->



@endsection
