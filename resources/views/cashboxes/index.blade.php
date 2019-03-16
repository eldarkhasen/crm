
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
                        <li class="breadcrumb-item"><a href="{{ URL::to('cashBoxes/create') }}" role = "button" class = "btn btn-block btn-outline-primary btn-md"> Добавить Кассу</a></li>
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
                                        <span class="info-box-icon bg-info"><i class="fa fa-credit-card"></i></span>
                                        <div class="info-box-content">
                                            <a href="{{ route('cashBoxes.show', $cashBox->id) }}"><span class="info-box-text">{{$cashBox->name}}</span></a>
                                            <span class="info-box-number">{{$cashBox->current_balance}} тг</span>
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
                                <h6 class="mb-3">Список движения средств за последнюю неделю</h6>
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

