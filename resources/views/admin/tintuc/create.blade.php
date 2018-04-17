@extends('admin.layouts.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tuc
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    {!! Form::open(array('route' => array('tintuc.store'), 'class' => 'form-horizontal', 'method' => 'post')) !!}

                    <div class="form-group">
                        {!! Form::label('TheLoai', 'Thể loại', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-9">
                            <select name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">
                                        {{$tl->Ten}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('LoaiTin', 'Loại tin', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-9">
                            <select name="LoaiTin" id="LoaiTin">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Tên loại tin', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('Ten', '', array('class' => 'form-control')) !!}
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
    <!-- /#page-wrapper -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var loaitin = $("#LoaiTin");
            if (loaitin.length) {
                $.get('/admin/ajax/loaitin/' + '1', function (data) {
                    $("#LoaiTin").html(data);
                });
            }

            $("#TheLoai").on('change', function () {
                var idTheLoai = $(this).val();
                $.get('/admin/ajax/loaitin/' + idTheLoai, function (data) {
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection