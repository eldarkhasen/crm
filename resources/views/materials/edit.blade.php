{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', 'Изменить материал')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Изменить материал</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" >
                        {{ Form::model($material, array('route' => array('materials.update', $material->id), 'method' => 'PUT')) }}
                            @csrf
                            <div class="card-body" id = "addEmployee" >
                                <fieldset class="form-group">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="inputName">Наименование</label>
                                        <input type="text" class="form-control" id="inputName" name = "name" value = "{{$material->name}}">
                                        {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
                                        <label for="inputQuantity">Количество</label>
                                        <input type="number" class="form-control" id="inputQuantity" name = "quantity" value = "{{$material->quantity}}">
                                        {!! $errors->first('quantity', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Ед. измерения</label>
                                        <select class="form-control" name = "measure_unit">
                                            <option @if ($material->measure_unit=="Упаковка")
                                                    selected="selected"
                                                    @endif
                                                    value = "Упаковка">Упаковка</option>
                                            <option @if ($material->measure_unit=="Килограмм")
                                                    selected="selected"
                                                    @endif
                                                    value = "Килограмм">Килограмм</option>
                                            <option @if ($material->measure_unit=="Грамм")
                                                    selected="selected"
                                                    @endif
                                                    value = "Грамм">Грамм</option>
                                            <option @if ($material->measure_unit=="Миллиграмм")
                                                    selected="selected"
                                                    @endif
                                                    value = "Миллиграмм">Миллиграмм</option>
                                            <option @if ($material->measure_unit=="Литр")
                                                    selected="selected"
                                                    @endif
                                                    value = "Литр">Литр</option>
                                            <option @if ($material->measure_unit=="Миллилитр")
                                                    selected="selected"
                                                    @endif
                                                    value = "Миллилитр">Миллилитр</option>
                                            <option @if ($material->measure_unit=="Ампула")
                                                    selected="selected"
                                                    @endif
                                                    value = "Ампула">Ампула</option>
                                            <option @if ($material->measure_unit=="Штука")
                                                    selected="selected"
                                                    @endif
                                                    value = "Штука">Штука</option>
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="inputPrice">Цена закупа (тг)</label>
                                        <input type="number" class="form-control" id="inputPrice" name = "price" value = "{{$material->price}}">
                                        {!! $errors->first('price', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('producer') ? 'has-error' : ''}}">
                                        <label for="inputProducer">Производитель</label>
                                        <input type="text" class="form-control" id="inputProducer" name = "producer" value = "{{$material->producer}}">
                                        {!! $errors->first('producer', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <label for="inputDescription">Описание</label>
                                        <textarea class="form-control" id="inputDescription" name = "description" rows="4">{{$material->description}}</textarea>
                                        {!! $errors->first('description', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                </fieldset>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection