{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', 'Поставка материалов')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Поставка материалов</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Инвентаризация</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link " href="/materials">Материалы</a></li>
                                <li class="nav-item"><a class="nav-link " href="/materialsUsages">Выдача</a></li>
                                <li class="nav-item"><a class="nav-link active show" href="/materialsDeliveries">Поставки</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- /.tab-pane -->
                                <div class="tab-pane active show" id="usage">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="margin">
                                                <div class="btn-group float-left">
                                                    <a href="{{ URL::to('materialsDeliveries/create') }}" role = "button" class = "btn btn-block btn-outline-primary btn-sm">Добавить поступление</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-hover dataTable materialsTables"  role="grid">
                                                <thead>
                                                <tr>
                                                    <th>Наименование</th>
                                                    <th>Ед. измерения</th>
                                                    <th>Количество</th>
                                                    <th>Сумма</th>
                                                    <th>Номер счета</th>
                                                    <th>Дата поступления</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($deliveries as $delivery)
                                                    <tr>
                                                        <td>{{$delivery->material->name}}</td>
                                                        <td>
                                                            {{$delivery->material->measure_unit}}
                                                        </td>
                                                        <td>
                                                            {{$delivery->quantity}}
                                                        </td>
                                                        <td>
                                                            {{$delivery->quantity*$delivery->material->price}}тг
                                                        </td>
                                                        <td>
                                                            {{$delivery->invoice_number}}
                                                        </td>
                                                        <td>
                                                            {{$delivery->delivery_date}}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.materialsTables').DataTable({
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