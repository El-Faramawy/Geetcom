@extends('layouts.admin.app')
@section('page_title') الاشعارات @endsection
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الاشعارات</h3>
                </div>
                <div class="card-body">
                    <form  action="{{route('notifications.store')}}" id="Form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label >نوع الرسالة</label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="form-check m-0 ">
                                        <input class="form-check-input  " type="radio" name="type" value="notification" checked>
                                        <label class="form-check-label ms-5" style="margin-right: 20px;">
                                            اشعار
                                        </label>
                                    </div>
                                    <div class="form-check m-0  ms-3" style="margin-left: 30px!important">
                                        <input class="form-check-input " type="radio" name="type" value="offer" >
                                        <label class="form-check-label ms-5" style="margin-right: 20px;">
                                            عرض
                                        </label>
                                    </div>
                                    <div class="form-check m-0  ms-3" style="margin-left: 30px!important">
                                        <input class="form-check-input " type="radio" name="type" value="reward" >
                                        <label class="form-check-label ms-5" style="margin-right: 20px;">
                                            مكافأة
                                        </label>
                                    </div>
                                </div>
                            </div>

                                <div class="form-group col-12">
                                    <label >عنوان الرسالة</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="عنوان الرسالة" name="title" value=""/>
                                </div>
                                <div class="form-group col-12">
                                    <label >الرسالة</label>
                                    <textarea  class="form-control form-control-solid"  name="message" ></textarea>
                                </div>
                                <div class="form-group col-12" id="users_div">
                                    <label >المستخدمين</label>
                                    <div class="form-group form-elements m-0 my-2">
                                        <div class="custom-controls-stacked ">
                                            <label class="custom-control custom-checkbox ">
                                                <input type="checkbox" class="custom-control-input "  id="checkAll" >
                                                <span class="custom-control-label " style="font-weight: bold"> تحديد الكل </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-elements m-0">
                                        <div class="custom-controls-stacked row">
                                            @foreach($users as $user)
                                                <label class="custom-control custom-checkbox " style="width: 25%">
                                                    <input type="checkbox" class="custom-control-input users" name="users[]" value="{{$user->id}}" >
                                                    <span class="custom-control-label">{{$user->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-12" id="delivery_div" style="display: none">
                                    <label >المندوبين</label>
                                    <div class="form-group form-elements m-0 my-2">
                                        <div class="custom-controls-stacked ">
                                            <label class="custom-control custom-checkbox ">
                                                <input type="checkbox" class="custom-control-input "  id="checkAllDeliveies" >
                                                <span class="custom-control-label " style="font-weight: bold"> تحديد الكل </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-elements m-0">
                                        <div class="custom-controls-stacked row">
                                            @foreach($deliveries as $delivery)
                                                <label class="custom-control custom-checkbox " style="width: 25%">
                                                    <input type="checkbox" class="custom-control-input deliveries" name="deliveries[]" value="{{$delivery->id}}" >
                                                    <span class="custom-control-label">{{$delivery->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <div class="card-footer ">
                            <input type="submit" class="btn btn-success mt-1" value="ارسال">
                            <input type="reset" class="btn btn-danger mt-1" value="الغاء">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('admin_js')
    <script>
        $(document).on('submit', 'form#Form', function (e) {
            e.preventDefault();
            var form_data = new FormData(document.getElementById("Form"));
            var url = $('#Form').attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#global-loader').show()
                },
                success: function (data) {
                    window.setTimeout(function() {
                        $('#global-loader').hide()
                        if (data.success == 'true') {
                            $('#Form')[0].reset();
                            $('#users_div').show();
                            $('#delivery_div').hide();
                            my_toaster(data.messages)
                        }
                        if (data.success === 'false') {
                            var messages = Object.values(data.messages);
                            $( messages ).each(function(index, message ) {
                                my_toaster(message , 'error')
                            });
                        }
                    }, 1000);
                }, error: function (data) {
                    $('#global-loader').hide()
                    var error = Object.values(data.responseJSON.errors);
                    $( error ).each(function(index, message ) {
                        my_toaster(message,'error')
                    });
                }
            });
        });
    </script>

    <!--end::Form-->
    <script>
        $("#checkAll").click(function(){
            $('.users').not(this).prop('checked', this.checked);
        });
        $("#checkAllDeliveies").click(function(){
            $('.deliveries').not(this).prop('checked', this.checked);
        });
    </script>
    <script>
        $(document).on('change',"input[name='type']", function (e){
            e.preventDefault()
            if ( this.value ==='notification'){
                $('#users_div').show();
                $('#delivery_div').hide();
            }else {
                $('#users_div').hide();
                $('#delivery_div').show();
            }
        })
    </script>
@endpush
