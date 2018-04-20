@extends('admin.layouts.index')

@section('content')
    <div id="page-wrapper">
        @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tóm tắt</th>
                        <th>Thể loại</th>
                        <th>Loại tin</th>
                        <th>Xem</th>
                        <th>Nổi bật</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc as $tt)
                        <tr class="even gradeC" align="center">
                            <td>{{$tt->id}}</td>
                            <td>
                                {{$tt->TieuDe}}
                                <img src="/uploads/tintuc/{{$tt->Hinh}}" alt="" class="img-responsive" width="130" height="100">
                            </td>
                            <td>{{$tt->TomTat}}</td>
                            <td>{{$tt->loaitin->theloai->Ten}}</td>
                            <td>{{$tt->loaitin->Ten}}</td>
                            <td>{{$tt->SoLuotXem}}</td>
                            <td>{{$tt->NoiBat}}</td>
                            <td class="center"><a href="{{route('tintuc.edit', $tt->id)}}"><i
                                            class="fa fa-trash-o fa-fw"></i>Edit</a>
                                &nbsp|

                                {!! Form::open(array('route' => array('tintuc.destroy', $tt->id), 'method' => 'delete', 'style' => 'display:inline-block')) !!}
                                <button type="submit" style="background:none!important;
                                                             color:inherit;
                                                             border:none;
                                                             padding:0!important;
                                                             font: inherit;
                                                             cursor: pointer;
                                                             :hover:
                                                             ">
                                    <i class="fa fa-pencil fa-fw"></i>Delete
                                </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection