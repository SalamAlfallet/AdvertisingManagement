@extends('backend.layouts.admin')
<!-- <title>التصنيفات </title> -->
@section('title',' التصنيفات')
@section('style')
<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!-- <link href="{{asset('assets/vendors/custom/components/vendors/sweetalert2/_sweetalert2.scss')}}" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="{{asset('assets/vendors/sweetalert/sweetalert.css')}}" />


@endsection



@section('content')


<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flatkt-sticky-toolbaricon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                التصنيفات
            </h3>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token()}}">
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    &nbsp;
                    <a href="{{route('admin.category.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                       إضافة تصنيف
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer text-center">

            <div class="row">
                <div class="col-sm-12">
                    <table class="table  table-hover table-checkable dataTable no-footer dtr-inline " id="kt_table_1" role="grid" aria-describedby="kt_table_1_info" style="width: 992px;">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">#</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">عنوان التصتيف</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 51.25px;" aria-label="Ship City: activate to sort column ascending">صورة التصنيف</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($categories as $index=>$category)
                            <tr role="row" class="odd">
                                <td class="sorting_1" tabindex="0">{{ $index+1}}</td>
                                <td>{{$category->name}}</td>
                                <td><img src="{{asset('storage/' . $category->image )}}" height="40" width="50"></td>

                                <td nowrap="">

                                    <a href="{{route('admin.category.edit' , [ 'id' => $category->id ])}}" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"> <i class="la la-edit"></i>
                                    </a>

                                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn hover-danger m-btn--icon m-btn--icon-only m-btn--pill sa-remove " onclick="deleteItem({{ $category->id }})" title="حذف"> <i class="la la-trash"></i>

                                    </a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!--end: Datatable -->
    </div>
</div>

@endsection



@section('js')
<!--begin::Page Vendors(used by this page) -->
<script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/sweetalert/sweetalert.min.js')}}"></script>


<!-- <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script> -->
<!--end::Page Vendors -->


<script>
    $(document).ready(function() {


        var current_location = "";


        //-----------------------------------------------------------
    });

    jQuery(document).ready(function() {

        var KTDatatablesBasicPaginations = function() {

            var initTable1 = function() {
                var table = $('#kt_table_1').DataTable({



                    "language": {
                        "url": "{{asset('assets/arabic.json')}}"
                    },
                    "columnDefs": [{
                        "targets": 3,
                        "orderable": false
                    }]





                });

                // begin first table

            }




            return {

                //main function to initiate the module
                init: function() {
                    initTable1();
                }

            };
        }();

        KTDatatablesBasicPaginations.init();



    });



    function deleteItem(id) {
        var url = "{{URL::to('/admin/category')}}";
        var m_url = url + '/delete/' + id;
        // alert(m_url);

        swal({
            title: "هل أنت متأكد  ؟",
            text: " ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "تأكيد",
            cancelButtonText: "إلغاء",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                    async: false,
                    dataType: "json",
                    url: m_url,
                    type: 'GET',
                    success: function(data) {
                        //getAll();
                        if (data.msg == 'success') {
                            swal(" حذف !", "تم الحذف بنجاح", "success");
                            location.reload(true);
                        } else {
                            swal("خطأ !", "يرجى مراجعة الإدارة", "error");

                        }

                    },
                    error: function(er) {
                        swal("إلغاء", "يرجى مراجعة الإدارة", "error");
                    }
                })



            } else {}
        });
    }
</script>

@endsection
