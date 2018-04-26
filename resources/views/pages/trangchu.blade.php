@extends('layouts.index')

@section('title')
    Trang chủ
@endsection


@section('content')

        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#337AB7; color:white;">
                <h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
            </div>

            <div class="panel-body">

                @foreach($theloai as $tl)

                    <!-- item -->
                    <div class="row-item row">
                        <h3>
                            <a href="category.html">{{$tl->Ten}}</a> |
                            @if($tl->loaitin)
                                @foreach($tl->loaitin as $lt)
                            <small><a href="/loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
                                @endforeach
                                @endif

                        </h3>

                        @php
                            $data = $tl->tintuc->where('NoiBat', 1)->sortByDesc('created_at')->take(5);
                            $first_data = $data->shift();

                        @endphp

                        @if($first_data)
                        <div class="col-md-8 border-right">
                            <div class="col-md-5">
                                <a href="/tintuc/{{$first_data['id']}}/{{$first_data['TieuDeKhongDau']}}.html">

                                    <img class="img-responsive" src="uploads/tintuc/{{$first_data['Hinh']}}" alt="">

                                </a>
                            </div>

                            <div class="col-md-7">
                                <h3>{{$first_data['Ten']}}</h3>
                                <p>{{$first_data['TomTat']}}</p>
                                <a class="btn btn-primary" href="/tintuc/{{$first_data['id']}}/{{$first_data['TieuDeKhongDau']}}.html">View More<span
                                            class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>

                        </div>
                        @endif

                        @if($data)
                        <div class="col-md-4">
                                @foreach($data as $dt)
                                <a href="/tintuc/{{$dt->id}}/{{$dt->TieuDeKhongDau}}.html">
                                <h4>
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    {{$dt->TieuDe}}
                                </h4>
                                    @endforeach
                            </a>
                        </div>
                        @endif
                        <div class="break"></div>
                    </div>
                    <!-- end item -->

                @endforeach

            </div>
        </div>

@endsection