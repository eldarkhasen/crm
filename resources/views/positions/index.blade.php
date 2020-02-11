
@extends('layouts.master')

@section('title', '| Должности')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Список должностей</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('positions/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить должность</a></li>
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
                            <table class="table table-hover dataTable" id = "positions" role="grid">
                                <thead>
                                <tr>
                                    <th>Доступ</th>
                                    {{--<th>Доступы</th>--}}
                                    <th>Описание</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($positions as $position)
                                    <tr>
                                        <td>{{ $position->name }}</td>
                                        {{--<td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>--}}
                                        @if(isset($position->description))
                                            <td>
                                                {{$position->description}}</td>
                                        @else
                                            <td>Не указано</td>
                                        @endif
                                        <td>
                                            <a href="{{ URL::to('positions/'.$position->id.'/edit') }}"  class="btn btn-block btn-outline-primary btn-sm">Редактировать</a>
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
            $('#positions').DataTable({
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