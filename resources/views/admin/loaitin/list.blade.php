@extends('admin.layouts.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại tin
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    @if(session('message'))
                        <div class="alert alert-success clearfix" role="alert">{{ session('message') }}</div>
                    @endif
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Tên không dấu</th>
                        <th>Thể loại</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loaitin as $lt)
                        <tr class="even gradeC" align="center">
                            <td>{{$lt->id}}</td>
                            <td>{{$lt->Ten}}</td>
                            <td>{{$lt->TenKhongDau}}</td>
                            <td>{{$lt->theloai->Ten}}</td>
                            <td class="center"><a href="{{route('loaitin.edit', $lt->id)}}"><i
                                            class="fa fa-trash-o fa-fw"></i>Edit</a>
                                &nbsp|

                                {!! Form::open(array('route' => array('loaitin.destroy', $lt->id), 'method' => 'delete', 'style' => 'display:inline-block')) !!}
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