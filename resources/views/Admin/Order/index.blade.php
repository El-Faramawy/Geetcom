@extends('layouts.admin.app')
@section('page_title') الطلبات @endsection
<!-- INTERNAL SELECT2 CSS -->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الطلبات</h3>
                    <div class="mr-auto pageheader-btn">
                        @if(in_array(40,admin()->user()->permission_ids))
                            <a href="#"  id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                            <span>
                                                <i class="fa fa-trash-o"></i>
                                            </span>حذف المحدد
                            </a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 ">
                        <div class="card">
                            <div class="card-status bg-blue br-tr-7 br-tl-7"></div>
                            <div class="card-header">
                                <div class="card-title">تاريخ الطلب</div>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mg-b-20 mg-sm-b-40">اختر تاريخ البداية و النهاية</p>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker order_filter" id="order_from"  placeholder="تاريخ البداية" type="text">
                                        <input class="form-control fc-datepicker order_filter" id="order_to" placeholder="تاريخ النهاية" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- COL END -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-status bg-blue br-tr-7 br-tl-7"></div>
                            <div class="card-header">
                                <div class="card-title">حالات الطلب</div>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mg-b-20 mg-sm-b-40">اختر حالة الطلب .</p>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <select class="form-control select2 custom-select order_filter" id="status" data-placeholder="اختر حالة الطلب ... ">
                                            <option label=" اختر حالة الطلب ... ">
                                            </option>
                                            <option value="all">الكل</option>
                                            <option value="not_paid">غير مدفوع </option>
                                            <option value="new">جديد </option>
                                            <option value="accepted">مقبول </option>
                                            <option value="in_market_way">فى الطريق للمطعم</option>
                                            <option value="wait_order">فى انتظار الطلب</option>
                                            <option value="delivery">جارى التوصيل</option>
                                            <option value="ended">منتهى</option>
                                            <option value="canceled_from_market">ملغى من المطعم</option>
                                            <option value="canceled_from_delivery">ملغى من المندوب</option>
                                            <option value="canceled_from_admin">ملغى من الادارة</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- COL END -->
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample" class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">#</th>
                                <th class="text-white">المستخدم</th>
                                <th class="text-white">المندوب</th>
                                <th class="text-white">المطعم</th>
                                <th class="text-white">الكوبون</th>
                                <th class="text-white">العنوان</th>
                                <th class="text-white">طريقة الدفع</th>
                                <th class="text-white">تاريخ الطلب</th>
                                <th class="text-white">وقت التوصيل</th>
                                <th class="text-white">سعر التوصيل</th>
                                <th class="text-white">الحالة</th>
                                <th class="text-white">الاجمالى</th>
                                <th class="text-white w-50">ملاحظات</th>
                                <th class="text-white">التفاصيل</th>
                                <th class="text-white">طباعة</th>
                                <th class="text-white">حذف</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th colspan="12" style="text-align:right">الاجمالى : </th>--}}
{{--                                <th colspan="3"></th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
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
                    <h2>الطلبات</h2>
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
{{--                <div class="modal-footer">--}}
{{--                    <div class=" ">--}}
{{--                        <input  form="form" value="حفظ" type="submit" id="submit" class="btn btn-primary " style="width: 100px">--}}
{{--                        --}}{{--                            <span class="indicator-label ">حفظ</span>--}}

{{--                    </div>--}}
{{--                    <div class=" ">--}}
{{--                        <button type="reset" data-dismiss="modal" class="btn btn-light me-3 " style="width: 100px">غلق</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
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
            {data: 'id', name: 'id'},
            {data: 'user', name: 'user'},
            {data: 'delivery', name: 'delivery'},
            {data: 'market', name: 'market'},
            {data: 'coupon', name: 'coupon'},
            {data: 'address', name: 'address'},
            {data: 'pay_type', name: 'pay_type'},
            {data: 'created_at', name: 'created_at'},
            {data: 'delivery_period', name: 'delivery_period'},
            {data: 'delivery_price', name: 'delivery_price'},
            {data: 'status', name: 'status'},
            {data: 'total', name: 'total'},
            {data: 'notes', name: 'notes'},
            {data: 'details', name: 'details'},
            {data: 'print', name: 'print'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];

    {{--    var footer_sum = function (row, data, start, end, display) {--}}
    {{--        var api = this.api();--}}
    {{--        var coloum_num = 12;--}}
    {{--        // Remove the formatting to get integer data for summation--}}
    {{--        var intVal = function (i) {--}}
    {{--            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;--}}
    {{--        };--}}

    {{--        pageTotal = api--}}
    {{--            .column(coloum_num  , {page: 'current'})--}}
    {{--            .data()--}}
    {{--            .reduce(function (a, b) {--}}
    {{--                return intVal(a) + intVal(b);--}}
    {{--            }, 0);--}}

    {{--        // Update footer--}}
    {{--        $(api.column(coloum_num).footer()).html( pageTotal + ' CHF' /*+ total + ' total)'*/);--}}
    {{--    };--}}
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'orders'])

    <script>

        $(document).on('click', '.statusBtn', function (e) {
            e.preventDefault()
            $('#form-load').html(loader)
            $('#Modal').modal('show')
            var url = $(this).attr('href')
            setTimeout(function (){
                $('#form-load').load(url)
            },100)
        });

        $(document).on('click',".status_submit",function (e) {
            e.preventDefault();
            var id = $('#order_id').val()
            var delivery_id = $('#delivery_id').val()
            var status = $(this).attr('status')
            if (typeof delivery_id === "undefined") {
                delivery_id = ''
            }
            var url = "{{route('update_order_status')}}?id="+id+"&status="+status+"&delivery_id="+delivery_id;
            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: function () {
                    $('#global-loader').show()
                },
                success: function (data) {

                    window.setTimeout(function () {
                        $('#global-loader').hide()
                        if (data.success === 'true') {
                            // alert(1)
                            $('#Modal').modal('hide')
                            my_toaster(data.message)
                            $('#exportexample').DataTable().ajax.reload(null, false);
                        }
                    }, 100);

                },
                error: function (data) {
                    $('#global-loader').hide()
                    console.log(data)
                    if (data.status === 500) {
                        my_toaster('هناك خطأ','error')
                    }

                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);

                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    my_toaster(value,'error')
                                });

                            } else {

                            }
                        });
                    }
                    if (data.status == 421){
                        my_toaster(data.message,'error')
                    }

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

    <script>

        $(document).on('click', '.timeBtn', function (e) {
            e.preventDefault()
            $('#form-load').html(loader)
            $('#Modal').modal('show')
            var url = $(this).attr('href')
            setTimeout(function (){
                $('#form-load').load(url)
            },100)
        });

    </script>

    <script>
        function reload_table(){
            var order_from = $('#order_from').val();
            var order_to = $('#order_to').val();
            var status = $('#status').val();
            var url = '';
            if ('{{$id}}' == '') {
                url = window.location.href+"?order_from=" + order_from + "&order_to=" + order_to + "&status=" + status;
            }else{
                url = window.location.href+"&order_from=" + order_from + "&order_to=" + order_to + "&status=" + status;
            }
            // alert(url);
            $('#exportexample').DataTable().ajax.url(url).draw();
        }

        $(document).on('change','.order_filter', function () {
            reload_table()
        })
    </script>

    <!-- INTERNAL BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="{{url('Admin')}}/assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- INTERNAL  TIMEPICKER JS -->
    <script src="{{url('Admin')}}/assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INTERNAL DATEPICKER JS-->
    <script src="{{url('Admin')}}/assets/plugins/date-picker/spectrum.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!--INTERNAL  FORMELEMENTS JS -->
    <script src="{{url('Admin')}}/assets/js/form-elements.js"></script>
    <script src="{{url('Admin')}}/assets/js/select2.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.card-options-collapse').click();
        })
    </script>

@endpush
