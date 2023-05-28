<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{url('Admin')}}/assets/plugins/multipleselect/multiple-select.css">

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('additions.store')}}">
    @csrf
    <div class="row mt-0">
        <div class="d-flex flex-column mb-2 fv-row col-sm-6">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> اقسام الاضافات </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="اقسام الاضافات"></i>
            </label>
            <select class="form-control select2" name="addition_category_id" data-placeholder="اختر القسم" >
                <option disabled selected> اقسام الاضافات </option>
               @foreach($addition_categories as $addition_category)
                    <option value="{{$addition_category->id}}"> {{$addition_category->name_ar}} ( {{$addition_category->choise=='one'?'واحد':'متعدد'}} ) </option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">السعر </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="السعر"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="السعر" name="price" value=""/>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 col-md-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاسم (بالعربية) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاسم (بالعربية)"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الاسم (بالعربية)" name="name_ar" value=""/>
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
            <input type="text" class="form-control form-control-solid" placeholder="الاسم (بالانجليزية)" name="name_en" value=""/>
        </div>
        <!--end::Input group-->



        <div class="d-flex flex-column mb-2 fv-row col-sm-12">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required"> المنتجات </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7  text-primary" title="المنتجات"></i>
            </label>
            <!--end::Label-->
{{--            <select class="form-control select2" name="products[]" data-placeholder="scegli المنتجات" multiple>--}}
{{--                @foreach($products as $product)--}}
{{--                    <option value="{{$product->id}}"> {{$product->name}} </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
            <select multiple="multiple" name="products[]" class="group-filter" >
                @foreach($markets as $market )
                    <optgroup label="{{$market->name_ar}}">
                        @foreach($market->products as $product)
                            <option value="{{$product->id}}">{{$product->name_ar}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>


    </div>
</form>
<!--end::Form-->
<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>

<script src="{{url('Admin')}}/assets/plugins/multipleselect/multiple-select.js"></script>
<script src="{{url('Admin')}}/assets/plugins/multipleselect/multi-select.js"></script>
