<div class="card-header">
    <h3 class="card-title" >{{$title}}</h3>
    <div class="mr-auto pageheader-btn">
        @if($is_delete == true)
            @if(in_array($delete_permission,admin()->user()->permission_ids))
                <a href="#" id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                                <span>
                                                    <i class="fa fa-trash-o"></i>
                                                </span> حذف المحدد
                </a>
            @endif
        @endif
    </div>
</div>
