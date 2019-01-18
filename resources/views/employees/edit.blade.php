{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
@section('title', '| Редактировать сотрудника')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактировать сотрудника </h1>

                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
        <div class="container-fliud" id = "app">
            <edit-emp-component name = "{{$employee->name}}"
                                surname = "{{$employee->surname}}"
                                patronymic = "{{$employee->patronymic}}"
                                phone = "{{$employee->phone}}"
                                gender="{{$employee->gender}}"
                                birthdate = "{{$employee->birth_date}}"
                                hasUser = "{{$hasUser}}"
            ></edit-emp-component>
            @include('errors.list')
        </div>
    </section>
    {{--<div class='col-lg-4 col-lg-offset-4' id="app">--}}
        {{--<example-component></example-component>--}}

        {{--<h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>--}}
        {{--<hr>--}}

        {{--{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}--}}{{----}}{{-- Form model binding to automatically populate our fields with user data --}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('name', 'Name') }}--}}
            {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('email', 'Email') }}--}}
            {{--{{ Form::email('email', null, array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<h5><b>Give Role</b></h5>--}}

        {{--<div class='form-group'>--}}
            {{--@foreach ($roles as $role)--}}
                {{--{{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}--}}
                {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}

            {{--@endforeach--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('password', 'Password') }}<br>--}}
            {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}

        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('password', 'Confirm Password') }}<br>--}}
            {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}

        {{--</div>--}}

        {{--{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

        {{--{{ Form::close() }}--}}

    {{--</div>--}}

@endsection