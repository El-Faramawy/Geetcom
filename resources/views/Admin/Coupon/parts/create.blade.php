<!--begin::Form-->
{{--<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>--}}
<link rel="stylesheet" href="{{url('Admin')}}/assets/plugins/multipleselect/multiple-select.css">
<style>
    li.multiple {
        width: 150px!important;
    }
    .ms-drop .multiple {
        width: 110px !important;
    }
</style>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('coupons.store')}}">
    @csrf
    <div class="row mt-0">

        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0 col-lg-4">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">كوبون على </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" كوبون على "></i>
            </label>
            <!--end::Label-->
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input coupon_on " type="radio" name="coupon_on" value="purchases" checked>
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        مشتريات
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-right: 30px!important">
                    <input class="form-check-input coupon_on" type="radio" name="coupon_on" value="points">
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        نقاط
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0 col-lg-4">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الحالة </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" الحالة "></i>
            </label>
            <!--end::Label-->
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input  " type="radio" name="is_available" value="yes" checked>
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        نعم
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-right: 30px!important">
                    <input class="form-check-input " type="radio" name="is_available" value="no">
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        لا
                    </label>
                </div>
            </div>
        </div>
        <div class=" mb-2 fv-row col-sm-6 col-lg-4 mt-0 type_div">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">النوع </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" النوع "></i>
            </label>
            <!--end::Label-->
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input type " type="radio" name="type" value="value" checked>
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        قيمة
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-right: 30px!important">
                    <input class="form-check-input type " type="radio" name="type" value="percentage">
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        نسبة
                    </label>
                </div>
            </div>
        </div>
        <!--begin::Input group-->
        <div class=" mb-2  col-sm-12 mt-0 ">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الكود </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الكود"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الكود" name="code" value=""/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class=" mb-2 fv-row col-sm-6 mt-0" id="value_div">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">القيمة </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="القيمة"></i>
            </label>
            <!--end::Label-->
            <input type="text" name="value" class="form-control form-control-solid numbersOnly" placeholder="القيمة">
        </div>

        <div class=" mb-2 fv-row col-sm-6 mt-0" id="percentage_div" style="display: none">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">النسبة </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="النسبة"></i>
            </label>
            <!--end::Label-->
            <input type="text" name="percentage" class="form-control form-control-solid numbersOnly" placeholder="النسبة">
        </div>

        <!--end::Input group-->

        <!--begin::Input group-->
        <div class=" mb-2  col-sm-6 mt-0 " id="min_div">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الحد الادنى </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الحد الادنى"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="الحد الادنى" name="min_price" value=""/>
        </div>
        <div class=" mb-2  col-sm-6 mt-0 " id="max_div" style="display: none">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الحد الاقصى </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الحد الاقصى"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="الحد الاقصى" name="max_price" value=""/>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> المستخدمين </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="المستخدمين"></i>
            </label>
            <!--end::Label-->
{{--            <select class="form-control select2" name="users[]" data-placeholder="المستخدمين" multiple>--}}
{{--                @foreach($users as $user)--}}
{{--                    <option value="{{$user->id}}"> {{$user->name}} </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
            <select multiple="multiple" name="users[]" class="group-filter my-2">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>

        </div>

    </div>
</form>
<!--end::Form-->

<!-- INTERNAL SELECT2 CSS -->
{{--<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>--}}
{{--<script src="{{url('Admin')}}/assets/js/select2.js"></script>--}}
<script src="{{url('Admin')}}/assets/plugins/multipleselect/multiple-select.js"></script>
<script src="{{url('Admin')}}/assets/plugins/multipleselect/multi-select.js"></script>
<script>

    $(document).on('change',".type",function (e) {
        e.preventDefault();
        var type = this.value;
        if(type == 'value'){
            $('#value_div').show()
            $('#percentage_div').hide()

            $('#min_div').show()
            $('#max_div').hide()
        }else {
            $('#value_div').hide()
            $('#percentage_div').show()

            $('#min_div').hide()
            $('#max_div').show()
        }
    });
    $(document).on('change',".coupon_on",function (e) {
        e.preventDefault();
        if(this.value === 'points'){
            $('#value_div').show()
            $('#percentage_div').hide()

            $('#min_div').hide()
            $('#max_div').hide()
        }

    });

</script>
