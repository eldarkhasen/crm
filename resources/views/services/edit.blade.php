@extends('layouts.master')

@section('title', '| Редатировать услугу')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактировать услугу</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        {{ Form::model($service, array('route' => array('services.update', $service->id), 'method' => 'PUT')) }}

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" id="inputName" name = "name" value = "{{$service->name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <textarea class="form-control" id="inputName" name = "description" rows="4" >{{$service->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDuration">Продолжительность</label>
                                <input type="text" class="form-control" id="inputDuration" name = "duration" value = "{{$service->duration}}">
                                {!! $errors->first('duration', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="inputCategory">Категория</label>
                                <input type="text" class="form-control" id="inputCategory" name = "category" value="{{$service->category}}">
                                {!! $errors->first('category', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">Цена</label>
                                <input type="number" class="form-control" id="inputPrice" name = "price" value="{{$service->price}}">
                                {!! $errors->first('price', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="inputMaxPrice">Максимальная цена</label>
                                <input type="number" class="form-control" id="inputDuration" name = "max_price" value="{{$service->max_price}}">
                                {!! $errors->first('max_price', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="" onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();" class="btn btn-danger">Удалить</a>

                        </div>
                        {{ Form::close() }}
                        {{ Form::open(array('route' => array('services.destroy', $service->id), 'method' => 'delete', "style"=>"display: none;","id"=>"delete-form")) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection