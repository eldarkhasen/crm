{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', '| Пациенты')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Список пациентов</h3>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('patients/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить пациента</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable" id = "patients" role="grid">
                                <thead>
                                    <tr>
                                        <th>ФИО</th>
                                        <th>Контакты</th>
                                        <th>Дата рождения</th>
                                        <th>ИИН</th>
                                        <th>Последний визит</th>
                                        <th>Выручка</th>
                                        <th>Действие</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td><a href="{{ route('patients.show', $patient->id) }}">{{ $patient->name }} {{ $patient->surname }} {{ $patient->patronymic }}</a></td>
                                        <td>{{$patient->phone}}</td>
                                        <td>{{ $patient->birth_date }}</td>
                                        @if(isset($patient->id_card))
                                        <td>
                                            {{$patient->id_card}}</td>
                                        @else
                                            <td>Нет данных </td>
                                        @endif
                                        <td>Нет данных </td>
                                        <td>Нет данных </td>
                                        <td>
                                        <a href="{{ route('patients.edit', $patient->id) }}"><i class="fa fa-edit"></i></a>

                                            {{--<a href="" onclick="event.preventDefault();--}}
                                            {{--document.getElementById('delete-form').submit();"><i class="fa fa-trash-alt"></i></a>--}}
                                            {{--{{ Form::open(array('route' => array('employees.destroy', $emp->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}--}}
                                            {{--<button type="submit" ><i class="fa fa-trash-alt"></i></button>--}}
                                            {{--{{ Form::close() }}--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#patients').DataTable({
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