
@extends('layouts.master')
@section('title', "{$cashBox->name}")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$cashBox->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                                <button type="button" class="btn btn-block btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Действия</button>
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, 38px, 0px);">
                                    <a class="dropdown-item" href="#">Редактировать</a>
                                    <a class="dropdown-item" href="#">Удалить</a>
                                </div>
                            </div>
                        </li>
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                                <a href="/create-income/{{$cashBox->id}}" role = "button" class = "btn btn-block btn-outline-primary btn-sm">Добавить Поступление</a>
                            </div>
                        </li>
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                                <a href="/create-expanse/{{$cashBox->id}}" role = "button" class = "btn btn-block btn-outline-primary btn-sm">Добавить Отчисление</a>
                            </div>
                        </li>
                        <li class="ml-1 pt-1">
                            <div class="btn-group">
                            <a href="#" role = "button" class = "btn btn-block btn-outline-primary btn-sm">Перевод</a>
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
                                <div class="col-md-3 mr-0">
                                    <div class="card card-info card-outline">
                                        <div class="card-header">
                                            <h6 class="card-title text-center">Текущий баланс</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class=" text-info currency">{{$cashBox->current_balance}} тг</h4>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-3 mr-0">
                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <h6 class="card-title text-center">Доходы</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class=" text-success">{{$cashBox->income}} тг</h4>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-3 mr-0">
                                    <div class="card card-danger card-outline">
                                        <div class="card-header">
                                            <h6 class="card-title text-center">Расходы</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class=" text-danger">{{$cashBox->expanse}} тг</h4>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-3 mr-0">
                                    <div class="card card-info card-outline">
                                        <div class="card-header">
                                            <h6 class="card-title text-center">Начальный капитал</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="text">{{$cashBox->initial_balance}} тг</h4>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>

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
