{{-- \resources\views\users\createincome.blade.php --}}
@extends('layouts.master')

@section('title', '| Добавить пациента')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Добавить пациента</h3>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" >

                        {{ Form::model($patient, array('route' => array('patients.update', $patient->id), 'method' => 'PUT')) }}
                            @csrf
                            <div class="card-body" id = "addEmployee" >
                                <fieldset class="form-group">
                                    <legend style="font-size:16px"> <b>Основная информация</b></legend>
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="inputName">Имя</label>
                                        <input type="text" class="form-control" id="inputName" name = "name" value = "{{$patient->name}}">
                                        {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('surname') ? 'has-error' : ''}}">
                                        <label for="inputSurname">Фамилия</label>
                                        <input type="text" class="form-control" id="inputSurname" name = "surname" value = "{{$patient->surname}}">
                                        {!! $errors->first('surname', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('patronymic') ? 'has-error' : ''}}">
                                        <label for="inputPatronymic">Отчество</label>
                                        <input type="text" class="form-control" id="inputPatronymic" name = "patronymic" value = "{{$patient->patronymic}}">
                                        {!! $errors->first('patronymic', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}" >
                                        <label for="inputEmail">Номер телефона</label>
                                        <input type="text" v-mask="'+7(999)999 99 99'" class="form-control" name = "phone" value = "{{$patient->phone}}" />
                                        {!! $errors->first('patronymic', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Пол</label>
                                        <select class="form-control" name = "gender">
                                            <option value = "1"
                                                    @if ($patient->gender=="Не указано")
                                                    selected="selected"
                                                    @endif>Не указано</option>
                                            <option value = "2"
                                                    @if ($patient->gender=="Мужской")
                                                    selected="selected"
                                                    @endif>Мужской</option>
                                            <option value = "3"
                                                    @if ($patient->gender=="Женский")
                                            selected="selected"
                                                    @endif
                                            >Женский</option>
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : ''}}" >
                                        <label for="inputDateOfBirth">Дата рождения</label>
                                        <input class = "form-control" type="tel" v-mask="'##/##/####'"  id = "inputDateOfBirth" name = "birth_date" placeholder="ДД/ММ/ГГГГ" value = "{{$patient->birth_date}}"/>
                                        {!! $errors->first('birth_date', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}" >
                                        <label for="inputDiscount">Процент скидки</label>
                                        <input type="number" class="form-control"  id = "inputDiscount" name = "discount" value = "{{$patient->discount}}" />
                                        {!! $errors->first('discount', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                </fieldset>
                                <fieldset class="form-group">
                                    <legend style="font-size:16px"> <b>Дополнительная информация</b></legend>
                                    <div class="form-group" >
                                        <label for="inputIdCard">ИИН</label>
                                        <input type="text" v-mask="'999999999999'" id = "inputIdCard" class="form-control" name = "id_card"  value = {{$patient->id_card}}/>
                                    </div>
                                    <div class="form-group" >
                                        <label for="inputIdNumber">Уд.личности №</label>
                                        <input type="text" v-mask="'999999999'" class="form-control"  id = "inputIdNumber" name = "id_number" value="{{$patient->id_number}}"/>
                                    </div>
                                    <div class="form-group" >
                                        <label for="nationality">Национальность</label>
                                        <input type="text" class="form-control"  id = "nationality" name = "nationality" value = "{{$patient->nationality}}" />
                                    </div>
                                    <div class="form-group" >
                                        <label for="inputCity">Город</label>
                                        <input type="text"  class="form-control"  id = "inputCity" name = "city" value = "{{$patient->city}}" />
                                    </div>
                                    <div class="form-group" >
                                        <label for="inputAddress">Адрес</label>
                                        <input type="text" class="form-control"  id = "inputAddress" name = "address"  value="{{$patient->address}}" />
                                    </div>
                                    <div class="form-group" >
                                        <label for="inputWorkplace">Место работы</label>
                                        <input type="text" class="form-control"  id = "inputWorkplace" name = "workplace"  value="{{$patient->workplace}}" />
                                    </div>
                                    <div class="form-group" >
                                        <label for="inputPosition">Должность</label>
                                        <input type="text" class="form-control"  id = "inputPosition" name = "position"  value="{{$patient->position}}" />
                                    </div>

                                </fieldset>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-body ">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                {{--@include('errors.list')--}}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection