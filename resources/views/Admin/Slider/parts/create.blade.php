<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('sliders.store')}}">
    @csrf
    <div class="row mt-0">


        <div class="d-flex flex-column mb-2 fv-row  col-sm-12">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">النوع</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" النوع "></i>
            </label>
            <select class="form-control form-control-solid select2" id="type" name="type">
                <option value="" selected disabled > النوع ...</option>
                <option value="product"  >منتج</option>
                <option value="market"  >مطعم</option>
            </select>
        </div>

        <div class=" mb-2 fv-row  col-sm-12" id="product_div" >
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">المنتج</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" المنتج "></i>
            </label>
            <select class="form-control form-control-solid select2" name="product_id">
                <option value="" selected disabled > المنتج ...</option>
                @foreach($products as $product)
                <option value="{{$product->id}}" >{{$product->name_ar}}</option>
                @endforeach
{{--                <option value="no" --}}{{--{{$market->is_available=='yes'?'selected':''}}--}}{{-- >غير فعال</option>--}}
            </select>
        </div>
        <div class=" mb-2 fv-row  col-sm-12" id="market_div" >
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">المطعم</span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title=" المطعم "></i>
            </label>
            <select class="form-control form-control-solid select2" name="market_id">
                <option value="" selected disabled > المطعم ...</option>
                @foreach($markets as $market)
                <option value="{{$market->id}}" >{{$market->name_ar}}</option>
                @endforeach
            </select>
        </div>

    </div>
</form>
<!--end::Form-->

<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>

<script>
    $(document).ready(function() {
        $('#market_div').hide();
    })
    $(document).on('change', '#type' , function(e){
        e.preventDefault();
        // alert($(this).val())
        if ($(this).val()=='product'){
            $('#product_div').show();
            $('#market_div').hide();
        }else {
            $('#market_div').show();
            $('#product_div').hide();
        }
        // $('span.select2.select2-container.select2-container--default.select2-container--focus').css('display', 'block!important');

    })
</script>
