{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Create Permission')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить новый доступ</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <form method ="POST" action = "{{ URL::to('permissions') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Наименование</label>
                                    <input type="text" class="form-control" id="inputName" name = "name">
                                </div>
                                @if(!$roles->isEmpty())
                                <div class="form-group">
                                    <label for="#inputRoles">Прикрепить к должностям</label>
                                    <div class="form-check" id="inputRoles">
                                        @foreach($roles as $role)
                                        <input name = "roles[]" class="form-check-input" type="checkbox" value="{{$role->id}}">
                                        <label class="form-check-label" for = "{{$role->name}}">{{$role->name}}</label> <br>
                                        @endforeach
                                    </div>
                                </div>
                                @endif


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#roles').select2();
        });
    </script>
@endsection