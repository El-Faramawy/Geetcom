<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('categories.store')}}">
    @csrf
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
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
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الإسم ( بالانجليزية ) </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الإسم ( بالانجليزية )"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="الإسم ( بالانجليزية )" name="name_en" value=""/>
        </div>
        <!--end::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0 ">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">قسم مميز </span>
            </label>
            <div class="d-flex align-items-center mb-3">
                <div class="form-check m-0 ">
                    <input class="form-check-input  " type="radio" name="featured" value="yes" >
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        نعم
                    </label>
                </div>
                <div class="form-check m-0  ms-3" style="margin-left: 30px!important">
                    <input class="form-check-input " type="radio" name="featured" value="no" checked>
                    <label class="form-check-label ms-5" style="margin-right: 20px;">
                        لا
                    </label>
                </div>
            </div>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12">
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

    </div>
</form>
<!--end::Form-->

<script>
    $(document).ready(function (){
        $('#blah').hide()
    })
    imgInp.onchange = evt => {
        $('#blah').show()
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
