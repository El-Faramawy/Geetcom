@extends('layouts.admin.app')
@section('page_title') المطاعم @endsection
<link href="{{url('admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" >المطاعم</h3>
                    <div class="mr-auto pageheader-btn">
                        @if(in_array(83,admin()->user()->permission_ids))
                            <a href="#" id="addBtn" class="btn btn-primary btn-icon text-white">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> اضافة جديد
                            </a>
                        @endif
                        @if(in_array(82,admin()->user()->permission_ids))
                            <a href="#" id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                            <span>
                                                <i class="fa fa-trash-o"></i>
                                            </span> حذف المحدد
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample" class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">#</th>
                                <th class="text-white">الصورة</th>
                                <th class="text-white">البانر</th>
                                <th class="text-white">الاسم</th>
                                <th class="text-white">اسم المستخدم</th>
                                <th class="text-white">رقم الهاتف</th>
                                <th class="text-white">الموقع</th>
                                <th class="text-white">مدة التوصيل </th>
                                <th class="text-white">السعر</th>
                                <th class="text-white">العنوان</th>
                                <th class="text-white">التقييم</th>
                                <th class="text-white">الاقسام الفرعية</th>
                                <th class="text-white">الطلبات</th>
                                <th class="text-white">الحالة</th>
                                <th class="text-white">حظر</th>
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
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h2>المطاعم</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-3" id="form-load">

                </div>
                <div class="modal-footer">
                    <div class=" ">
                        <input  form="form" value="حفظ" type="submit" id="submit" class="btn btn-primary " style="width: 100px">
                    </div>
                    <div class=" ">
                        <button class="btn btn-light me-3 close_model" style="width: 100px">غلق</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('admin_js')
    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'panner', name: 'panner'},
            {data: 'name_ar', name: 'name_ar'},
            {data: 'user_name', name: 'user_name'},
            {data: 'phone', name: 'phone'},
            {data: 'location_ar', name: 'location_ar'},
            {data: 'delivery_period', name: 'delivery_period'},
            {data: 'price', name: 'price'},
            {data: 'address', name: 'address'},
            {data: 'rating', name: 'rating'},
            {data: 'sub_categories', name: 'sub_categories'},
            {data: 'orders', name: 'orders'},
            {data: 'is_available', name: 'is_available'},
            {data: 'block', name: 'block'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
        //======================== addBtn =============================

    </script>
    @include('layouts.admin.inc.ajax',['url'=>'markets'])
    @include('Admin.Market.parts.block',['url'=>'markets'])


@endpush
