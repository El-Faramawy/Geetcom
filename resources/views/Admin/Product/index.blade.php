@extends('layouts.admin.app')
@section('page_title') المنتجات @endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" >المنتجات</h3>
                    <div class="mr-auto pageheader-btn">
                        @if(in_array(26,admin()->user()->permission_ids))
                            <a href="#"  id="addBtn" class="btn btn-primary btn-icon text-white">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> منتج جديد
                            </a>
                        @endif
                        @if(in_array(25,admin()->user()->permission_ids))
                            <a href="#"  id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                            <span>
                                                <i class="fa fa-trash-o"></i>
                                            </span> حذف المحدد
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample"  class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">الصورة</th>
                                <th class="text-white">المطعم</th>
                                <th class="text-white">القسم الفرعى</th>
                                <th class="text-white">الاسم</th>
{{--                                <th class="text-white" >الوصف</th>--}}
                                <th class="text-white">لديه عرض</th>
                                <th class="text-white">نوع العرض</th>
                                <th class="text-white">قيمة العرض</th>
                                <th class="text-white">نسبة العرض</th>
                                <th class="text-white">السعر القديم</th>
                                <th class="text-white">السعر</th>
                                <th class="text-white">تحكم</th>
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

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>المنتجات</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer" data-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-3" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class=" ">
                        <input  form="form" value="حفظ" type="submit" id="submit" class="btn btn-primary " style="width: 100px">
                        {{--                            <span class="indicator-label ">حفظ</span>--}}

                    </div>
                    <div class=" ">
                        <button class="btn btn-light me-3 close_model" style="width: 100px">غلق</button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection
@push('admin_js')
    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'image', name: 'image'},
            {data: 'market', name: 'market'},
            {data: 'sub_category', name: 'sub_category'},
            // {data: 'category', name: 'category'},
            {data: 'name_ar', name: 'name_ar'},
            // {data: 'description_ar', name: 'description_ar'},
            {data: 'has_offer', name: 'has_offer'},
            {data: 'offer_type', name: 'offer_type'},
            {data: 'value', name: 'value'},
            {data: 'percentage', name: 'percentage'},
            {data: 'old_price', name: 'old_price'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
        //======================== addBtn =============================

    </script>
    @include('layouts.admin.inc.ajax',['url'=>'products'])
    <script>

        $(document).on('click', '#addBtn', function (e) {
            e.preventDefault();
            $('#form-load').html(loader)
            $('#Modal').modal('show')
            var id = "{{$id}}" ;
            setTimeout(function (){
                $('#form-load').load("{{route("products.create")}}?id="+ id)
            },100)
        });
    </script>
@endpush
