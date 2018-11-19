{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Добавить сотрудника')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить сотрудника</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" >

                        <form method ="POST" action = "{{ URL::to('users') }}">
                            @csrf
                            <div class="card-body" id = "users" >

                                <div class="form-group">
                                    <label for="inputName">Имя</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" name = "email">
                                </div>

                                <div class="form-group" >
                                    <input type="checkbox" id="checkbox" v-model="checked" name = "checked">
                                    <label for="checkbox">Дать доступ к системе</label>
                                    <transition name = "fade">
                                        <div class="form-group" v-if="checked">
                                            <label for="inputPassword">Пароль</label>
                                            <input type="password" class="form-control" id="inputPassword" name = "password">
                                        </div>
                                    </transition>
                                    <transition name = "fade">
                                        <div class="form-group" v-if="checked">
                                            <label for="inputPasswordConfirm">Пароль</label>
                                            <input type="password" class="form-control" id="inputPasswordConfirm" name = "password_confirmation">
                                        </div>
                                    </transition>
                                </div>





                                @if(!$roles->isEmpty())
                                    <div class="form-group">
                                        <label for="#inputRoles">Прикрепить к должностям</label>
                                        <div class="form-check" id="inputRoles">
                                            @foreach($roles as $role)
                                                <input name = "roles[]" class="form-check-input" type="checkbox" value="{{$role->id}}">
                                                <label class="form-check-label" for = "{{$role->name}}">{{$role->name}}</label> <br>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection