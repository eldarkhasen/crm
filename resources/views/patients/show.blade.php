{{-- \resources\views\users\createincome.blade.php --}}
@extends('layouts.master')

@section('title',"Пациент: {$patient->name} {$patient->surname}")

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Информация пациента: {{$patient->name}} {{$patient->surname}}</h3>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-3">
                    <!-- Patient Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($patient->photoname!=null)
                                <img class="profile-user-img img-fluid img-circle" src="{{url('profile_images/'.$patient->photoname)}}" alt="{{$patient->photoname}}">
                                @else
                                    <img class="profile-user-img img-fluid img-circle" src="/img/patient_photo.png" alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{$patient->name}} {{$patient->surname}}</h3>

                            <p class="text-muted text-center">Оказано услуг на: {{$sumOfServices}}тг </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>День рождения</b> <a class="float-right"> {{$patient->birth_date}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Депозит</b> <a class="float-right">0тг</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Долг</b> <a class="float-right">0тг</a>
                                </li>
                            </ul>

                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-block btn-outline-primary"><b>Редактировать</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Доп. информация</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-book mr-1"></i> Телефон</strong>
                            <p class="text-muted">
                                {{$patient->phone}}
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker mr-1"></i> Адрес</strong>
                            @if($patient->city==null && $patient->address==null)
                                <p class="text-muted">нет данных</p>
                            @else
                                <p class="text-muted">{{$patient->city}}, {{$patient->address}}</p>
                            @endif
                            <hr>

                            <strong><i class="fas fa-id-card"></i> ИИН</strong>
                            @if($patient->id_card==null)
                                <p class="text-muted">нет данных</p>
                            @else
                                <p class="text-muted">{{$patient->id_card}}</p>
                            @endif
                            <hr>
                            <strong><i class="fas fa-pills"></i>  История болезни </strong>
                            @if($patient->anamnesis_vitae==null)
                                <p class="text-muted">нет данных</p>
                            @else
                                <p class="text-muted">{{$patient->anamnesis_vitae}}</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link  active show" href="#activity" data-toggle="tab">Визиты</a></li>
                                <li class="nav-item"><a class="nav-link" href="#xray_images" data-toggle="tab">Снимки</a></li>
                                {{--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"></a></li>--}}
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane  active show" id="activity">
                                    <table class="table table-bordered table-hover dataTable appointmentsTable"  role="grid">
                                        <thead>
                                        <tr>
                                            <th>Дата посещения</th>
                                            <th>Услуги</th>
                                            <th>Диагноз</th>
                                            <th>Доктор</th>
                                            <th>Цена</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($patient->appointments)>0)
                                            @foreach($patient->appointments as $appointment)
                                                @if($appointment->status=="success")
                                                    <tr>
                                                        <td>
                                                            {{$appointment->start}}
                                                        </td>
                                                        <td>
                                                            {{$appointment->services()->pluck('name')->implode(' | ')}}

                                                            {{--@foreach($appointment->services as $service)--}}
                                                                {{--{{$service->name}}--}}
                                                            {{--@endforeach--}}
                                                        </td>
                                                        <td>
                                                            @if(isset($appointment->diagnosis))
                                                            {{$appointment->diagnosis}}
                                                            @else
                                                                Нет данных
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <b>{{$appointment->employee->name}} {{$appointment->employee->surname}}</b>
                                                        </td>
                                                        <td>
                                                            <b>{{$appointment->price}}тг</b>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('appointments.show', $appointment->id) }}"  type = "button" class = "btn btn-block btn-outline-primary btn-sm">Детали</a>
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="xray_images">
                                    <div class="row mb-4">
                                        <div class="col-sm-3">

                                            <a href="#"  type = "button" class = "btn btn-block btn-outline-primary float-lg-left" data-toggle="modal" data-target="#imageModal">Добавить снимки</a></li>
                                        </div>
                                    </div>


                                    <table class="table table-bordered table-hover dataTable imagesTable"  role="grid">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Дата загрузки снимка</th>
                                            <th>Дата визита</th>
                                            <th>Комментарии</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($patient->xray_images)>0)
                                                @foreach($patient->xray_images as $xray_image)
                                                    <tr>
                                                        <td>
                                                            <a href="#"  data-toggle="modal" data-target="#imageModal-{{$xray_image->id}}">
                                                                <img class="rounded mx-auto d-block" src="{{url('xray_data/'.$xray_image->photoname)}}" alt="User Image" style="max-height: 250px;max-width: 250px;">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="#"  data-toggle="modal" data-target="#imageModal-{{$xray_image->id}}">
                                                            {{$xray_image->created_at}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if(isset($xray_image->appointment_date))
                                                                <a href="#"  data-toggle="modal" data-target="#imageModal-{{$xray_image->id}}">
                                                                {{$xray_image->appointment_date}}
                                                                </a>
                                                            @else
                                                                Нет данных
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(isset($xray_image->comments))
                                                                <a href="#"  data-toggle="modal" data-target="#imageModal-{{$xray_image->id}}">
                                                                {{$xray_image->comments}}
                                                                </a>
                                                            @else
                                                                Нет данных
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade bd-example-modal-lg" id="imageModal-{{$xray_image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Информация по снимку</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                {{ Form::model($xray_image, array('route' => array('xrayimages.update', $xray_image->id), 'method' => 'PUT')) }}
                                                                <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <img class="rounded mx-auto d-block" src="{{url('xray_data/'.$xray_image->photoname)}}" alt="User Image" style="max-height: 500px;max-width: 500px;">
                                                                        </div>
                                                                        <hr>
                                                                        <div class="form-group mt-3">
                                                                            <label for="appointment_date">Дата Записи</label>
                                                                            <select  class="form-control" name = "appointment_date" id = "appointment_date">
                                                                                @if(isset($xray_image->appointment_date))
                                                                                    @foreach($patient->appointments as $appointment)
                                                                                        <option value="{{$appointment->start}}" @if($xray_image->appointment_date==$appointment->start) selected="selected" @endif >{{$appointment->start}}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                        <option value=""></option>
                                                                                        @foreach($patient->appointments as $appointment)
                                                                                            <option value="{{$appointment->start}}">{{$appointment->start}}</option>
                                                                                        @endforeach
                                                                                @endif

                                                                            </select>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="form-group">
                                                                            <label for="xraycomments">Коментарии</label>
                                                                            <textarea class = "form-control" name="xraycomments" id="xraycomments"
                                                                                      rows="7">{{$xray_image->comments}}</textarea>
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                                    {{ Form::close() }}
                                                                    {{ Form::open(array('route' => array('xrayimages.destroy', $xray_image->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
                                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                                    {{ Form::close() }}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Загрузить снимки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id ="app">
                    <upload-images-component :patient_id = "'{!! json_encode($patient->id) !!}'"></upload-images-component>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" >
        $(document).ready(function () {
            $('.appointmentsTable').DataTable({
                "processing": true,
                "responsive": true,
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                }
            });     //capital "D"
        });
        $(document).ready(function () {
            $('.imagesTable').DataTable({
                "processing": true,
                "responsive": true,
                "searching": false,
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                }
            });     //capital "D"
        });
    </script>
@endsection
<style lang="scss" scoped>

</style>