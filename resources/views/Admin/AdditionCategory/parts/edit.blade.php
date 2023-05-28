<form id="form" enctype="multipart/form-data" method="POST" action="{{route('addition_categories.update',$addition_category->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 col-md-6 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاسم (بالعربية) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاسم (بالعربية)"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الاسم (بالعربية)" name="name_ar" value="{{$addition_category->name_ar}}"/>
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
            <input type="text" class="form-control form-control-solid" placeholder="الاسم (بالانجليزية)" name="name_en" value="{{$addition_category->name_en}}"/>
        </div>
        <!--end::Input group-->

        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0 ">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">عدد الاختيارات </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" عدد الاختيارات "></i>
            </label>
            <!--end::Label-->
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input  " type="radio" name="choise" value="multiple" {{$addition_category->choise=='multiple'?'checked':''}} >
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        متعدد
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-right: 30px!important">
                    <input class="form-check-input " type="radio" name="choise" value="one" {{$addition_category->choise=='one'?'checked':''}} >
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        واحد
                    </label>
                </div>
            </div>
        </div>

    </div>

</form>
