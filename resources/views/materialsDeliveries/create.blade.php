{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', 'Добавить поставку')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Добавить поставку</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fliud ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" >
                        <form method ="POST" action = "{{ URL::to('materialsDeliveries') }}" autocomplete="off">
                            @csrf
                            <div class="card-body" id = "addEmployee" >
                                <fieldset class="form-group">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-hover dataTable materialsTables"  role="grid">
                                                    <thead>
                                                    <tr>
                                                        <th>Наименование</th>
                                                        <th>Ед. измерения</th>
                                                        <th>Количество</th>
                                                        <th>На складе</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group {{ $errors->has('material_id') ? 'has-error' : ''}}">
                                                                <select class="form-control" name = "material_id" id = "material_id">
                                                                    <option disabled selected>Выберите материал</option>
                                                                    @foreach($materials as $material)
                                                                        <option value="{{ $material->id }}" data-measure_unit="{{ $material->measure_unit }}" data-quantity = "{{$material->quantity}}">{{ $material->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="measure_unit" name = "measure_unit" style = "width: 150px; border:none; background-color:transparent;" value = "" readonly >
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" id="inputQuantity" name = "quantity" style = "width: 100px" value = "1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="quantity" name = "quantity_on_store" style = "width: 100px; border:none; background-color:transparent;" value = "" readonly >
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                {!! $errors->first('material_id', '<span class="help-block" style = "color:red">Выберите материал</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('invoice_number') ? 'has-error' : ''}}">
                                        <label for="inputInvoice">Номер счета</label>
                                        <input type="text" class="form-control" id="inputInvoice" name = "invoice_number">
                                        {!! $errors->first('invoice_number', '<span class="help-block" style = "color:red">Заполните данное поле</span>') !!}
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputComments">Коментарии</label>
                                        <textarea class="form-control" id="inputComments" name = "comments" rows="3"></textarea>
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

@section('script')
    <script>
        $(document).ready(function () {
            $('.materialsTables').DataTable({
                "processing": true,
                "responsive": true,
                "paging": false,
                "searching": false,
                "ordering": false,
                "info": false,
            });     //capital "D"
        });

        $('#material_id').on('change',function(){
            var measure_unit = $(this).children('option:selected').data('measure_unit');
            var quantity = $(this).children('option:selected').data('quantity');
            $('#measure_unit').val(measure_unit);
            $('#quantity').val(quantity);
        });
    </script>
@endsection