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

                        <form method ="POST" action = "{{ URL::to('roles') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Наименование</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                </div>
                                @if(!$permissions->isEmpty())
                                    <div class="form-group">
                                        <label for="#inputRoles">Дать доступ</label>
                                        <div class="form-check" id="inputRoles">
                                            @foreach($permissions as $permission)
                                                <input name = "permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}">
                                                <label class="form-check-label" for = "{{$permission->name}}">{{$permission->name}}</label> <br>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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