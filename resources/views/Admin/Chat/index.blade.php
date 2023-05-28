@extends('layouts.admin.app')
@section('page_title') رسائل الشات @endsection
@section('content')

    <!-- ROW-1 OPEN -->
    <div class="chatbox">
        <div class="card overflow-hidden">
            <div class="row">
                <div class="col-md-12 col-lg-5 col-xl-4 pl-lg-0 pr-lg-1 border-left">
{{--                    <div class="chat-search">--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="text" class="form-control  bg-white" placeholder="Search">--}}
{{--                            <div class="input-group-append ">--}}
{{--                                <button type="button" class="btn btn-primary ">--}}
{{--                                    <i class="fa fa-search" aria-hidden="true"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="contacts_body p-0">
                        <ul class="contacts mb-0">
                            @foreach ($users as $user)
                            <li class="active">
                                <a href="{{route('chats.index','id='.$user->id)}}" class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img src="{{$user->image}}"
                                            class="rounded-circle user_img" alt="img">
                                    </div>
                                    <div class="user_info">
                                        <h6 class="mt-1 mb-0 ">{{$user->name}}
{{--                                            <span class="dot-label bg-success mr-2"></span>--}}
                                        </h6>
{{--                                        <span class="">{{$user->last_message->message}}</span>--}}
                                    </div>
                                    <div class="float-left text-left mr-auto mt-auto mb-auto text-center">
{{--                                        <small>{{$user->last_message->created_at}}</small><br>--}}
                                        @if($user->unread_messages_count > 0)
                                            <span class="badge badge-success badge-pill">{{$user->unread_messages_count}}</span>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 col-xl-8 chat pr-lg-0 pl-lg-0">
                    @if(isset($one_user) )
                        <div class="card shadow-none  mb-0 border-0">
                        <div class="action-header clearfix">
                            <div class="float-right hidden-xs d-flex mr-2">
                                <div class="img_cont ml-3">
                                    <img src="{{$one_user->image}}" class="rounded-circle user_img" alt="img">
                                </div>
                                <div class="align-items-center mt-2">
                                    <h4 class="mb-0 font-weight-semibold">{{$one_user->name}}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- ACTION HEADER END -->
                        <!-- MSG CARD-BODY OPEN -->
                        <div class="card-body msg_card_body">
{{--                            <div class="chat-box-single-line">--}}
{{--                                <abbr class="timestamp">February 1st, 2019</abbr>--}}
{{--                            </div>--}}
                            @if($one_user->chat_messages)
                                @foreach($one_user->chat_messages as $message)
                                    @if($message->message_from == 'admin')
                                    <div class="d-flex justify-content-start">
                                        <div class="img_cont_msg">
                                            <img src="{{setting()->logo}}"
                                                class="rounded-circle user_img_msg" alt="img">
                                        </div>
                                        <div class="msg_cotainer">
                                            {{$message->message}}
                                            <span class="msg_time" style="min-width: 115px;"> {{date('Y-m-d ',strtotime($message->created_at))}} , {{date('h:i A',strtotime($message->created_at))}}</span>
                                        </div>
                                    </div>
                                    @else
                                        <div class="d-flex justify-content-end">
                                            <div class="msg_cotainer_send">
                                                {{$message->message}}
                                                <span class="msg_time_send" style="min-width: 115px;">{{date('Y-m-d ',strtotime($message->created_at))}} , {{date('h:i A',strtotime($message->created_at))}}</span>
                                            </div>
                                            <div class="img_cont_msg">
                                                <img
                                                    src="{{$one_user->image}}"
                                                    class="rounded-circle user_img_msg" alt="img">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                        <!-- MSG CARD-BODY END -->
                        <!-- CARD-FOOTER OPEN -->
                            <form id="message_form" method="post" action="{{route('send_chat')}}" enctype="application/x-www-form-urlencoded">
                                @csrf
                                <div class="card-footer">
                                    <div class="input-group">
                                        <input type="text" name="message" class="form-control type_msg" placeholder="اكتب الرسالة هنا ...">
                                        <span class="input-group-append">
                                            <input class="btn btn-primary send_btn" value="ارسال" type="submit">
{{--                                                <i class="fa fa-paper-plane-o"></i>--}}
{{--                                            </button>--}}
                                        </span>
                                    </div>
                                </div><!-- CARD FOOTER END -->
                            </form>
                    </div>
                    @else
                        <div class="card shadow-none  mb-0 border-0">
                            <img src="{{setting()->logo}}" style="width: 50%;height: 50%;margin: auto;"
                                 class="rounded-circle user_img_msg" alt="img">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->

@endsection
@push('admin_js')
    <script>
        $(document).ready(function(){
            $(".msg_card_body").animate({ scrollTop: $('.msg_card_body').prop("scrollHeight")}, 1000);
        });
    </script>

    <script>
        $(document).on('submit',"#message_form",function (e) {
            e.preventDefault();
            // alert(1)
            var message = $('.type_msg').val();
            var user_id = '{{$one_user->id}}'
            var formData = new FormData(this);
            formData.append('user_id', user_id);
            if (message === '' || message === ' '){
                my_toaster('اكتب رسالتك','error')
            }
            else {
                $.ajax({
                    url: '{{route("send_chat")}}',
                    type: 'POST',
                    data: formData,
                    success: function (data) {

                        window.setTimeout(function () {

                            if (data.success === 'true') {
                                // alert(1)
                                $("#message_form")[0].reset();

                                var html_user_content = `
                                         <div class="d-flex justify-content-start">
                                            <div class="img_cont_msg">
                                                <img src="{{setting()->logo}}"
                                                    class="rounded-circle user_img_msg" alt="img">
                                            </div>
                                            <div class="msg_cotainer">
                                                ${message}
                                                <span class="msg_time" style="min-width: 115px;">{{date('Y-m-d ',strtotime($message->created_at))}} , {{date('h:i A',strtotime($message->created_at))}}</span>
                                            </div>
                                        </div>`;

                                $('.msg_card_body').append( html_user_content);
                                $(".msg_card_body").animate({ scrollTop: $('.msg_card_body').prop("scrollHeight")}, 1000);

                            }else {
                                var messages = Object.values(data.messages);
                                $( messages ).each(function(index, message ) {
                                    my_toaster(message,'error')
                                });
                            }
                        }, 100);

                    },
                    error: function (data) {
                        // console.log(data)
                        if (data.status === 500) {
                            my_toaster('هناك خطأ ما','error')
                        }

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);

                            $.each(errors, function (key, value) {
                                if ($.isPlainObject(value)) {
                                    $.each(value, function (key, value) {
                                        my_toaster(value,'error')
                                    });

                                }
                            });
                        }
                        if (data.status == 421){
                            my_toaster(data.message,'error')
                        }

                    },//end error method

                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });

    </script>

@endpush
