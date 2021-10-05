@extends('admin_temp')
@section('content')
 <p>hallo world</p>

  <!-- .chat-right-panel -->
  <div class="chat-right-aside">
                                    <div class="chat-main-header">
                                        <div class="p-20 b-b">
                                            <h3 class="box-title">Chat Message</h3>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                        <ul class="chat-list p-20">
                                            <!--chat Row -->
                                           
                                            @foreach($replies as $reply)
                                            <li>
                                                <div class="chat-img"><img src="../assets/images/users/1.jpg" alt="user" /></div>
                                                <div class="chat-content">
                                                    <h5>James Anderson</h5>
                                                    <div class="box bg-light-info">{{$reply->content}}</div>
                                                </div>
                                                <div class="chat-time">10:56 am</div>
                                            </li>
                                            @endforeach 
                                        </ul>
                                    </div>
                                    <div class="card-body b-t">
                                        <div class="row">
                                            <div class="col-8">
                                                <textarea placeholder="Type your message here" class="form-control b-0"></textarea>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fa fa-paper-plane-o"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                            <!-- /.chat-row -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
@endsection