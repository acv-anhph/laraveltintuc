@extends('layouts.index')

@section('title')
    Tin tuc
@endsection

@section('content')
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-md-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Preview Image -->
            <img class="img-responsive" src="uploads/tintuc/{{$tintuc->Hinh}}" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <p>{!! $tintuc->NoiDung !!}</p>
            <hr>

            <!-- Blog Comments -->

        @if($logedin_user)
            <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="{{route('comment.store')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="idTinTuc" value="{{$tintuc->id}}">
                        <input type="hidden" name="idUser" value="{{$logedin_user->id}}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
                <hr>
        @endif

        <!-- Posted Comments -->

        @if($tintuc->comment)
            @foreach($tintuc->comment->sortByDesc('id')->all() as $cm)
                <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            {{--{!! dd($cm) !!}--}}
                            <h4 class="media-heading">{{$cm->user->name}}
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            {{$cm->NoiDung}}
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                @foreach($tinlienquan as $tlq)
                    <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="uploads/tintuc/{{$tlq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <p>{!! $tlq->TomTat !!}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                @foreach($tinnoibat as $tnb)
                    <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="uploads/tintuc/{{$tnb->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tnb->TieuDe}}</b></a>
                            </div>
                            <p>{{$tnb->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach

                </div>
            </div>

        </div>

    </div>
@endsection
