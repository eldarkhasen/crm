{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
@section('title', "{$employee->name} {$employee->surname}")
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
        <div class="container-fliud" id = "addEmployee">
            <edit-emp-component :employee="{{ $employee->toJson() }}"
            ></edit-emp-component>



            {{--<div class='col-lg-4 col-lg-offset-4' id="app">--}}


                {{--<h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>--}}
                {{--<hr>--}}

                {{--{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }} Form model binding to automatically populate our fields with user data--}}

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


            @include('errors.list')
        </div>
    </section>


@endsection