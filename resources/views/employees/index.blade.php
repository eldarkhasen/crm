{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', '| Сотрудники')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Список сотрудников</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('employees/create') }}"  type = "button" class = "btn btn-block btn-outline-primary">Добавить сотрудника</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Отчество</th>
                                    <th>Дата добавления</th>
                                    <th>Должности</th>
                                    <th>Действие</th>
                                </tr>
                                @foreach ($employees as $emp)
                                <tr>

                                <td>{{ $emp->name }}</td>
                                <td>{{ $emp->surname }}</td>
                                <td>{{ $emp->patronymic }}</td>
                                <td>{{ $emp->created_at->toDateTimeString() }}</td>
                                <td>{{ $emp->positions()->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $emp->id) }}"><i class="fa fa-edit"></i></a>
                                    /
                                    <a href="{{ route('employees.edit', $emp->id) }}"><i class="fa fa-trash-alt"></i></a>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {!! $employees->render() !!}
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@endsection