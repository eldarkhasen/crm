@extends('layouts.master')
@section('title', '| График')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3>Информация по визиту пациента: {{$appointment->patient->name}} {{$appointment->patient->surname}} от {{$appointment->start}}</h3>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-9">
                    <!-- Patient Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h4>Доктор</h4>
                            <p>
                                @if(isset($appointment->employee_id))
                                    {{$appointment->employee->surname}} {{$appointment->employee->name}}  {{$appointment->employee->patronymic}}
                                @else
                                    Нет данных
                                @endif
                            </p>
                            <hr>
                            <h4>Жалобы пациента</h4>
                            <p>
                                @if(isset($appointment->patient_problems))
                                    {{$appointment->patient_problems}}
                                @else
                                    Нет данных
                                @endif
                            </p>
                            <hr>
                            <h4 >Поставленный диагноз</h4>
                            <p>
                                @if(isset($appointment->diagnosis))
                                    {{$appointment->diagnosis}}
                                @else
                                    Нет данных
                                @endif
                            </p>
                            <hr>
                            <h4 >Проделанная работа</h4>
                            <p>
                                @if(isset($appointment->work_done))
                                    {{$appointment->work_done}}
                                @else
                                    Нет данных
                                @endif
                            </p>
                            <hr>
                            <h4 class="mb-3">Список предоставленных услуг</h4>
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


