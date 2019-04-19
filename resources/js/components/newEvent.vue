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
                                            <div class="col-md-6 form-group">
                                                <label for="employee">Сотрудник </label>
                                                <select class="form-control" v-model="newEvent.employee_id" name="employee" id="employee">
                                                    <option value="">Выберите сотрудника</option>
                                                    <option v-for="item in employees"
                                                            :value="item.id">{{ item.name}}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="patient">Пациент</label>
                                                <select class="form-control" v-model="newEvent.patient_id" @change="patientSelected()" name="patient" id="patient">
                                                    <option value="0" selected>Новый пациент</option>
                                                    <option v-for="item in patients"
                                                            :value="item.id">{{ item.name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="services">Услуги </label>
                                                <multiselect v-model="newEvent.services"
                                                             id="services"
                                                             :options="services"
                                                             :multiple="true"
                                                             :close-on-select="true"
                                                             :clear-on-select="true"
                                                             placeholder="Выбери Услуги"
                                                             label="name" track-by="name" :preselect-first="true"
                                                             selectLabel="Нажмите чтобы выбрать" selectedLabel="Выбрано"
                                                             deselectLabel="Нажмите чтобы убрать">

                                                </multiselect>
                                            </div>

                                        </div>

                                        <div class="form-group" v-if="false && addNewPatient && newEvent.patient_id == null">
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
                                                    <label for="birth_date" v-model="newPatient.birth_date">Дата рождения</label>
                                                    <input class="form-control" name="birth_date" type="text">
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
                                                    <label for="discount" v-model="newPatient.discount">Процент скидки</label>
                                                    <input class="form-control" name="discount" type="text">
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            <button type="submit" @click="submitNewPatient()" class="btn btn-primary mt-3">Добавить</button>
                                        </div>

                                        <div class="form-group" v-if="true || newEvent.patient_id != null">
                                            <h3>Данные <span v-if="newEvent.patient_id == 0">нового</span> пациента</h3>
                                            <div class="row mt-1">
                                                <div class="col-md-3">
                                                    <label for="firstname">Имя</label>
                                                    <input class="form-control" id="firstname" type="text" v-model="newEvent.patient.name">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="lastname">Фамилия</label>
                                                    <input class="form-control" id="lastname" type="text" v-model="newEvent.patient.surname">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="patronymic">Отчество</label>
                                                    <input class="form-control" id="patronymic" type="text" v-model="newEvent.patient.patronymic">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="phone">Телефон</label>
                                                    <input class="form-control" id="phone" type="text" v-model="newEvent.patient.phone">
                                                </div>
                                            </div>

                                            <div class="row mt-1" v-if="newEvent.patient_id == 0">
                                                <div class="col-md-3">
                                                    <label for="birth_date">Дата рождения</label>
                                                    <input class="form-control" id="birth_date" type="text" v-model="newEvent.patient.birth_date">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" v-model="newEvent.patient.email">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="new-lastname">Номер карты</label>
                                                    <input class="form-control" id="new-lastname" type="text" v-model="newEvent.patient.id_card">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="new-patronymic">Пол</label>
                                                    <select class="form-control" id="new-patronymic" type="text" v-model="newEvent.patient.gender">
                                                        <option value="Мужской">Мужской</option>
                                                        <option value="Женский">Женский</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <h5 class="mt-3" v-if="newEvent.patient_id == 0">Дополнительная информация</h5>
                                            <div class="row mt-1" v-if="newEvent.patient_id == 0">
                                                <div class="col-md-3">
                                                    <label for="iin" v-model="newEvent.patient.iin">ИИН</label>
                                                    <input id="iin" class="form-control" name="iin" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="id_card" v-model="newEvent.patient.id_card">Уд. личности</label>
                                                    <input id="id_card" class="form-control" name="id_card" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="discount">Процент скидки</label>
                                                    <input id="discount" class="form-control" v-model="newEvent.patient.discount" name="discount" type="text">
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            <button v-if="newEvent.patient_id == 0" type="submit" @click="submitNewPatient()" class="btn btn-primary mt-3">Добавить клиента в базу</button>
                                        </div>

                                        <div class="form-group mt-2" v-if="newEvent.price > 0">
                                            <hr>
                                            <h5>Счет</h5>
                                            <p v-for="service in newEvent.services">
                                                <strong>{{ service.name }}:</strong> {{service.price }} тг.
                                            </p>
                                            <p v-if="newEvent.patient.discount > 0"><strong>Скидка: </strong>{{ newEvent.patient.discount }}%</p>
                                            <hr>
                                            <h4>Итого: {{newEvent.price}} тг.</h4>
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
                newPatient: {
                    name: null,
                    surname: null,
                    patronymic: null,
                    phone: null,
                    email: null,
                    gender: null,
                    birth_date: null,
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
                var self = this;
                window.axios.post('/patients',
                    {
                        // TODO: try tp pass just newPatient object
                        newPatient: 1,
                        name: self.newEvent.patient.name,
                        surname: self.newEvent.patient.surname,
                        patronymic: self.newEvent.patient.patronymic,
                        phone: self.newEvent.patient.phone,
                        email: self.newEvent.patient.email,
                        gender: self.newEvent.patient.gender,
                        birth_date: self.newEvent.patient.birth_date,
                        discount: self.newEvent.patient.discount,
                        iin: self.newEvent.patient.iin,
                        id_card: self.newEvent.patient.id_card,
                        city: self.newEvent.patient.city,
                        address: self.newEvent.patient.address

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