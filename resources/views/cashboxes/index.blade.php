
@extends('layouts.master')

@section('title', 'Кассы')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Счета и кассы</h1>
                </div>

                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                                <a href="{{ URL::to('cashBoxes/create') }}" role = "button" class = "btn btn-block btn-outline-primary btn-sm"> Добавить Кассу</a>
                            </div>
                        </li>
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
                            <div class="row">
                                @foreach($cashBoxes as $cashBox)
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><a href="{{ route('cashBoxes.show', $cashBox->id) }}"><i class="fa fa-credit-card"></i></a></span>
                                        <div class="info-box-content">
                                            <a href="{{ route('cashBoxes.show', $cashBox->id) }}"><span class="info-box-text">{{$cashBox->name}}</span></a>
                                            <span class="info-box-number"><a href="{{ route('cashBoxes.show', $cashBox->id) }}">{{$cashBox->current_balance}} тг </a></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <h4 class="mb-5">Список движения средств за текущую неделю</h4>
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
                                                    <td>{{$cashFlow->employee->surname}} {{$cashFlow->employee->name}} {{$cashFlow->employee->patronymic}}</td>
                                                @else
                                                    <td>Не указано</td>
                                                @endif
                                                @if(isset($cashFlow->patient))
                                                    <td><a href="{{route('patients.show',$cashFlow->patient->id)}}">{{$cashFlow->patient->surname}} {{$cashFlow->patient->name}}</a></td>
                                                @else
                                                    <td>Не указано</td>
                                                @endif
                                                <td>{{$cashFlow->userCreated->name}} <br> {{$cashFlow->created_at->formatLocalized('%d %B %Y %H:%M')}}</td>

                                                @if($cashFlow->paymentItem->paymentType->id==1)
                                                    <td>{{$cashFlow->amount}}тг</td>
                                                @else
                                                    <td>-{{$cashFlow->amount}}тг</td>
                                                @endif
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
                                    <tfoot>
                                    <tr>
                                        <th colspan="7" style="text-align:right;font-size: 21px" class="text-uppercase">Итого:</th>
                                        <th style="font-size: 21px"></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
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
                },
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\тг,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 7 ).footer() ).html(
                        ''+pageTotal +'тг'
                    );
                }
            });     //capital "D"
        });
    </script>
@endsection
