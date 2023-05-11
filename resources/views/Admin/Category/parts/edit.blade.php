<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('categories.update',$category->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم ( بالعربية ) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم ( بالعربية )"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالعربية )" name="name_ar" value="{{$category->name_ar}}"/>
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
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالانجليزية )" name="name_en" value="{{$category->name_en}}"/>
        </div>
        <!--end::Input group-->

    </div>

</form>
<!--end::Form-->

