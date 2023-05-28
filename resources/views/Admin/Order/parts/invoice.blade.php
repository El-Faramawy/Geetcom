<!doctype html>
<html lang="en" dir="rtl">

<head>

    @include('layouts.admin.css')

</head>

<body class="app sidebar-mini">


<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{url('Admin')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">

    <div class="app-content" style="margin-right:0!important;">
        <div class="side-app">
            <!-- PAGE-HEADER -->
{{--            <div class="page-header">--}}
{{--                <div>--}}
{{--                    <h1 class="page-title">الفاتورة</h1>--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>--}}
{{--                        <li class="breadcrumb-item active" aria-current="page">الفاتورة</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}

{{--            </div>--}}


            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" id="print_div">
                            <div class="clearfix">
                                <div class="float-right">
                                    <h3 class="card-title mb-0"># فاتورة رقم-{{$order->id}}</h3>
                                </div>
                                <div class="float-left">
                                    <p class="mb-1"><span class="font-weight-bold">التاريخ :</span> {{date('d-m-Y', strtotime($order->created_at))}}</p>
                                    <p class="mb-0"><span class="font-weight-bold">العميل :</span> {{$order->user?$order->user->name:''}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <p class="h3">بيانات الفاتورة:</p>
                                    <address>
                                        <b>المطعم : </b>  {{$order->market?$order->market->name_ar : ''}}<br>
                                        <b>المندوب : </b>  {{$order->delivery?$order->delivery->name : ''}}<br>
                                        <b>طريقة الدفع : </b> {{$order->pay_type =='wallet'? 'المحفظة' : 'الكترونى'}}
                                    </address>
                                </div>
                                <div class="col-lg-6 text-left">
                                    <p class="h3">عنوان العميل:</p>
                                    <address>
                                        <b>الاسم : </b> {{$order->address?$order->address->recipient_name : ''}}<br>
                                        <b>رقم الهاتف : </b> {{$order->address?$order->address->recipient_number : ''}}<br>
                                        <b>العنوان : </b> {{$order->address?$order->address->address : ''}}
                                    </address>
                                </div>
                            </div>
                            <div class="table-responsive push">
                                <table class="table table-bordered table-hover mb-0 text-nowrap">
                                    <tbody>
                                    <tr class=" ">
                                        <th class="text-center"></th>
                                        <th>المنتج</th>
                                        <th class="text-center">الكمية</th>
                                        <th class="text-right">السعر</th>
                                        <th class="text-right">السعر الاجمالى</th>
                                    </tr>
                                    @foreach($order->order_details as $key=>$detail)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>
                                                <p class="font-w600 mb-1">
                                                    {{$detail->product ?$detail->product->name: ''}}
                                                </p>
                                                <div class="text-muted">
                                                    @if($detail->additions)
                                                        @foreach($detail->additions as $addition)
                                                            <div class="text-muted">
                                                                {{$addition->addition->name}} ( {{$addition->addition->price}} ريال )
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">{{$detail->amount}}</td>
                                            <td class="text-right number-font1">{{$detail->price}} ريال</td>
                                            <td class="text-right number-font1">{{$detail->sub_total}} ريال</td>
                                        </tr>
                                    @endforeach
                                    @if($order->coupon || $order->delivery_price > 0)
                                        <tr>
                                            @if($order->coupon)
                                                <td colspan="2" class="font-weight-bold text-uppercase text-left">كود الكوبون : {{$order->coupon->code}}
                                                </td>
                                                <td class="font-weight-bold text-right h4 number-font1">
                                                    @if($order->coupon->type == 'value')( {{$order->coupon->value}} ريال )
                                                    @else <p>( {{$order->coupon->percentage}} % )</p>
                                                    @endif
                                                </td>
                                                {{--                                                <td  class="font-weight-bold text-uppercase text-left">Tips</td>--}}
                                            @endif
                                            @if($order->delivery_price > 0)
                                                <td colspan="1" class="font-weight-bold text-uppercase text-left">سعر التوصيل</td>
                                                <td class="font-weight-bold text-right h4 number-font1">{{$order->delivery_price}} ريال</td>
                                            @endif
                                        </tr>
                                    @endif
{{--                                    @if($order->coupon )--}}
{{--                                        <tr>--}}
{{--                                            <td colspan="3" class="font-weight-bold text-uppercase text-right">كود الكوبون : {{$order->coupon->code}}--}}
{{--                                                @if($order->coupon->type == 'value')( {{$order->coupon->value}} ريال )--}}
{{--                                                @else '( {{$order->coupon->percentage}} % )'--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-uppercase text-right">الاجمالى</td>
                                        <td class="font-weight-bold text-right h4 number-font1">{{$order->total}} ريال</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger mb-1" onclick="/*printClient('print_div');*/ javascript:window.print();"><i
                                    class="fa fa-print"></i> طباعة الفاتورة
                            </button>
                        </div>
                    </div>
                </div><!-- COL-END -->
            </div>



        </div><!-- End Page -->
    </div>
    <!-- CONTAINER END -->
    </div>
</div>
<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

@include('layouts.admin.js')


</body>

</html>




{{--@push('admin_js')--}}
{{--    <script>--}}
{{--        function printClient(elem) {--}}
{{--            var mywindow = window.open('', 'PRINT', 'height=400,width=600');--}}
{{--            mywindow.document.write('<html><head>' +--}}
{{--                '<title>Ali Pizza</title>');--}}
{{--            mywindow.document.write('</head><body style="direction: ltr">');--}}
{{--            mywindow.document.write(document.getElementById(elem).innerHTML);--}}
{{--            mywindow.document.write('</body></html>');--}}

{{--            mywindow.document.close(); // necessary for IE >= 10--}}
{{--            mywindow.focus(); // necessary for IE >= 10*/--}}

{{--            mywindow.print();--}}
{{--            mywindow.close();--}}

{{--            return true;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}
