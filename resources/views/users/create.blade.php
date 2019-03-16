{{-- \resources\views\users\createincome.blade.php --}}
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

                        <form method ="POST" action = "{{ URL::to('employees') }}" autocomplete="off">
                            @csrf
                            <div class="card-body" id = "addEmployee" >

                                <div class="form-group">
                                    <label for="inputName">Имя</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                </div>
                                <div class="form-group">
                                    <label for="inputSurname">Фамилия</label>
                                    <input type="text" class="form-control" id="inputSurname" name = "surname">
                                </div>
                                <div class="form-group">
                                    <label for="inputPatronomic">Отчество</label>
                                    <input type="text" class="form-control" id="inputPatronomic" name = "patronymic">
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail">Номер телефона</label>
                                    <input type="text" v-mask="'+7(999)999 99 99'" class="form-control" name = "phone" />
                                </div>
                                <div class="form-group">
                                    <label>Пол</label>
                                    <select class="form-control" name = "gender">
                                        <option value = "1">Не указано</option>
                                        <option value = "2" >Мужской</option>
                                        <option value = "3">Женский</option>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail">Дата рождения</label>
                                    <input class = "form-control" type="tel" v-mask="'##/##/####'"  name = "birth_date" placeholder="ДД/ММ/ГГГГ"/>
                                </div>

                                <div class="form-group" >
                                    <input type="checkbox" id="checkbox"  v-model="checked" name = "createUser">
                                    <label for="checkbox">Дать доступ к системе</label>
                                    <transition name = "fade">
                                        <div class="form-group" v-if="checked">
                                            <label for="inputEmail">Почта</label>
                                            <input type="email" class="form-control" id="inputEmail" name = "email">
                                        </div>
                                    </transition>
                                    <transition name = "fade">
                                        <div class="form-group" v-if="checked">
                                            <label for="inputPassword">Пароль</label>
                                            <input type="password" class="form-control" id="inputPassword" name = "password">
                                        </div>
                                    </transition>
                                    <transition name = "fade">
                                        <div class="form-group" v-if="checked">
                                            <label for="inputPasswordConfirm"> Подтверждение пароля</label>
                                            <input type="password" class="form-control" id="inputPasswordConfirm" name = "password_confirmation">
                                        </div>
                                    </transition>
                                    <transition name = "fade">
                                        <div class="form-group" v-if="checked">
                                            <label for="#inputRoles">Доступы</label>
                                            @if(!$permissions->isEmpty())
                                                <div class="form-check">
                                                    @foreach($permissions as $permission)
                                                        <input name = "permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}">
                                                        <label class="form-check-label" for = "{{$permission->alias}}">{{$permission->alias}}</label> <br>
                                                    @endforeach
                                                </div>
                                                @endif
                                        </div>
                                    </transition>
                                </div>

                                    {{--<div class="form-group">--}}
                                        {{--<label for="#inputRoles">Задать должность</label>--}}
                                        {{--<div class="form-check" id="inputRoles">--}}
                                            {{--@foreach($roles as $role)--}}
                                                {{--@if($role->name!='admin')--}}
                                                {{--<input name = "roles[]" class="form-check-input" type="checkbox" value="{{$role->id}}">--}}
                                                {{--<label class="form-check-label" for = "{{$role->name}}">{{$role->name}}</label> <br>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group">
                                        <label>Должности</label>
                                        @if(!$positions->isEmpty())
                                        <select name = "positions[]" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            @foreach($positions as $position)
                                                    <option value="{{$position->id}}" >{{$position->name}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                                @include('errors.list')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection