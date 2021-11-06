@extends('admin_temp')
@section('content')
    <!-- .chat-right-panel -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.replaies')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">{{trans('admin.replaies')}}</li>
                <li class="breadcrumb-item active"><a

                        @if($consolution->type == 'consultation')
                            href="{{route('consolutions')}}">
                        @else
                            href="{{route('inbox')}}">
                        @endif


                        @if($consolution->type == 'consultation')
                            {{trans('admin.consolutions')}}</a></li>
                        @else
                          {{trans('admin.communication')}}</a></li>
                         @endif

                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="chat-right-aside">
        <div class="col-md-12">
            <div class="card-body p-t-0">
                <div class="card b-all shadow-none">
                    <div class="card-body">
                        @if($consolution->consolution_kind)
                            <h3 class="card-title m-b-0">{{$consolution->consolution_kind->name_ar}}</h3>
                        @endif
                    </div>
                    <div>
                        <hr class="m-t-0">
                    </div>
                    <div class="card-body">
                        <div class="d-flex m-b-40">
                            <div>
                                <a href="javascript:void(0)"><img src="{{$consolution->user->image}}" alt="user"
                                                                  style="height:100px;" class="img-circle"/></a>
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
                                            style="height:50px;"
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
                                <textarea placeholder="{{trans('admin.type_message_here')}}" required name="reply" class="form-control"
                                          id="exampleFormControlTextarea1" rows="3"></textarea>
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
