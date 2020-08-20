@extends('backend.layouts.admin')

@section('title',' اضافة تصنيف')


@section('content')



<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                إضافة تصنيف
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data" class="kt-form kt-form--label-right">
        @csrf
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">الاسم</label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input type="text" id="name" name="name" class="form-control" placeholder="اسم التصنيف ">
                </div>
            </div>




            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12"> صورة التصنيف   </label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="m-dropzone dropzone dz-clickable" action="{{route('uploads.category.file')}}" id="m-dropzone-one" class="dropzone">

                                        {{ csrf_field() }}
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <h3 class="m-dropzone__msg-title">اسحب الملفات هنا </h3>

                                            <span class="m-dropzone__msg-desc">او اضغط لرفع الملفات يدويا</span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="image"  name="image" title="image" class="form-control m-input" placeholder="إسم النموذج ..." value="" required>
                                    <p class="text-danger  error_image"></p>

                                </div>
                            </div>


        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-12 text-center ">
                        <button type="submit" class="btn btn-primary mb-3">اضافة</button>
                        <a href="{{route('admin.category')}}" class="btn btn-dark mb-3">رجوع</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->



@endsection
