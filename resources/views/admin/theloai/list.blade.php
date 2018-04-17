@extends('admin.layouts.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clearfix">
                    <h1 class="page-header">Thể loại
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session('message'))
                    <div class="alert alert-success clearfix" role="alert">{{ session('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Tên không dấu</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($theloai as $tl)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tl->id}}</td>
                            <td>{{$tl->Ten}}</td>
                            <td>{{$tl->TenKhongDau}}</td>
                            <td class="center">
                                <a href="{{route('theloai.edit', $tl->id)}}"><i class="fa fa-trash-o fa-fw"></i>Edit</a>
                                &nbsp|

                                {!! Form::open(array('route' => array('theloai.destroy', $tl->id), 'method' => 'delete', 'style' => 'display:inline-block')) !!}
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