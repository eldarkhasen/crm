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

                        {{ Form::model($protocol, array('route' => array('protocols.update', $protocol->id), 'method' => 'PUT')) }}

                        <div class="card-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="inputName">Наименование</label>
                                <input type="text" class="form-control" id="inputName" name = "name" value="{{$protocol->name}}">
                                {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('patient_problems') ? 'has-error' : ''}}">
                                <label for="patient_problems">Жалобы пациента</label>
                                <textarea class="form-control" rows="5" name = "patient_problems" id = "patient_problems" required>{{$protocol->patient_problems}}</textarea>
                                {!! $errors->first('patient_problems', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('anamnesis_vitae') ? 'has-error' : ''}}">
                                <label for="anamnesis_vitae">Anamnesis vitae</label>
                                <textarea class="form-control" rows="5" name = "anamnesis_vitae" id = "anamnesis_vitae" required>{{$protocol->anamnesis_vitae}}</textarea>
                                {!! $errors->first('anamnesis_vitae', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('anamnesis_morbi') ? 'has-error' : ''}}">
                                <label for="anamnesis_morbi">Anamnesis morbi</label>
                                <textarea class="form-control" rows="5" name = "anamnesis_morbi" id = "anamnesis_morbi" required>{{$protocol->anamnesis_morbi}}</textarea>
                                {!! $errors->first('anamnesis_morbi', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('visual_inspection') ? 'has-error' : ''}}">
                                <label for="visual_inspection">Внешний осмотр</label>
                                <textarea class="form-control" rows="5" name = "visual_inspection" id = "visual_inspection" required>{{$protocol->visual_inspection}}</textarea>
                                {!! $errors->first('visual_inspection', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('bite') ? 'has-error' : ''}}">
                                <label for="bite">Прикус</label>
                                <textarea class="form-control" rows="5" name = "bite" id = "bite" required>{{$protocol->bite}}</textarea>
                                {!! $errors->first('bite', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('objective_data') ? 'has-error' : ''}}">
                                <label for="objective_data">Объективные данные</label>
                                <textarea class="form-control" rows="5" name = "objective_data" id = "objective_data" required>{{$protocol->objective_data}}</textarea>
                                {!! $errors->first('objective_data', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('xray_data') ? 'has-error' : ''}}">
                                <label for="xray_data">Рентгенологические исследования</label>
                                <textarea class="form-control" rows="5" name = "xray_data" id = "xray_data" required>{{$protocol->xray_data}}</textarea>
                                {!! $errors->first('xray_data', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('diagnosis') ? 'has-error' : ''}}">
                                <label for="diagnosis">Поставленный диагноз</label>
                                <textarea class="form-control" rows="5" name = "diagnosis" id = "diagnosis" required>{{$protocol->diagnosis}}</textarea>
                                {!! $errors->first('diagnosis', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('treatment_plan') ? 'has-error' : ''}}">
                                <label for="treatment_plan">План лечения</label>
                                <textarea class="form-control" rows="5" name = "treatment_plan" id = "treatment_plan" required>{{$protocol->treatment_plan}}</textarea>
                                {!! $errors->first('treatment_plan', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('work_done') ? 'has-error' : ''}}">
                                <label for="work_done">Лечение(проделанная работа)</label>
                                <textarea class="form-control" rows="5" name = "work_done" id = "work_done" required>{{$protocol->work_done}}</textarea>
                                {!! $errors->first('work_done', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('recommendations') ? 'has-error' : ''}}">
                                <label for="recommendations">Рекомендации</label>
                                <textarea class="form-control" rows="5" name = "recommendations" id = "recommendations" required>{{$protocol->recommendations}}</textarea>
                                {!! $errors->first('recommendations', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="" onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();" class="btn btn-danger">Удалить</a>
                        </div>
                        {{ Form::close() }}
                        {{ Form::open(array('route' => array('protocols.destroy', $protocol->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
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