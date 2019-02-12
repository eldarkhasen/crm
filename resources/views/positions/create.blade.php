@extends('layouts.master')

@section('title', '| Новая должность')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить новую должность</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <form method ="POST" action = "{{ URL::to('positions') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Наименование</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                    {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Описание</label>
                                    <textarea class="form-control" id="inputName" name = "description" rows="4"></textarea>

                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Добавить</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--<div class='col-lg-4 col-lg-offset-4'>--}}

    {{--<h1><i class='fa fa-key'></i> Add Role</h1>--}}
    {{--<hr>--}}

    {{--{{ Form::open(array('url' => 'roles')) }}--}}

    {{--<div class="form-group">--}}
    {{--{{ Form::label('name', 'Name') }}--}}
    {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
    {{--</div>--}}

    {{--<h5><b>Assign Permissions</b></h5>--}}

    {{--<div class='form-group'>--}}
    {{--@foreach ($permissions as $permission)--}}
    {{--{{ Form::checkbox('permissions[]',  $permission->id ) }}--}}
    {{--{{ Form::label($permission->name, ucfirst($permission->name)) }}<br>--}}

    {{--@endforeach--}}
    {{--</div>--}}

    {{--{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

    {{--{{ Form::close() }}--}}

    {{--</div>--}}

@endsection