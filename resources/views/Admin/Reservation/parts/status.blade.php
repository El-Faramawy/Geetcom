<!--begin::Form-->

<form enctype="multipart/form-data" method="POST" >
    @csrf
    <input type="hidden" name="id" id="reservation_id" value="{{$reservation->id}}">
    <div class="row mt-0">
        <h1>تغيير حالة الحجز </h1>
    </div>
    <div class="text-center pt-3">
        <div class="d-inline-block ">
            <input  form="form" value="جديد" status="new" type="submit" class="btn btn-info status_submit" style="width: 100px">
            <input  form="form" value="مقبول" status="accepted" type="submit" class="btn btn-primary status_submit" style="width: 100px">
            <input  form="form" value="مرفوض" status="refused" type="submit" class="btn btn-danger status_submit" style="width: 100px">
            <input  form="form" value="ملغى" status="canceled" type="submit" class="btn btn-warning status_submit" style="width: 100px">
            <input  form="form" value="انهاء" status="ended" type="submit" class="btn btn-success status_submit" style="width: 100px">
        </div>

    </div>
</form>
<!--end::Form-->




