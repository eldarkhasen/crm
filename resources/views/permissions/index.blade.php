{{-- \resources\views\permissions\index.blade.php --}}
@extends('layouts.master')

@section('title', '| Permissions')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Список доступов</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('permissions/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить доступ</a></li>

                    </ul>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Доступ</th>
                                    <th>Описание</th>
                                    <th>Операция</th>
                                </tr>
                                @foreach ($permissions as $permission)
                                    <tr>

                                        <td>{{ $permission->alias }}</td>
                                        <td>Не задано</td>
                                        <td>
                                            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                                            /
                                            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">

                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    {{--<div class="col-lg-10 col-lg-offset-1">--}}
        {{--<h1><i class="fa fa-key"></i>Available Permissions--}}

            {{--<a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>--}}
            {{--<a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>--}}
        {{--<hr>--}}
        {{--<div class="table-responsive">--}}
            {{--<table class="table table-bordered table-striped">--}}

                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>Permissions</th>--}}
                    {{--<th>Operation</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach ($permissions as $permission)--}}
                    {{--<tr>--}}
                        {{--<td>{{ $permission->name }}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>--}}

                            {{--{!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}--}}
                            {{--{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                            {{--{!! Form::close() !!}--}}

                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}

        {{--<a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>--}}

    {{--</div>--}}

@endsection