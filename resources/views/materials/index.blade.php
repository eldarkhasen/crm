{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', 'Материалы')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Материалы</h4>
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
                                <li class="nav-item"><a class="nav-link active show" href="#materials" data-toggle="tab">Материалы</a></li>
                                <li class="nav-item"><a class="nav-link " href="#usage" data-toggle="tab">Выдача</a></li>
                                <li class="nav-item"><a class="nav-link" href="#delivery" data-toggle="tab">Поставки</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="materials">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="margin">
                                                <div class="btn-group float-left">
                                                    <a href="{{ URL::to('materials/create') }}" role = "button" class = "btn btn-block btn-outline-primary btn-sm"> Добавить материал</a>
                                                    {{--<button type="button" class="btn btn-block btn-outline-primary btn-sm">Добавить товар</button>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover dataTable materialsTables" role="grid">
                                                <thead>
                                                <tr>
                                                    <th>Наименование</th>
                                                    <th>Ед. измерения</th>
                                                    <th>На складе</th>
                                                    <th>Цена закупа</th>
                                                    <th>Действие</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($materials as $material)
                                                        <tr>
                                                            <td>{{$material->name}}</td>
                                                            <td>{{$material->measure_unit}}</td>
                                                            <td>{{$material->quantity}}</td>
                                                            <td>{{$material->price}}тг</td>
                                                            <td>
                                                                <a href="{{ route('materials.edit', $material->id) }}"><i class="fa fa-edit"></i></a>
                                                                /
                                                                <a href="" onclick="event.preventDefault();
                                                                     document.getElementById('delete-form').submit();"><i class="fa fa-trash-alt"></i></a>
                                                                    {{ Form::open(array('route' => array('materials.destroy', $material->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
                                                                    <button type="submit" ><i class="fa fa-trash-alt"></i></button>
                                                                    {{ Form::close() }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="usage">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="margin">
                                                <div class="btn-group float-left">
                                                    <a href="{{ URL::to('materialsUsages/create') }}" role = "button" class = "btn btn-block btn-outline-primary btn-sm"> Добавить списание</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover dataTable materialsTables"  role="grid">
                                                <thead>
                                                <tr>
                                                    <th>Наименование</th>
                                                    <th>Ед. измерения</th>
                                                    <th>Количество</th>
                                                    <th>Сумма</th>
                                                    <th>Сотрудник</th>
                                                    <th>Дата списания</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($materialsUsages as $usage)
                                                    <tr>
                                                        <td>{{$usage->material->name}}</td>
                                                        <td>
                                                            {{$usage->material->measure_unit}}
                                                        </td>
                                                        <td>
                                                            {{$usage->count}}
                                                        </td>
                                                        <td>
                                                            {{$usage->count*$usage->material->price}}тг
                                                        </td>
                                                        <td>
                                                            {{$usage->employee->name}} {{$usage->employee->surname}}
                                                        </td>
                                                        <td>
                                                            {{$usage->created_at}}
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="delivery">
                                    <h2>Поставки</h2>
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