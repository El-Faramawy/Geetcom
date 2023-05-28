<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>

<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {lat: 24.755562, lng: 46.589584},
            zoom: 8,
            scrollwheel: true,
        });
        const uluru = {lat: 24.755562, lng: 46.589584};
        let marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable: true
        });
        google.maps.event.addListener(marker, 'position_changed',
            function () {
                let lat = marker.position.lat()
                let lng = marker.position.lng()
                $('#lat').val(lat)
                $('#lng').val(lng)
            })
        google.maps.event.addListener(map, 'click',
            function (event) {
                pos = event.latLng
                marker.setPosition(pos)
            })
    }
</script>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('markets.store')}}">
    @csrf
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم (بالعربية)  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم (بالعربية) "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم (بالعربية) " name="name_ar" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم (بالانجليزية)  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم (بالانجليزية) "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم (بالانجليزية) " name="name_en" value=""/>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الموقع (بالعربية)  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الموقع (بالعربية) "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الموقع (بالعربية) " name="location_ar" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الموقع (بالانجليزية)  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الموقع (بالانجليزية) "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الموقع (بالانجليزية) " name="location_en" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">اسم المستخدم  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="اسم المستخدم "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="اسم المستخدم " name="user_name" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">كلمة المرور  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="كلمة المرور "></i>
            </label>
            <!--end::Label-->
            <input type="password" class="form-control form-control-solid" placeholder="كلمة المرور " name="password" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">رقم الهاتف  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="رقم الهاتف "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="رقم الهاتف " name="phone" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">السعر  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="السعر "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="السعر " name="price" value=""/>
        </div>

        <div class="d-flex flex-column mb-2 fv-row  col-sm-6">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">الحالة</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" الحالة "></i>
            </label>
            <select class="form-control form-control-solid select2" name="is_available">
                <option value="" disabled > الحالة ...</option>
                <option selected value="yes" >فعال</option>
                <option value="no" >غير فعال</option>
            </select>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الحد الادنى للتوصيل  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الحد الادنى للتوصيل "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="مثال : 15 دقيقة " name="min_from" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الحد الاقصى للتوصيل  </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الحد الاقصى للتوصيل "></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="مثال : 30 دقيقة " name="min_to" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> الاقسام </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="الاقسام"></i>
            </label>
            <select class="form-control select2" id="category_ids" name="categories[]" data-placeholder="اختر الاقسام ..." multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"> {{$category->name_ar}} </option>
                @endforeach
            </select>
{{--            <div class="selectgroup selectgroup-pills">--}}
{{--                @foreach($categories as $category)--}}
{{--                    <label class="selectgroup-item">--}}
{{--                        <input type="checkbox" name="categories[]" value="{{$category->id}}" class="selectgroup-input" --}}{{--checked=""--}}{{-->--}}
{{--                        <span class="selectgroup-button">{{$category->name}}</span>--}}
{{--                    </label>--}}
{{--                @endforeach--}}
{{--            </div>--}}

        </div>
{{--        <div class="d-flex flex-column mb-2 fv-row col-sm-12">--}}
{{--            <label class="d-flex align-items-center fs-6 fw-bold form-label ">--}}
{{--                <span class="required"> الاقسام الفرعية </span>--}}
{{--                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="الاقسام الفرعية"></i>--}}
{{--            </label>--}}
{{--            <select class="form-control select2" id="sub_categories" name="sub_categories[]" data-placeholder="اختر الاقسام الفرعية ..." multiple>--}}

{{--            </select>--}}
{{--        </div>--}}
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> الصورة </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="الصورة"></i>
            </label>
            <!--end::Label-->
            <input accept="image/*" type='file' id="imgInp" name="image"  class="form-control form-control-solid" />
            <img width="100" height="100" id="blah" src="#" alt="your image" />
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> البانر </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="البانر"></i>
            </label>
            <!--end::Label-->
            <input accept="image/*" type='file' id="imgInp2" name="panner"  class="form-control form-control-solid" />
            <img width="100" height="100" id="blah2" src="#" alt="your image" />
        </div>
        <!--end::Input group-->

    </div>

    <div class="row">
        <div class="col-6">
            <input type="text" class="form-control" placeholder="خطوط الطول" name="latitude" id="lat">
        </div>
        <div class="col-6">
            <input type="text" class="form-control" placeholder="دوائر العرض" name="longitude" id="lng">
        </div>
    </div>
    <div id="map" style="height:400px" class="my-3 col-12"></div>

</form>
<!--end::Form-->
<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>

{{--@include('Admin.Market.parts.GetMarketSubCategories')--}}

<script>
    $(document).ready(function (){
        $('#blah').hide()
        $('#blah2').hide()
    })
    imgInp.onchange = evt => {
        $('#blah').show()
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
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
