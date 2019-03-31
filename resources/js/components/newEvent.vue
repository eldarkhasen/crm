<template>
    <div class="modal fade" id="addAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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

                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="employee">Сотрудник </label>
                                                <select class="form-control" v-model="newEvent.employee_id" name="employee" id="employee">
                                                    <option value="">Выберите сотрудника</option>
                                                    <option v-for="item in employees"
                                                            :value="item.id">{{ item.name}}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="service">Услуга </label>
                                                <select class="form-control" v-model="newEvent.service_id" name="service" id="service">
                                                    <option value="">Выберите услугу</option>
                                                    <option v-for="item in services"
                                                            :value="item.id">{{ item.name}}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <div class="row">
                                                    <label for="patient">Пациент</label>
                                                    <div class="col-10">
                                                        <select class="form-control" v-model="newEvent.patient_id" @change="patientSelected()" name="patient" id="patient">
                                                            <option value="">Выберите пациента</option>
                                                            <option v-for="item in patients"
                                                                    :value="item.id">{{ item.name}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-2" v-if="!addNewPatient">
                                                        <i class="fas fa-plus" @click="addNewPatient = true" title="добавить нового клиента"></i>
                                                    </div>
                                                    <div class="col-2" v-else>
                                                        <i class="fas fa-minus" @click="addNewPatient = false" title="отменить добавление нового клиента"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" v-if="addNewPatient && newEvent.patient_id == null">
                                            <h3>Данные нового клиента</h3>
                                            <div class="row mt-1">
                                                <div class="col-md-3">
                                                    <label for="firstname">Имя</label>
                                                    <input class="form-control" name="firstname" type="text" v-model="newPatient.name">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="lastname">Фамилия</label>
                                                    <input class="form-control" name="lastname" type="text" v-model="newPatient.surname">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="patronymic" v-model="newPatient.patronymic">Отчество</label>
                                                    <input class="form-control" name="patronymic" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="gender" v-model="newPatient.gender">Пол</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="1">Мужской</option>
                                                        <option value="2">Женский</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-3">
                                                    <label for="phone" v-model="newPatient.phone">Телефон</label>
                                                    <input class="form-control" name="phone" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="email" v-model="newPatient.email">Email</label>
                                                    <input class="form-control" name="email" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="birthday" v-model="newPatient.birthday">Дата рождения</label>
                                                    <input class="form-control" name="birthday" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="discount" v-model="newPatient.discount">Процент скидки</label>
                                                    <input class="form-control" name="discount" type="text">
                                                </div>
                                            </div>
                                            <h5 class="mt-3">Дополнительная информация</h5>
                                            <div class="row mt-1">
                                                <div class="col-md-3">
                                                    <label for="iin" v-model="newPatient.iin">ИИН</label>
                                                    <input class="form-control" name="iin" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="id_card" v-model="newPatient.id_card">Уд. личности</label>
                                                    <input class="form-control" name="id_card" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="birthday" v-model="newPatient.birthday">Дата рождения</label>
                                                    <input class="form-control" name="birthday" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="discount" v-model="newPatient.discount">Процент скидки</label>
                                                    <input class="form-control" name="discount" type="text">
                                                </div>
                                            </div>
                                            <button type="submit" @click="submitNewPatient()" class="btn btn-primary mt-3">Добавить</button>
                                        </div>

                                        <div class="form-group" v-if="newEvent.patient_id != null">
                                            <h3>Данные пациента</h3>
                                            <div class="row mt-1">
                                                <div class="col-md-3">
                                                    <label for="firstname">Имя</label>
                                                    <input class="form-control" name="firstname" type="text" v-model="newEvent.patient.name">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="lastname">Фамилия</label>
                                                    <input class="form-control" name="lastname" type="text" v-model="newEvent.patient.surname">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="patronymic">Отчество</label>
                                                    <input class="form-control" name="patronymic" type="text" v-model="newEvent.patient.patronymic">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="phone">Телефон</label>
                                                    <input class="form-control" name="phone" type="text" v-model="newEvent.patient.phone">
                                                </div>
                                            </div>

                                            <div class="row mt-1">
                                                <div class="col-md-3">
                                                    <label for="birthday">Дата рождения</label>
                                                    <input class="form-control" name="birthday" type="text" v-model="newEvent.patient.birthday">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="lastname">Номер карты</label>
                                                    <input class="form-control" name="lastname" type="text" v-model="newEvent.patient.id_card">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="patronymic">Пол</label>
                                                    <select class="form-control" name="patronymic" type="text" v-model="newEvent.patient.gender">
                                                        <option value="Мужской">Мужской</option>
                                                        <option value="Женский">Женский</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <!--<label for="phone">Телефон</label>-->
                                                    <!--<input class="form-control" name="phone" type="text">-->
                                                </div>
                                            </div>
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
            getPatientById: Function
        },
        data() {
            var self = this;
            return {
                addNewPatient: false,
                newPatient: {
                    name: null,
                    surname: null,
                    patronymic: null,
                    phone: null,
                    email: null,
                    gender: null,
                    birthday: null,
                    discount: null,
                    iin: null,
                    id_card: null,
                    city: null,
                    address: null
                }
            }
        },
        methods: {
            patientSelected() {
                this.addNewPatient = false;
                this.newEvent.patient = this.getPatientById(this.newEvent.patient_id);
            },
            submitNewPatient() {
                // TODO: set patient_id to new event after response, return from back new id
                var self = this;
                window.axios.post('/patients',
                    {
                        // TODO: try tp pass just newPatient object
                        name: self.newPatient.name,
                        surname: self.newPatient.surname,
                        patronymic: self.newPatient.patronymic,
                        phone: self.newPatient.phone,
                        email: self.newPatient.email,
                        gender: self.newPatient.gender,
                        birthday: self.newPatient.birthday,
                        discount: self.newPatient.discount,
                        iin: self.newPatient.iin,
                        id_card: self.newPatient.id_card,
                        city: self.newPatient.city,
                        address: self.newPatient.address

                    })
                    .then((response) => {
                        self.newEvent.patient_id = response.data.patient.id;
                        self.patients.push(response.data.patient);
                    })
                    .catch(e => {
                        alert("some error");
                    })
            }
        }
    }
</script>

<style scoped>

</style>