
@extends('layouts.master')

@section('title', 'Движение средств')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Движение средств</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                                <a href="/create-income" role = "button" class = "btn btn-block btn-outline-primary btn-sm">Добавить Поступление</a>
                            </div>
                        </li>
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                                <a href="/create-expanse" role = "button" class = "btn btn-block btn-outline-primary btn-sm">Добавить Отчисление</a>
                            </div>
                        </li>
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
                                    <th>№</th>
                                    <th>Дата</th>
                                    <th>Статья платежей</th>
                                    <th>Касса</th>
                                    <th>Сотрудник</th>
                                    <th>Клиент</th>
                                    <th>Создано</th>
                                    <th>Сумма</th>
                                    <th>Комментарии</th>
                                    {{--<th></th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;?>
                                @foreach ($cashFlows as $cashFlow)
                                    @if($cashFlow->paymentItem->paymentType->id==2)
                                        <tr class = "text-danger">
                                    @else
                                        <tr>
                                    @endif
                                        <td>{{$i++}}</td>
                                        <td>{{$cashFlow->cash_flow_date}}</td>
                                        <td>{{$cashFlow->paymentItem->name}}</td>
                                        <td> <a href="{{ route('cashBoxes.show', $cashFlow->cashBox->id) }}">{{$cashFlow->cashBox->name}}</a> </td>
                                        @if(isset($cashFlow->employee))
                                            <td>{{$cashFlow->employee->name}}</td>
                                        @else
                                            <td>Не указано</td>
                                        @endif
                                        @if(isset($cashFlow->patient))
                                            <td>{{$cashFlow->patient->name}}</td>
                                        @else
                                            <td>Не указано</td>
                                        @endif
                                        <td>{{$cashFlow->userCreated->name}} <br> {{$cashFlow->created_at->formatLocalized('%d %B %Y %H:%M')}}</td>
                                        <td>{{$cashFlow->amount}} тг</td>
                                        @if(isset($cashFlow->comments))
                                            <td>{{$cashFlow->comments}}</td>
                                        @else
                                            <td>Не указаны</td>
                                        @endif
                                        {{--<td>--}}
                                            {{--<a href="{{ URL::to('cashFlows/'.$cashFlow->id.'/edit') }}"><i class="fa fa-edit"></i></a>--}}
                                            {{--<a href="" onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('delete-form').submit();"><i class="fa fa-trash-alt"></i></a>--}}
                                            {{--{{ Form::open(array('route' => array('cashFlows.destroy', $cashFlow->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}--}}
                                            {{--<button type="submit" ><i class="fa fa-trash-alt"></i></button>--}}
                                            {{--{{ Form::close() }}--}}
                                        {{--</td>--}}
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
