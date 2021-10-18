@extends('admin_temp')
@section('content')
    <!-- .chat-right-panel -->
    <div class="chat-right-aside">
        <div class="col-md-12">
            <div class="card-body p-t-0">
                <div class="card b-all shadow-none">
                    <div class="card-body">
                        <h3 class="card-title m-b-0">{{$consolution->consolution_kind->name_ar}}</h3>
                    </div>
                    <div>
                        <hr class="m-t-0">
                    </div>
                    <div class="card-body">
                        <div class="d-flex m-b-40">
                            <div>
                                <a href="javascript:void(0)"><img src="{{$consolution->user->image}}" alt="user" width="50" hight="65" class="img-circle" /></a>
                            </div>
                            <div class="p-l-10">
                                <h4 class="m-b-0">{{$consolution->user->name}}</h4>
                                <small class="text-muted">{{$consolution->email}}</small>
                                <p>phone:{{$consolution->phone}}</p>
                                <p>country:{{$consolution->country}}</p>
                            </div>
                        </div>
                        <p>{{$consolution->content}}</p>
                    </div>
                    <div>
                        <hr class="m-t-0">
                    </div>
                    <div class="chat-main-header">
        </div>
        <div class="chat-rbox">
            <ul class="chat-list p-20">
                @foreach($replies as $reply)
                    <li>
                        <div class="chat-img"><img
                                src="@if($reply->admin_id != null) {{$reply->Admin->image}} @else {{$reply->user->image}}  @endif"
                                alt="user"/>
                        </div>
                        <div class="chat-content">
                            <h5>@if($reply->admin_id != null) {{$reply->Admin->name}} @else {{$reply->user->name}}  @endif</h5>
                            <div class="box bg-light-info"> {{$reply->reply}}</div>
                        </div>
                        <div class="chat-time">{{$reply->created_at->format('Y-m-d g:i a')}}</div>
                    </li>
                @endforeach
            </ul>
        </div>
            <div class="card-body b-t">
                <form action="{{route('admin.reply')}}" class="form-horizontal form-material" method="POST">
                    @csrf
                    <input type="hidden" name="consulation_id" value="{{$consolution->id}}">
                        <div class="form-group">
                            <textarea placeholder="Type your message here" name="reply" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="col-4 text-right">
                        <button type="submit" class="btn btn-info">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
