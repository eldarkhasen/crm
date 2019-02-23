<template>
    <div class="modal fade" id="addAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Новая запись <small>с {{newEvent.startText}} по {{newEvent.endText}}</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container-fliud">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="title">Заголовок</label>
                                            <input type="text" class="form-control" v-model="newEvent.title" id="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="employee">Сотрудник </label>
                                            <select class="form-control" v-model="newEvent.employee_id" name="employee" id="employee">
                                                <option value="">Выберите сотрудника</option>
                                                <option v-for="item in employees"
                                                        :value="item.id">{{ item.name}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="service">Услуга </label>
                                            <select class="form-control" v-model="newEvent.service_id" name="service" id="service">
                                                <option value="">Выберите услугу</option>
                                                <option v-for="item in services"
                                                        :value="item.id">{{ item.name}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="patient">Пациент</label>
                                            <select class="form-control" v-model="newEvent.patient_id" name="patient" id="patient">
                                                <option value="">Выберите пациента</option>
                                                <option v-for="item in patients"
                                                        :value="item.id">{{ item.name}}</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" @click="addAppointment">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            newEvent: Object,
            employees: Array,
            services: Array,
            patients: Array,
            addAppointment: Function,
        },
    }
</script>

<style scoped>

</style>