
@extends('layouts.master')

@section('title', 'Статьи платежей')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Статьи платежей</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" role = "button" class = "btn btn-block btn-outline-primary btn-md" data-toggle="modal" data-target="#exampleModal"> Добавить статью</a></li>
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
                            <table class="table table-hover dataTable" id = "paymentItems" role="grid">
                                <thead>
                                <tr>
                                    <th>Наименование</th>
                                    {{--<th>Доступы</th>--}}
                                    <th>Тип платежа</th>
                                    <th> </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($paymentItems as $paymentItem)
                                    <tr>
                                        <td>{{ $paymentItem->name }}</td>
                                        <td>{{$paymentItem->paymentType->name}}</td>
                                        <td>
                                            <a href="{{ URL::to('paymentItems/'.$paymentItem->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                                            /
                                            <a href="" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();"><i class="fa fa-trash-alt"></i></a>
                                            {{ Form::open(array('route' => array('paymentItems.destroy', $paymentItem->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новая статья</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method ="POST" action = "{{ URL::to('paymentItems') }}" autocomplete="off">
                <div class="modal-body">
                        @csrf
                        <div class="card-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" id="inputName" name = "name" required>
                                {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('payment_type_id') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Тип статьи</label>
                                <select class="form-control" name = "payment_type_id">
                                    <option disabled selected>Выберите тип статьи</option>
                                    <option value = "1">Доход</option>
                                    <option value = "2">Расход</option>
                                </select>
                                {!! $errors->first('payment_type_id', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary" >Сохранить</button>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#paymentItems').DataTable({
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
        @if (count($errors) > 0)
            $(document).ready(function () {
                $('#exampleModal').modal('show');
            });

        @endif
    </script>

@endsection