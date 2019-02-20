{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
@section('title', '| График')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>График </h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12" id = "app">
                    <appointment-component :editable = "true" :droppable = "true"></appointment-component>

                </div>
            </div>
        </div>
    </section>


@endsection

