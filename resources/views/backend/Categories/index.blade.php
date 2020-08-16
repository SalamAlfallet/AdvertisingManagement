@extends('backend.layouts.admin')

@section('style')
<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
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
            Categories
            </h3>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token()}}">
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                     &nbsp;
                    <a href="{{route('admin.category.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        New Record
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
                                <th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Record ID</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Title</th>
                                 <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 51.25px;" aria-label="Ship City: activate to sort column ascending">Image</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
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

                                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn hover-danger m-btn--icon m-btn--icon-only m-btn--pill sa-remove deleteRecored" id="{{$category->id}}"> <i class="la la-trash"></i>
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
<script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
<!--end::Page Vendors -->
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <input type="hidden" id="id" name="id" value="" />

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">

                <p>Are you Sure do you want delete The Category?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary deleteBtn">Save</button>
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>

                </div>
            </div>
        </div>
    </div>


    <script>

$(document).ready(function() {


    var current_location="";

    $(document).on("click", '.deleteRecored', function() {
        var recored_id = this.id;
        // alert(news_id);
        // console.log(news_id);
        $("#id").val(recored_id);
        current_location = $(this);
        $('#deleteModal').modal('show');
    });
$(document).on("click", '.deleteBtn', function() {
    // console.log("hhh");
    var url='{{URL::to('/admin/category')}}';
//  alert(url);
    var id = $("#id").val();
    var deleteurl=url+'/delete/'+id;
    // alert(deleteurl);
    $.ajax({
        url:deleteurl ,
        type: 'GET',
        data: {'id':id},
        dataType: 'JSON',
        success: function(data) {
            //  alert(data);
            if(data.success==true){
               if(data.parentCategory>0){
                current_location.closest("tr").remove();
            $('#deleteModal').modal('toggle');
            toastr.success(""+data.message);
            location.reload(true);
            }
            if(data.parentCategory==0){
                current_location.closest("tr").remove();
            $('#deleteModal').modal('toggle');
            toastr.success(""+data.message);

            }

        }
        if(data.success==false){
                $('#deleteModal').modal('toggle');
                toastr.error(""+data.message);

        }
        }

});
});

//-----------------------------------------------------------
});

jQuery(document).ready(function() {

    var KTDatatablesBasicPaginations = function() {

var initTable1 = function() {
    var table = $('#kt_table_1').DataTable({});

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



</script>

@endsection
