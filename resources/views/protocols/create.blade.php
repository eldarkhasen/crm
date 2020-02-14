@extends('layouts.master')

@section('title', 'Новый протокол')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить новый протокол</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <form method ="POST" action = "{{ URL::to('protocols') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="inputName">Наименование</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                    {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('patient_problems') ? 'has-error' : ''}}">
                                    <label for="patient_problems">Жалобы пациента</label>
                                    <textarea class="form-control" rows="5" name = "patient_problems" id = "patient_problems" required></textarea>
                                    {!! $errors->first('patient_problems', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('anamnesis_vitae') ? 'has-error' : ''}}">
                                    <label for="anamnesis_vitae">Anamnesis vitae</label>
                                    <textarea class="form-control" rows="5" name = "anamnesis_vitae" id = "anamnesis_vitae" required></textarea>
                                    {!! $errors->first('anamnesis_vitae', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('anamnesis_morbi') ? 'has-error' : ''}}">
                                    <label for="anamnesis_morbi">Anamnesis morbi</label>
                                    <textarea class="form-control" rows="5" name = "anamnesis_morbi" id = "anamnesis_morbi" required></textarea>
                                    {!! $errors->first('anamnesis_morbi', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('visual_inspection') ? 'has-error' : ''}}">
                                    <label for="visual_inspection">Внешний осмотр</label>
                                    <textarea class="form-control" rows="5" name = "visual_inspection" id = "visual_inspection" required></textarea>
                                    {!! $errors->first('visual_inspection', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('bite') ? 'has-error' : ''}}">
                                    <label for="bite">Прикус</label>
                                    <textarea class="form-control" rows="5" name = "bite" id = "bite" required></textarea>
                                    {!! $errors->first('bite', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('objective_data') ? 'has-error' : ''}}">
                                    <label for="objective_data">Объективные данные</label>
                                    <textarea class="form-control" rows="5" name = "objective_data" id = "objective_data" required></textarea>
                                    {!! $errors->first('objective_data', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('xray_data') ? 'has-error' : ''}}">
                                    <label for="xray_data">Рентгенологические исследования</label>
                                    <textarea class="form-control" rows="5" name = "xray_data" id = "xray_data" required></textarea>
                                    {!! $errors->first('xray_data', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('diagnosis') ? 'has-error' : ''}}">
                                    <label for="diagnosis">Поставленный диагноз</label>
                                    <textarea class="form-control" rows="5" name = "diagnosis" id = "diagnosis" required></textarea>
                                    {!! $errors->first('diagnosis', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('treatment_plan') ? 'has-error' : ''}}">
                                    <label for="treatment_plan">План лечения</label>
                                    <textarea class="form-control" rows="5" name = "treatment_plan" id = "treatment_plan" required></textarea>
                                    {!! $errors->first('treatment_plan', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('work_done') ? 'has-error' : ''}}">
                                    <label for="work_done">Лечение(проделанная работа)</label>
                                    <textarea class="form-control" rows="5" name = "work_done" id = "work_done" required></textarea>
                                    {!! $errors->first('work_done', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('recommendations') ? 'has-error' : ''}}">
                                    <label for="recommendations">Рекомендации</label>
                                    <textarea class="form-control" rows="5" name = "recommendations" id = "recommendations" required></textarea>
                                    {!! $errors->first('recommendations', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                            </div>
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