@extends('layouts.master')

@section('title', 'Добавить отчисление')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Новое отчисление</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-6" id="cashflow">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                        <form method="POST" action="{{ URL::to('create-expanse') }}" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Дата поступления</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                              </span>
                                        </div>
                                        <input type="text" id="datepicker" class="form-control text-center" name="cashflow_date" >
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group {{ $errors->has('cashbox_id') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Касса</label>
                                    <select class="form-control" name = "cashbox_id">
                                        @if(isset($id))
                                            @foreach($cashBoxes as $cashBox)
                                                <option value = "{{$cashBox->id}}" {{ $cashBox->id==$id ? ' selected' : '' }}>{{$cashBox->name}}</option>
                                            @endforeach
                                        @else
                                            <option disabled selected>Выберите кассу</option>
                                            @foreach($cashBoxes as $cashBox)
                                                <option value = "{{$cashBox->id}}">{{$cashBox->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {!! $errors->first('cashbox_id', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('payment_item_id') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Тип статьи</label>
                                    <select class="form-control" name = "payment_item_id">
                                        <option disabled selected>Выберите тип статьи</option>
                                        @foreach($paymentItems as $paymentItem)
                                            <option value = "{{$paymentItem->id}}">{{$paymentItem->name}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('payment_item_id', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Сумма</label>
                                    <input type="number" class="form-control" id="inputBalance" name="amount">
                                    {!! $errors->first('amount', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        const config = {
            language: 'ru',
            format: 'dd/mm/yyyy',
            todayHighlight: true,
        };
        $(document).ready(function () {
            $( "#datepicker" ).datepicker(config);
            $( "#datepicker" ).datepicker("setDate", new Date());
            $('#datepicker').on('changeDate', function(ev){
                $(this).datepicker('hide');
            });
        });
    </script>
@endsection