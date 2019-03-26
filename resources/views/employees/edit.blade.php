{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
@section('title', "{$employee->name} {$employee->surname}")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактировать сотрудника </h1>

                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
        <div class="container-fliud" id = "addEmployee">
            <edit-emp-component :employee="{{ $employee->toJson() }}"
            ></edit-emp-component>


            @include('errors.list')
        </div>
    </section>


@endsection