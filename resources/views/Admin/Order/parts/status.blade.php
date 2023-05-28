<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="id" id="order_id" value="{{$id}}">
    <div class="row mt-0">
        <h1>تعديل حالة الطلب</h1>
    </div>
{{--    @if($order->status == 'preparing')--}}
{{--        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">--}}
{{--            <label class="d-flex align-items-center fs-6 fw-bold form-label ">--}}
{{--                <span class="required">Consegna </span>--}}
{{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="la categoria"></i>--}}
{{--            </label>--}}
{{--            <select name="delivery_id" class="form-control form-control-solid select2" id="delivery_id">--}}
{{--                <option value="" selected disabled>Consegna</option>--}}
{{--                @foreach($deliveries as $delivery)--}}
{{--                    <option value="{{$delivery->id}}" {{$delivery->id==$order->delivery_id?'selected':''}}>{{$delivery->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    @endif--}}

    <div class="text-center pt-3">
        <div class="d-inline-block ">
            <input form="form" value="غير مدفوع" status="not_paid" type="submit" class="btn btn-danger status_submit" style="width: 125px">
            <input form="form" value="جديد" status="new" type="submit" class="btn btn-info status_submit" style="width: 125px">
            <input form="form" value="مقبول" status="accepted" type="submit" class="btn btn-primary status_submit" style="width: 125px">
{{--            <input form="form" value="Respinto" status="rejected" type="submit" class="btn btn-danger status_submit" style="width: 125">--}}
            <input form="form" value="فى الطريق للمطعم" status="in_market_way" type="submit" class="btn btn-primary status_submit" style="width: 125px">
            <input form="form" value="فى انتظار الطلب" status="wait_order" type="submit" class="btn btn-primary status_submit" style="width: 125px">
            <input form="form" value="جارى التوصيل" status="delivery" type="submit" class="btn btn-secondary status_submit" style="width: 125px">
            <input form="form" value="منتهى" status="ended" type="submit" class="btn btn-success status_submit" style="width: 125px">
            <input form="form" value="ملغى من الادارة" status="canceled_from_admin" type="submit" class="btn btn-warning status_submit" style="width: 125px">
        </div>
        {{--        <div class="d-inline-block ">--}}
        {{--            <button type="reset" data-dismiss="modal" class="btn btn-light me-3 " style="width: 100px">غلق</button>--}}
        {{--        </div>--}}
    </div>
</form>
<!--end::Form-->
<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>



