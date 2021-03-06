@extends('layouts.master')

@section('title', '| Новая услуга')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить новую услугу</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <form method ="POST" action = "{{ URL::to('services') }}"  autocomplete="off" >
                            @csrf
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Наименование</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                    {!! $errors->first('name', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Описание</label>
                                    <textarea class="form-control" id="inputName" name = "description" rows="4"></textarea>
                                    {!! $errors->first('description', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
                                    <label for="inputDuration">Продолжительность (мин)</label>
                                    <input type="number" class="form-control" id="inputDuration" name = "duration">
                                    {!! $errors->first('duration', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                                    <label for="inputCategory">Категория</label>
                                    <input type="text" class="form-control" id="inputCategory" name = "category">
                                    {!! $errors->first('category', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                    <label for="inputPrice">Цена</label>
                                    <input type="number" class="form-control" id="inputPrice" name = "price">
                                    {!! $errors->first('price', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('max_price') ? 'has-error' : ''}}">
                                    <label for="inputMaxPrice">Максимальная цена</label>
                                    <input type="number" class="form-control" id="inputDuration" name = "max_price">
                                    {!! $errors->first('max_price', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                </div>
                            </div>

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
