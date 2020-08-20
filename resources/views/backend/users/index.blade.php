@extends('backend.layouts.admin')
@section('title','المشتخدمين')
@section('style')
<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!-- <link href="{{asset('assets/vendors/custom/components/vendors/sweetalert2/_sweetalert2.scss')}}" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="{{asset('assets/vendors/sweetalert/sweetalert.css')}}" />


<!--end::Page Vendors Styles -->

@endsection

@section('content')


<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flatkt-sticky-toolbaricon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                المستخدمين
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">


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
                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">الاسم</th>

                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 53.25px;" aria-label="Country: activate to sort column ascending">المكان</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 53.25px;" aria-label="Country: activate to sort column ascending">رقم الهاتف</th>

                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 53.25px;" aria-label="Country: activate to sort column ascending">البريد الالكتروني</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 53.25px;" aria-label="Country: activate to sort column ascending"> العضوية</th>


                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $index=>$user)
                            <tr role="row" class="odd">
                                <td class="sorting_1" tabindex="0">{{$index+1}}</td>
                                <td>{{$user->fname}} {{$user->lname}}</td>
                                <td>{{$user->location}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->isAdmin == 1)
                                    الأدمن
                                    @else
                                    مستخدم
                                    @endif

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
<script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
<!--end::Page Vendors -->

<script>
    $(document).ready(function() {

        //-----------------------------------------------------------


    });
</script>

<script>
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



        }
        return {

            //main function to initiate the module
            init: function() {
                initTable1();
            }

        };
    }();

    jQuery(document).ready(function() {

        KTDatatablesBasicPaginations.init();



    });
</script>

@endsection