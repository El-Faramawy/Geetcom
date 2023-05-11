<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('parts.store')}}">
    @csrf
    <div class="row mt-0">

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row  col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">الموديل</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" الموديل "></i>
            </label>
            <!--end::Label-->
            <select class="form-control " name="brand_id">
                <option value="" selected disabled> الموديل ...</option>
                @foreach($brands as $brand)
                    <option {{$brand->id == $id ?'selected':''}} value="{{$brand->id}}" >{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row  col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">نوع القطعة</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" نوع القطعة "></i>
            </label>
            <!--end::Label-->
            <select class="form-control " name="type_id">
                <option value="" selected disabled> نوع القطعة ...</option>
                @foreach($part_types as $part_type)
                    <option value="{{$part_type->id}}" >{{$part_type->name}}</option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم ( بالعربية ) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم ( بالعربية )"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالعربية )" name="name_ar" value=""/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم ( بالانجليزية ) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم ( بالانجليزية )"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالانجليزية )" name="name_en" value=""/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">السعر </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="السعر"></i>
            </label>
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="السعر" name="price" value=""/>
        </div>
        <!--end::Input group-->

    </div>
</form>
<!--end::Form-->

