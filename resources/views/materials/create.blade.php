{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', 'Добавить материал')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Добавить материал</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" >
                        <form method ="POST" action = "{{ URL::to('materials') }}" autocomplete="off">
                            @csrf
                            <div class="card-body" id = "addEmployee" >
                                <fieldset class="form-group">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="inputName">Наименование</label>
                                        <input type="text" class="form-control" id="inputName" name = "name">
                                        {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
                                        <label for="inputQuantity">Количество</label>
                                        <input type="number" class="form-control" id="inputQuantity" name = "quantity">
                                        {!! $errors->first('quantity', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Ед. измерения</label>
                                        <select class="form-control" name = "measure_unit">
                                            <option value = "Упаковка">Упаковка</option>
                                            <option value = "Килограмм">Килограмм</option>
                                            <option value = "Грамм">Грамм</option>
                                            <option value = "Миллиграмм">Миллиграмм</option>
                                            <option value = "Литр">Литр</option>
                                            <option value = "Миллилитр">Миллилитр</option>
                                            <option value = "Ампула">Ампула</option>
                                            <option value = "Штука">Штука</option>
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="inputPrice">Цена закупа (тг)</label>
                                        <input type="number" class="form-control" id="inputPrice" name = "price">
                                        {!! $errors->first('price', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('producer') ? 'has-error' : ''}}">
                                        <label for="inputProducer">Производитель</label>
                                        <input type="text" class="form-control" id="inputProducer" name = "producer">
                                        {!! $errors->first('producer', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <label for="inputDescription">Описание</label>
                                        <textarea class="form-control" id="inputDescription" name = "description" rows="4"></textarea>
                                        {!! $errors->first('description', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                </fieldset>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection