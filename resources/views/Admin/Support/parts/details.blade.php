<!--begin::Form-->

    <div class="row mt-0">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">تفاصيل الطلب</h5>
                </div>
                <div class="card-body">
                    @if($products)
                        @foreach($products as $product)
                            <div class="clearfix row mb-4">
                                <div class="col">
                                    <div class="float-right">
                                        <h5 class="mb-0">
                                            <strong>
                                                {{$product->product?$product->product->name_ar:''}}
                                            </strong>
                                        </h5>
{{--                                        <small class="text-muted" style="display: block">{{$detail->offer_id == null ? 'Pasti':'Offerte'}}</small>--}}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="float-left">
                                        <small class="text-muted" style="display: block">الكمية : {{$product->amount}}</small>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
    <div class="text-center pt-3">
        <div class="d-inline-block pt-3">
            <button class="btn btn-light me-3 close_model" style="width: 100px">اغلاق</button>
        </div>
    </div>
<!--end::Form-->




