<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('sub_categories.update',$sub_category->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
{{--        <div class="d-flex flex-column mb-2 fv-row  col-sm-12">--}}
{{--            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">--}}
{{--                <span class="required">القسم</span>--}}
{{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" القسم "></i>--}}
{{--            </label>--}}
{{--            <select class="form-control form-control-solid select2" name="category_id">--}}
{{--                <option value="" selected disabled > القسم ...</option>--}}
{{--                @foreach($categories as $category)--}}
{{--                    <option {{$category->id==$sub_category->category_id?'selected':''}} value="{{$category->id}}"  >{{$category->name_ar}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
        <div class="d-flex flex-column mb-2 fv-row  col-sm-12">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">المطعم</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" المطعم "></i>
            </label>
            <select class="form-control form-control-solid select2" name="market_id">
                <option value="" selected disabled > المطعم ...</option>
                @foreach($markets as $market)
                    <option {{$market->id==$sub_category->market_id?'selected':''}} value="{{$market->id}}"  >{{$market->name_ar}}</option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم ( بالعربية ) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم ( بالعربية )"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالعربية )" name="name_ar" value="{{$sub_category->name_ar}}"/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم ( بالانجليزية ) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم ( بالانجليزية )"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالانجليزية )" name="name_en" value="{{$sub_category->name_en}}"/>
        </div>
        <!--end::Input group-->

    </div>

</form>
<!--end::Form-->


<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>

