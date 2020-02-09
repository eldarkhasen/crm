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
                                {{--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Лечения</a></li>--}}
                                {{--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Документы</a></li>--}}
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane  active show " id="activity">
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
                                                            @foreach($appointment->services as $service)
                                                                {{$service->name}}
                                                            @endforeach
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


                                    {{--@else--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-sm-4">--}}
                                                {{--<strong>Нет визитов</strong>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}
                                    {{--@endif--}}
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <ul class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <li class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-envelope bg-primary"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                                <div class="timeline-body">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                    quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                                </h3>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-comments bg-warning"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                                <div class="timeline-body">
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline time label -->
                                        <li class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-camera bg-purple"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                                <div class="timeline-body">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <li>
                                            <i class="fa fa-clock-o bg-gray"></i>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName2" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
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
    </script>
@endsection