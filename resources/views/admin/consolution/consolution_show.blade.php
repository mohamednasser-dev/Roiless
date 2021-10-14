@extends('admin_temp')
@section('content')
    <!-- .chat-right-panel -->
    <div class="chat-right-aside">
        <div class="col-md-12">
            <p style="background-color:white">{{$consolution->content}}</p>
        </div>
        <div class="chat-main-header">
            <div class="p-20 b-b">
                <h3 class="box-title">reply</h3>
            </div>
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
            <div class="row">
                <form action="{{route('admin.reply')}}" class="form-horizontal form-material" method="POST">
                    @csrf
                    <input type="hidden" name="consulation_id" value="{{$consolution->id}}">
                    <div class="col-8">
                        <textarea placeholder="Type your message here" name="reply" class="form-control b-0"></textarea>
                    </div>
                    <div class="col-4 text-right">
                        <button type="submit" class="btn btn-info">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
