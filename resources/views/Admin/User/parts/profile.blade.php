@extends('layouts.admin.app')
@section('page_title') البروفايل @endsection
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user text-center">
                        <div class="wideget-user-desc">
                            <div class="wideget-user-img">
                                <img class="" src="{{get_file($user->image)}}" onclick="window.open(this.src)" alt="img"></div>
                            <div class="user-wrap"><h4
                                    class="mb-1">{{$user->name}}</h4> <h6
                                    class="text-muted mb-4">
                                    رقم الهاتف : {{$user->phone_code.$user->phone}}</h6>
                                <a href="tel:{{$user->phone_code.$user->phone}}"
                                   class="btn btn-primary mt-2 mb-1"><i
                                        class="fa fa-phone"></i> اتصال </a>
                                <span href="" class="btn btn-secondary mt-2 mb-1"><i
                                        class="fa fa-thumbs-{{$user->is_active == 'yes'?'up':'down'}}"></i> {{$user->is_active == 'yes'?'مفعل':'غير مفعل'}} </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="float-left"><h3 class="card-title">بيانات شخصية</h3></div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body wideget-user-contact">

                    <div class="media mb-5 mt-0">
                        <div class="d-flex ml-3"><span class="user-contact-icon bg-primary"><i
                                    class="fa fa-globe text-white"></i></span></div>
                        <div class="media-body"><a href="#" class="text-dark">المحافظة</a>
                            <div class="text-muted fs-14">{{$user->governorate->name ?? ''}}</div>
                        </div>
                    </div>

                    <div class="media mb-5 mt-0">
                        <div class="d-flex ml-3"><span class="user-contact-icon bg-info"><i
                                    class="fa fa-flag text-white"></i></span></div>
                        <div class="media-body"><a href="#" class="text-dark">المدينة</a>
                            <div class="text-muted fs-14">{{$user->city->name ?? ''}}</div>
                        </div>
                    </div>


                    <div class="media mb-5 mt-0">
                        <div class="d-flex ml-3"><span class="user-contact-icon bg-danger"><i
                                    class="fa fa-money text-white"></i></span></div>
                        <div class="media-body"><a class="text-dark">المحفظة</a>
                            <div class="text-muted fs-14">{{$user->wallet}}</div>
                        </div>
                    </div>

                    <div class="media mb-0 mt-0">
                        <div class="d-flex ml-3"><span class="user-contact-icon bg-success"><i
                                    class="fa fa-shopping-cart text-white"></i></span></div>
                        <div class="media-body"><a class="text-dark">اجمالى المبيعات</a>
                            <div class="text-muted fs-14">{{$user->points}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-51" class="show active" data-toggle="tab">الطلبات <i
                                            class="fa fa-shopping-cart"></i> </a>
                                </li>
                                <li><a href="#tab-61" data-toggle="tab" class="">المحفظة <i class="fa fa-money mr-1"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="tab-51">
                    <div class="card">
                        <div class="card-body">
                            <div class="example">
                                <ul class="list-group">
                                    <li class="list-group-item justify-content-between"> طلبات جديدة <span
                                            class="badgetext badge badge-warning badge-pill">{{$new_order_count}}</span>
                                    </li>
                                    <li class="list-group-item justify-content-between"> طلبات قيد التحضير <span
                                            class="badgetext badge badge-info badge-pill">{{$on_going_order_count}}</span>
                                    </li>
                                    <li class="list-group-item justify-content-between"> طلبات قيد التوصيل <span
                                            class="badgetext badge badge-primary badge-pill">{{$delivery_order_count}}</span>
                                    </li>
                                    <li class="list-group-item justify-content-between"> طلبات منتهية <span
                                            class="badgetext badge badge-success badge-pill">{{$ended_order_count}}</span>
                                    </li>
                                    <li class="list-group-item justify-content-between"> طلبات ملغية <span
                                            class="badgetext badge badge-danger badge-pill">{{$canceled_order_count}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-61">
                    <div class="card">
                        <div class="card-body">
                            <div id="profile-log-switch">
                                <div class="media-heading">
                                    <h5><strong>معاملات المحفظة</strong></h5>
                                </div>
                                <div class="row">
                                    @forelse($user->wallets as $wallet)
                                    <div class=" col-lg-12 col-md-12">
                                        <div class="card borderover-flow-hidden">
                                            <div class="d-flex card-body media-xs overflow-visible ">
                                                <div class="media-body valign-middle mt-1">
                                                    <a href="" class=" font-weight-semibold text-dark">
                                                        {{$wallet->type!='register' ?'بعد طلب رقم  ' . $wallet->order_id ?? '' :''}}</a>
                                                    <p class="text-muted mb-0">{{$wallet->price}}</p>
                                                </div>
                                                <div class="media-body valign-middle text-left overflow-visible mt-2">
                                                    <button class="btn btn-light btn-sm" type="button">
                                                        @if($wallet->type=='purchases') طلب
                                                        @elseif($wallet->type=='target') تحقيق هدف
                                                        @else تسجيل دخول
                                                        @endif
                                                    </button>
                                                    <p class="text-muted mb-0 ml-2">{{date('Y-m-d',strtotime($wallet->created_at))}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <span class="text-muted">لا يوجد تعاملات</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="media-heading">
                                <h5><strong>الاهداف</strong></h5>
                            </div>
                            <div class="row mt-5">
                                @foreach ($targets as $target)
                                    <div class="col-md-12">
                                        <label>{{$target->gifts_for}}</label>
                                        <div class="progress progress-md mb-3">
                                            <div class="progress-bar bg-{{$target->percentage == 100 ? 'success':'danger'}} w-{{round($target->percentage,-1)}}">{{$target->percentage}}%</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- COL-END -->
    </div>
@endsection
