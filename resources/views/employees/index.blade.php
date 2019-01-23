{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', '| Сотрудники')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Список сотрудников</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('employees/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить сотрудника</a></li>
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
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Отчество</th>
                                    <th>Дата добавления</th>
                                    <th>Должность</th>
                                    <th>Действие</th>
                                </tr>
                                @foreach ($employees as $emp)
                                <tr>

                                <td>{{ $emp->name }}</td>
                                <td>{{ $emp->surname }}</td>
                                <td>{{ $emp->patronymic }}</td>
                                <td>{{ $emp->created_at->toDateTimeString() }}</td>
                                <td>{{ $emp->positions()->pluck('name')->implode(' ') }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $emp->id) }}"><i class="fa fa-edit"></i></a>
                                    /
                                    <a href="{{ route('employees.edit', $emp->id) }}"><i class="fa fa-trash-alt"></i></a>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {!! $employees->render() !!}
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
        {{--<h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>--}}
            {{--<a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>--}}
        {{--<hr>--}}
        {{--<div class="table-responsive">--}}
            {{--<table class="table table-bordered table-striped">--}}

                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>Name</th>--}}
                    {{--<th>Email</th>--}}
                    {{--<th>Date/Time Added</th>--}}
                    {{--<th>User Roles</th>--}}
                    {{--<th>Operations</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}

                {{--<tbody>--}}
                {{--@foreach ($users as $user)--}}
                    {{--<tr>--}}

                        {{--<td>{{ $user->name }}</td>--}}
                        {{--<td>{{ $user->email }}</td>--}}
                        {{--<td>{{ $user->created_at->format('F d, Y h:ia') }}</td>--}}
                        {{--<td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>--}}

                            {{--{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}--}}
                            {{--{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                            {{--{!! Form::close() !!}--}}

                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}

            {{--</table>--}}
        {{--</div>--}}

        {{--<a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>--}}

    {{--</div>--}}

@endsection