<!--begin::Form-->

<div class="row mt-0" style="direction: rtl;text-align: right">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">تفاصيل الطلب</h5>
            </div>

            <table class="table table-bordered table-hover mb-0 text-nowrap card-body">
                <thead>
                <tr>
                    <th><strong>القطعة</strong></th>
                    <th><strong>نوع القطعة</strong></th>
                    <th><strong>السعر</strong></th>
                </tr>
                </thead>
                <tbody>
                @if($order->details)
                    @foreach($order->details as $detail)
                        <tr>
                            <td><strong>{{$detail->part->name}}</strong></td>
                            <td>{{$detail->part->part_type->name}}</td>
                            <td>{{$detail->part->price}} ريال</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>
    </div>

</div>
<div class="text-center pt-3">
    <div class="d-inline-block pt-3">
        <button class="btn btn-light me-3 close_model" style="width: 100px">غلق</button>
    </div>
</div>
<!--end::Form-->




