<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('products.update',$product->id)}}">
    @csrf
    @method('PUT')

    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">المطعم </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="المطعم"></i>
            </label>
            <!--end::Label-->
            <select name="market_id" id="market_id" class="form-control form-control-solid select2">
                <option value="" selected disabled>المطعم</option>
                @foreach($markets as $market)
                    <option {{$product->market_id == $market->id?'selected':''}} value="{{$market->id}}">{{$market->name_ar}}</option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->
{{--        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">--}}
{{--            <!--begin::Label-->--}}
{{--            <label class="d-flex align-items-center fs-6 fw-bold form-label ">--}}
{{--                <span class="required">القسم </span>--}}
{{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="القسم"></i>--}}
{{--            </label>--}}
{{--            <!--end::Label-->--}}
{{--            <select name="category_id" id="category_id" class="form-control form-control-solid select2">--}}
{{--                <option value="" selected disabled>القسم</option>--}}
{{--                    @foreach($market_categories as $category)--}}
{{--                        <option {{$product->category_id == $category->category->id?'selected':''}} value="{{$category->category->id}}">{{$category->category->name_ar}}</option>--}}
{{--                    @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> القسم الفرعى </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="القسم الفرعى"></i>
            </label>
            <select class="form-control select2"  name="sub_category_id" data-placeholder="اختر القسم الفرعى ..." >
                @foreach($sub_categories as $sub_category)
                    <option {{$sub_category->id == $market->sub_category_id ?'selected':''}} value="{{$sub_category->id}}"> {{$sub_category->name_ar}} </option>
                @endforeach
            </select>

        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 col-md-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاسم (بالعربية) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاسم (بالعربية)"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الاسم (بالعربية)" name="name_ar" value="{{$product->name_ar}}"/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 col-md-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاسم (بالانجليزية) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاسم (بالانجليزية)"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الاسم (بالانجليزية)" name="name_en" value="{{$product->name_en}}"/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0 ">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">عرض على المنتج </span>
                {{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" عرض على المنتج "></i>--}}
            </label>
            <!--end::Label-->
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input  " type="radio" name="has_offer" value="yes" {{$product->has_offer=='yes'?'checked':''}} >
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        نعم
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-left: 30px!important">
                    <input class="form-check-input " type="radio" name="has_offer" value="no" {{$product->has_offer=='no'?'checked':''}}>
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        لا
                    </label>
                </div>
            </div>
        </div>

        <div class=" mb-2 fv-row col-sm-6 mt-0 " id="offer_type_div" style="display:  {{$product->has_offer=='no'?'none':''}}">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">نوع الخصم </span>
                {{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" نوع الخصم "></i>--}}
            </label>
            <!--end::Label-->
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input offer_type price_change" type="radio" name="offer_type" value="value" {{$product->offer_type=='value'?'checked':''}} >
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        قيمة
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-right: 30px!important">
                    <input class="form-check-input offer_type price_change" type="radio" name="offer_type" value="percentage" {{$product->offer_type=='percentage'?'checked':''}}>
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        نسبة
                    </label>
                </div>
            </div>
        </div>
        <!--begin::Input group-->
        <div class=" mb-2 fv-row col-sm-6 mt-0" id="value_div"
             style="display: @if($product->has_offer=='no'||($product->has_offer=='yes'&&$product->offer_type=='percentage')) none @endif">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">القيمة </span>
                {{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="القيمة"></i>--}}
            </label>
            <!--end::Label-->
            <input type="text" name="value" value="{{$product->value}}" class="form-control form-control-solid numbersOnly price_change" placeholder="القيمة">
        </div>

        <div class=" mb-2 fv-row col-sm-6 mt-0" id="percentage_div"
             style="display: @if($product->has_offer=='no'||($product->has_offer=='yes'&&$product->offer_type=='value')) none @endif">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">النسبة </span>
                {{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="النسبة"></i>--}}
            </label>
            <!--end::Label-->
            <input type="text" name="percentage" value="{{$product->percentage}}" class="form-control form-control-solid numbersOnly price_change" placeholder="النسبة">
        </div>
        <!--begin::Input group-->
        <div class="mb-2 fv-row col-sm-6 mt-0" id="old_price_div" style="display: {{$product->has_offer=='no'?'none':''}}">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">السعر القديم </span>
                {{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="السعر القديم"></i>--}}
            </label>
            <input type="text" class="form-control form-control-solid numbersOnly price_change" placeholder="السعر القديم" name="old_price" value="{{$product->old_price}}"/>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">السعر </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="السعر"></i>
            </label>
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="السعر" name="price" value="{{$product->price}}"/>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الوصف (بالعربية) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الوصف (بالعربية)"></i>
            </label>
            <!--end::Label-->
            <textarea class="form-control form-control-solid" placeholder="الوصف (بالعربية)" name="description_ar" >{{$product->description_ar}}</textarea>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الوصف (بالانجليزية) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الوصف (بالانجليزية)"></i>
            </label>
            <!--end::Label-->
            <textarea class="form-control form-control-solid" placeholder="الوصف (بالانجليزية)" name="description_en" >{{$product->description_en}}</textarea>
        </div>
        <!--end::Input group-->
        <div class="col-lg-12 col-md-12">
            <div class="form-group">
                <label >الصورة</label>
                <div class="input-group file-browser">
                    <input type="text" class="form-control browse-file" placeholder="اختر" readonly>
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            تصفح <input accept="image/*" name="image" id="imgInp" type="file" style="display: none;" >
                        </span>
                    </label>
                </div>
                {{--                                        <input accept="image/*" type='file'  name="logo"  class="form-control form-control-solid" />--}}
                <img width="100" height="100" id="blah" src="{{$product->image}}" alt="your image" />
            </div>
        </div>

    </div>

</form>
<!--end::Form-->
<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>
<script>
    imgInp.onchange = evt => {
        $('#blah').show()
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
<script>
    $(document).on('change',"input[name='has_offer']", function (e){
        e.preventDefault()
        if ( this.value ==='yes'){
            $('#offer_type_div').show();
            $('#value_div').show();
            $('#percentage_div').show();
            $('#old_price_div').show();
        }else {
            $('#offer_type_div').hide();
            $('#value_div').hide();
            $('#percentage_div').hide();
            $('#old_price_div').hide();
        }
    })

    $(document).on('change',".offer_type",function (e) {
        e.preventDefault();
        var type = $('.offer_type:checked').val() ;
        if(type == 'value'){
            $('#value_div').show()
            $('#percentage_div').hide()
        }else {
            $('#value_div').hide()
            $('#percentage_div').show()
        }
    });

    $(document).on('keyup change',".price_change",function (e) {
        e.preventDefault();

        var type = $('.offer_type:checked').val() ;
        var value = $('input[name="value"]').val() || 0;
        var percentage = $('input[name="percentage"]').val() || 0;
        var old_price = $('input[name="old_price"]').val() || 0;
        if(type == 'value'){
            $('input[name="price"]').val(old_price - value)
            $('#value_div').show()
            $('#percentage_div').hide()
        }else {
            $('input[name="price"]').val( ( (100-percentage) / 100 ) * old_price )
            $('#percentage_div').show()
            $('#value_div').hide()
        }
    });
</script>
@include('Admin.Product.parts.GetMarketCategories')
