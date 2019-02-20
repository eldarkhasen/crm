<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 20.02.2019
 * Time: 21:09
 */?>
<div class="modal fade" id="addAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Новая запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container-fliud">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">

                                {{-- TODO: привязать значения к объекту новой записи --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="employee">Сотрудник </label>
                                        <select class="form-control" name="employee" id="employee">
                                            <option value="">Выберите сотрудника</option>
                                            <option v-for="item in employees"
                                                    :value="item.id">@{{ item.name}}</option>
                                        </select>
                                        {!! $errors->first('employee', '<span class="help-block" style = "color:red">Выберите сотрудника</span>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="service">Услуга </label>
                                        <select class="form-control" name="service" id="service">
                                            <option value="">Выберите услугу</option>
                                            <option v-for="item in services"
                                                    :value="item.id">@{{ item.name}}</option>
                                        </select>
                                        {!! $errors->first('service', '<span class="form-control" class="help-block" style = "color:red">Выберите услугу</span>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="patient">Пациент</label>
                                        <select class="form-control" name="patient" id="patient">
                                            <option value="">Выберите пациента</option>
                                            <option v-for="item in patients"
                                                    :value="item.id">@{{ item.name}}</option>
                                        </select>
                                        {!! $errors->first('patient', '<span class="form-control" class="help-block" style = "color:red">Выберите пациента</span>') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>