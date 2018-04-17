@extends('admin.layouts.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    {!! Form::open(array('route' => array('theloai.update', $theloai->id), 'class' => 'form-horizontal', 'method' => 'put')) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Tên sản phẩm', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('Ten', $theloai->Ten, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Chỉnh sửa sản phẩm', array('class' => 'btn btn-success')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection