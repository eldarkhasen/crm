@extends('layouts.master')
@section('title', '| График')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3>Информация по визиту пациента: <a href="{{ route('patients.show', $appointment->patient->id) }}">{{$appointment->patient->name}} {{$appointment->patient->surname}}</a> от {{$appointment->start}}</h3>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-12">
                    <!-- Patient Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <dl>
                                <dt class="mb-2">ФИО: {{$appointment->patient->surname}} {{$appointment->patient->name}}  {{$appointment->patient->patronymic}}</dt>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-md-4"> <dt>Дата рождения</dt>
                                        <dd>{{$appointment->patient->birth_date}}</dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Anamnesis vitae</dt>
                                        <dd>
                                            @if(isset($appointment->anamnesis_vitae))
                                                {{$appointment->anamnesis_vitae}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Anamnesis morbi</dt>
                                        <dd>@if(isset($appointment->anamnesis_morbi))
                                                {{$appointment->anamnesis_morbi}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>


                                </div>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <dt>Жалобы пациента</dt>
                                        <dd>
                                            @if(isset($appointment->patient_problems))
                                                {{$appointment->patient_problems}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Внешний осмотр</dt>
                                        <dd>
                                            @if(isset($appointment->visual_inspection))
                                                {{$appointment->visual_inspection}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Прикус</dt>
                                        <dd>
                                            @if(isset($appointment->bite))
                                                {{$appointment->bite}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>

                                </div>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <dt>Объективные данные</dt>
                                        <dd>
                                            @if(isset($appointment->objective_data))
                                                {{$appointment->objective_data}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>

                                    <div class="col-md-4">
                                        <dt>Рентгенологические исследования</dt>
                                        <dd>
                                            @if(isset($appointment->xray_data))
                                                {{$appointment->xray_data}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Поставленный диагноз</dt>
                                        <dd>
                                            @if(isset($appointment->diagnosis))
                                                {{$appointment->diagnosis}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <dt>План лечения</dt>
                                        <dd>
                                            @if(isset($appointment->treatment_plan))
                                                {{$appointment->treatment_plan}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>

                                    <div class="col-md-4">
                                        <dt>Лечение(проделанная работа)</dt>
                                        <dd>
                                            @if(isset($appointment->work_done))
                                                {{$appointment->work_done}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>

                                    <div class="col-md-4">
                                        <dt>Рекомендации</dt>
                                        <dd>
                                            @if(isset($appointment->recommendations))
                                                {{$appointment->recommendations}}
                                            @else
                                                Нет данных
                                            @endif
                                        </dd>
                                    </div>
                                </div>
                            </dl>

                            <hr>
                            {{--<h5>Жалобы пациента</h5>--}}
                            {{--<h6>--}}
                                {{--@if(isset($appointment->patient_problems))--}}
                                    {{--{{$appointment->patient_problems}}--}}
                                {{--@else--}}
                                    {{--Нет данных--}}
                                {{--@endif--}}
                            {{--</h6>--}}
                            {{--<hr>--}}
                            {{--<h5 >Поставленный диагноз</h5>--}}
                            {{--<h6>--}}
                                {{--@if(isset($appointment->diagnosis))--}}
                                    {{--{{$appointment->diagnosis}}--}}
                                {{--@else--}}
                                    {{--Нет данных--}}
                                {{--@endif--}}
                            {{--</h6>--}}
                            {{--<hr>--}}
                            {{--<h5>Проделанная работа</h5>--}}
                            {{--<h6>--}}
                                {{--@if(isset($appointment->work_done))--}}
                                    {{--{{$appointment->work_done}}--}}
                                {{--@else--}}
                                    {{--Нет данных--}}
                                {{--@endif--}}
                            {{--</h6>--}}
                            {{--<hr>--}}
                            <dt  class="mb-3">Список предоставленных услуг</dt>
                            <table class="table table-bordered table-hover dataTable servicesTable"  role="grid">
                                <thead>
                                <tr>
                                    <th>Название услуги</th>
                                    <th>Описание</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($appointment->services)>0)
                                    @foreach($appointment->services as $service)
                                            <tr>
                                                <td>
                                                    {{$service->name}}
                                                </td>
                                                <td>
                                                    {{$service->description}}
                                                </td>
                                            </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection


