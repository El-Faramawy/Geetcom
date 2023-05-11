@extends('layouts.admin.app')
@section('page_title') تواصل معنا @endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تواصل معنا</h3>
                    <div class="mr-auto pageheader-btn">
                        @if(in_array(21,admin()->user()->permission_ids))
                            <a href="#"  id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                            <span>
                                                <i class="fa fa-trash-o"></i>
                                            </span> حذف المحدد
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="{{--table-responsive--}}">
                        <table id="exportexample" class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">#</th>
                                <th class="text-white">اسم العميل</th>
                                <th class="text-white">البريد الالكترونى</th>
                                <th class="text-white">رقم الهاتف</th>
                                <th class="text-white">الرسالة</th>
                                <th class="text-white">رد</th>
                                <th class="text-white">حذف</th>
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
        <div class="modal-dialog modal-dialog-centered modal-lg mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>تواصل معنا</h2>
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
                <div class="modal-footer">
                    <div class=" ">
                        <input  form="form" value="ارسال" type="submit" id="submit" class="btn btn-primary " style="width: 100px">
{{--                            <span class="indicator-label ">ارسال</span>--}}

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
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'message', name: 'message'},
            {data: 'replay', name: 'replay', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
        //======================== addBtn =============================

    </script>
    @include('layouts.admin.inc.ajax',['url'=>'contacts'])


    <script>
        $(document).on('click', '.replayBtn', function (e) {
            e.preventDefault()
            $('#Modal').modal('show')
            var url = $(this).attr('href')
            setTimeout(function (){
                $('#form-load').load(url)
            },100)
        });

        $(document).on('click',".status_submit",function (e) {
            e.preventDefault();
            var id = $('#order_id').val()
            var status = $(this).attr('status')

            var url = "{{route('update_order_status')}}?id="+id+"&status="+status;
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
                        my_toaster('هناك خطأ ما','error')
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
@endpush
