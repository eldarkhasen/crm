@extends('layouts.master')

@section('title', 'Новая касса')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить новую кассу</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method ="POST" action = "{{ URL::to('cashBoxes') }}" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Наименование</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                    {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле или придумайте новое имя</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('initial_balance') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Начальный баланс</label>
                                    <input type="number" class="form-control" id="inputBalance" name = "initial_balance" value = "0">
                                    {!! $errors->first('initial_balance', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card -->



                </div>
                {{--<div class="col-md-12">--}}
                    {{--<div class="card card-primary">--}}


                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </section>

@endsection