@extends('layouts.master')

@section('title', '| Редатировать должность')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактировать должность</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        {{ Form::model($position, array('route' => array('positions.update', $position->id), 'method' => 'PUT')) }}

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" id="inputName" name = "name" value = "{{$position->name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <textarea class="form-control" id="inputName" name = "description" rows="4" >{{$position->description}}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="" onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();" class="btn btn-danger">Удалить</a>

                        </div>
                        {{ Form::close() }}
                        {{ Form::open(array('route' => array('positions.destroy', $position->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
                        <button type="submit" class="btn btn-danger">Удалить</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--<div class='col-lg-4 col-lg-offset-4'>--}}
    {{--<h1><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h1>--}}
    {{--<hr>--}}

    {{--{{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}--}}

    {{--<div class="form-group">--}}
    {{--{{ Form::label('name', 'Role Name') }}--}}
    {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
    {{--</div>--}}

    {{--<h5><b>Assign Permissions</b></h5>--}}
    {{--@foreach ($permissions as $permission)--}}

    {{--{{Form::checkbox('permissions[]',  $permission->id, $role->permissions , ['class' => 'form-check-input']) }}--}}
    {{--{{Form::label($permission->name, ucfirst($permission->name)),['class' => 'form-check-label'] }}<br>--}}

    {{--@endforeach--}}
    {{--<br>--}}
    {{--{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}--}}

    {{--{{ Form::close() }}--}}
    {{--</div>--}}

@endsection