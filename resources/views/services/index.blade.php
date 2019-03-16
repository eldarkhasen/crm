@extends('layouts.master')

@section('title', '| Услуги')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Список услуг</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('services/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить услугу</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover dataTable" id = "services" role="grid">
                                <thead>
                                <tr>
                                    <th>Доступ</th>
                                    <th>Описание</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->name }}</td>
                                        @if(isset($service->description))
                                            <td>
                                                {{$service->description}}</td>
                                        @else
                                            <td>Нет данных </td>
                                        @endif
                                        <td>
                                            <a href="{{ URL::to('services/'.$service->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                                            /
                                            <a href="" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();"><i class="fa fa-trash-alt"></i></a>
                                            {{ Form::open(array('route' => array('services.destroy', $service->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
                                            <button type="submit" ><i class="fa fa-trash-alt"></i></button>
                                            {{ Form::close() }}
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
            $('#services').DataTable({
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
            });
        });
    </script>
@endsection