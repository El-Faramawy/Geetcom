@extends('layouts.admin.app')
@section('page_title') الاعدادات @endsection
<!-- INTERNAL  WYSIWYG EDITOR CSS -->
<script src="https://cdn.ckeditor.com/4.19.0/full-all/ckeditor.js"></script>

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الاعدادات</h3>
                </div>
                <div class="card-body">
                    <form  action="{{route('settings.update',$setting->id)}}" id="Form" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>رقم الهاتف</label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-phone tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><!-- input-group-prepend -->
                                        <input class="form-control numbersOnly" name="phone" value="{{$setting->phone}}"
                                               placeholder="رقم الهاتف ... " type="text" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>البريد الالكترونى</label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-envelope tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><!-- input-group-prepend -->
                                        <input class="form-control " name="email" value="{{$setting->email}}"
                                               placeholder="البريد الالكترونى ... " type="email" autocomplete="off">
                                    </div>
                                </div>
                            </div>
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label>تكلفة التوصيل</label>--}}
{{--                                <div class="wd-150 mg-b-30">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <div class="input-group-text">--}}
{{--                                                <i class="fa fa-phone tx-16 lh-0 op-6"></i>--}}
{{--                                            </div>--}}
{{--                                        </div><!-- input-group-prepend -->--}}
{{--                                        <input class="form-control numbersOnly" name="delivery_cost"--}}
{{--                                               value="{{$setting->delivery_cost}}" placeholder="تكلفة التوصيل ... "--}}
{{--                                               type="text" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label>الرقم البنكى</label>--}}
{{--                                <div class="wd-150 mg-b-30">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <div class="input-group-text">--}}
{{--                                                <i class="fa fa-bank tx-16 lh-0 op-6"></i>--}}
{{--                                            </div>--}}
{{--                                        </div><!-- input-group-prepend -->--}}
{{--                                        <input class="form-control " name="bank_no" value="{{$setting->bank_no}}"--}}
{{--                                               placeholder="الرقم البنكى ... " type="text" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label>اسم البنك</label>--}}
{{--                                <div class="wd-150 mg-b-30">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <div class="input-group-text">--}}
{{--                                                <i class="fa fa-bank tx-16 lh-0 op-6"></i>--}}
{{--                                            </div>--}}
{{--                                        </div><!-- input-group-prepend -->--}}
{{--                                        <input class="form-control " name="bank_name" value="{{$setting->bank_name}}"--}}
{{--                                               placeholder="اسم البنك ... " type="text" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label>رقم الأيبان</label>--}}
{{--                                <div class="wd-150 mg-b-30">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <div class="input-group-text">--}}
{{--                                                <i class="fa fa-bank tx-16 lh-0 op-6"></i>--}}
{{--                                            </div>--}}
{{--                                        </div><!-- input-group-prepend -->--}}
{{--                                        <input class="form-control " name="iban_no" value="{{$setting->iban_no}}"--}}
{{--                                               placeholder="رقم الأيبان ... " type="text" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-6">--}}
{{--                                <label>واتساب</label>--}}
{{--                                <div class="wd-150 mg-b-30">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <div class="input-group-text">--}}
{{--                                                <i class="fa fa-whatsapp tx-16 lh-0 op-6"></i>--}}
{{--                                            </div>--}}
{{--                                        </div><!-- input-group-prepend -->--}}
{{--                                        <input class="form-control " name="whats" value="{{$setting->whats}}"--}}
{{--                                               placeholder="لينك واتساب ... " type="url" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group col-md-6">
                                <label >فيسبوك</label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-facebook tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><!-- input-group-prepend -->
                                        <input class="form-control " name="facebook" value="{{$setting->facebook}}" placeholder="لينك فيسبوك ... " type="url" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>تويتر</label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-twitter tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><!-- input-group-prepend -->
                                        <input class="form-control " name="twitter" value="{{$setting->twitter}}"
                                               placeholder="لينك تويتر ... " type="url" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>لينكد ان</label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-linkedin tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><!-- input-group-prepend -->
                                        <input class="form-control " name="linked_in" value="{{$setting->linked_in}}"
                                               placeholder="لينك لينكد ان ... " type="url" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>انستجرام</label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-instagram tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><!-- input-group-prepend -->
                                        <input class="form-control " name="insta" value="{{$setting->insta}}"
                                               placeholder="لينك انستجرام ... " type="url" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">الشروط و الاحكام</div>
                                    </div>
                                    <div class="card-body">
                                        <textarea  name="terms" id="terms">{!! $setting->terms !!}</textarea>
                                        {{--                                        <textarea class="content" name="terms">{!! $setting->terms !!}</textarea>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label >اللوجو</label>
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control browse-file" placeholder="اختر" readonly>
                                        <label class="input-group-btn">
													<span class="btn btn-primary">
														اختر  <input accept="image/*" name="logo" id="imgInp1" type="file" style="display: none;" >
													</span>
                                        </label>
                                    </div>
                                    {{--                                        <input accept="image/*" type='file'  name="logo"  class="form-control form-control-solid" />--}}
                                    <img width="100" height="100" id="blah1" src="{{$setting->logo}}" alt="your image" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label >صورة المتصفح</label>
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control browse-file" placeholder="اختر" readonly>
                                        <label class="input-group-btn">
													<span class="btn btn-primary">
														اختر <input accept="image/*" id="imgInp2" name="fav_icon" type="file" style="display: none;" >
													</span>
                                        </label>
                                    </div>
                                    {{--                                        <input accept="image/*" type='file' id="imgInp2" name="fav_icon"  class="form-control form-control-solid" />--}}
                                    <img width="100" height="100" id="blah2" src="{{get_file($setting->fav_icon)}}" alt="your image" />
                                </div>
                            </div>
                        </div>

                        <!-- ROW-2 CLOSED -->
                        <div class="card-footer ">
                            <input type="submit" class="btn btn-success mt-1" value="حفظ">
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
        imgInp1.onchange = evt => {
            $('#blah1').show()
            const [file] = imgInp1.files
            if (file) {
                blah1.src = URL.createObjectURL(file)
            }
        }
        imgInp2.onchange = evt => {
            $('#blah2').show()
            const [file] = imgInp2.files
            if (file) {
                blah2.src = URL.createObjectURL(file)
            }
        }
    </script>

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
                            var messages = Object.values(data.messages);
                            $( messages ).each(function(index, message ) {
                                my_toaster(message)
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

    <!-- INTERNAL   WYSIWYG Editor JS -->
    <script src="{{url('Admin')}}/assets/plugins/wysiwyag/jquery.richtext.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/wysiwyag/wysiwyag.js"></script>
    <script>
        CKEDITOR.config.contentsLangDirection = 'ltr';
        CKEDITOR.replace( 'terms' );
    </script>

@endpush
