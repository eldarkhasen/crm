{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', '| Сотрудники')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Список сотрудников</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('employees/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить сотрудника</a></li>
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
                            <table class="table table-hover dataTable" id = "employees" role="grid">
                                <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Отчество</th>
                                    <th>Услуги</th>
                                    <th>Должности</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($employees as $emp)
                                <tr>

                                <td>{{ $emp->name }}</td>
                                <td>{{ $emp->surname }}</td>
                                <td>{{ $emp->patronymic }}</td>
                                @if(count($emp->services)>0)
                                        <td>{{ $emp->services()->pluck('name')->implode(', ') }}</td>
                                @else
                                        <td>Не указано</td>
                                @endif

                                <td>{{ $emp->positions()->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $emp->id) }}"><i class="fa fa-edit"></i></a>
                                    /
                                    <a href="" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();"><i class="fa fa-trash-alt"></i></a>
                                    {{ Form::open(array('route' => array('employees.destroy', $emp->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
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
            $('#employees').DataTable({
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