<template>
    <div class="col-md-12">
        <div class="row mb-2">
        </div>
        <div class="card card-info">
            <div class="row">
                <div class="col-md-4 form-group mt-2 px-3">
                    <label for="filterStatus">Фильтр по статусу записи</label>
                    <select class="form-control" v-model="filterStatus" @change="toggleEvents()" name="filterStatus" id="filterStatus">
                        <option value="all">Все</option>
                        <option value="pending">В ожидании</option>
                        <option value="success">Успешно прошла</option>
                        <option value="client_miss">Клиент не пришел</option>
                    </select>
                </div>
                <div class="col-md-4 form-group mt-2 px-3">
                    <label for="filterEmployee">Фильтр по сотрудникам</label>
                    <select class="form-control" v-model="filterEmployee" @change="toggleEvents()" name="filterEmployee" id="filterEmployee">
                        <option value="all">Все</option>
                        <option v-for="item in employees"
                                :value="item.id">{{ item.name}}</option>
                    </select>
                </div>

            </div>
            <div class="card-body">
                <full-calendar :events="events"  :editable="true" :config="config" ref="calendar" nowindicator="true"></full-calendar>
            </div>
        </div>

        <div class="modal fade" id="editAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Запись <small>с {{selectedEvent.startText}} по {{selectedEvent.endText}}</small></h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fliud">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6 form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'" >
                                                    <label for="color">Цвет</label>
                                                    <input class = "form-control" type="color" v-model="selectedEvent.color" name = color id = "color">
                                                </div>
                                                <div class="col-md-6 form-group" v-else>
                                                    <label for="color">Цвет</label>
                                                    <input class = "form-control" type="color" v-model="selectedEvent.color" name = color id = "color" disabled>
                                                </div>
                                                <div class="col-md-6 form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                    <label for="status">Статус</label>
                                                    <select class="form-control" v-model="selectedEvent.status" name="status" id="status">
                                                        <option value="pending">В ожидании</option>
                                                        <option value="success">Успешно прошла</option>
                                                        <option value="client_miss">Клиент не пришел</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group" v-else>
                                                    <label for="status">Статус</label>
                                                    <select class="form-control" v-model="selectedEvent.status" name="status" id="status" disabled>
                                                        <option value="pending">В ожидании</option>
                                                        <option value="success">Успешно прошла</option>
                                                        <option value="client_miss">Клиент не пришел</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class=" col-md-6 form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                    <label for="patient">Пациент</label>
                                                    <select class="form-control" v-model="selectedEvent.patient_id" @change="patientSelected()" name="patient" id="patient">
                                                        <option value="">Выберите пациента</option>
                                                        <option v-for="item in patients"
                                                                :value="item.id">{{ item.surname}} {{ item.name}} {{ item.patronymic}} </option>
                                                    </select>

                                                    <a href = "#" type="button" class="btn btn-block btn-outline-primary btn-sm mt-3" @click="getPatientInfo()">Посмотреть подробную информацию</a>
                                                </div>
                                                <div class="col-md-6 form-group" v-else>
                                                    <label for="patient">Пациент</label>
                                                    <select disabled class="form-control" v-model="selectedEvent.patient_id" @change="patientSelected()" name="patient" id="patient">
                                                        <option value="">Выберите пациента</option>
                                                        <option v-for="item in patients"
                                                                :value="item.id">{{ item.surname}} {{ item.name}} {{ item.patronymic}}</option>
                                                    </select>

                                                </div>
                                                <div class=" col-md-6 form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                    <label for="employee">Сотрудник </label>
                                                    <select class="form-control" v-model="selectedEvent.employee_id" name="employee" id="employee">
                                                        <option value="">Выберите сотрудника</option>
                                                        <option v-for="item in employees"
                                                                :value="item.id">{{ item.surname}} {{ item.name}} {{ item.patronymic}}</option>
                                                    </select>
                                                </div>
                                                <div class=" col-md-6 form-group" v-else>
                                                    <label for="employee">Сотрудник </label>
                                                    <select class="form-control" disabled v-model="selectedEvent.employee_id" name="employee" id="employee">
                                                        <option value="">Выберите сотрудника</option>
                                                        <option v-for="item in employees"
                                                                :value="item.id">{{ item.surname}} {{ item.name}} {{ item.patronymic}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <label for="protocol">Шаблон протокола</label>
                                                <select class="form-control"  name="protocol" id="protocol" @change="protocolSelected($event)">
                                                    <option value="" selected>Выберите шаблон протокола</option>
                                                    <option v-for="item in protocols"
                                                            :value="item.id">{{ item.name}}</option>
                                                </select>

                                            </div>
                                            <hr>

                                            <div class="form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <label for="patient_problems">Жалобы пациента</label>
                                                <textarea class="form-control" v-model="selectedEvent.patient_problems" id="patient_problems" required></textarea>

                                            </div>
                                            <div class="form-group" v-else>
                                                <label for="patient_problems">Жалобы пациента</label>
                                                <textarea class="form-control" v-model="selectedEvent.patient_problems" id="patient_problems" disabled></textarea>
                                            </div>
                                            <hr>
                                            <div class="row" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <div class=" col-md-6 form-group">
                                                    <label for="patient_problems">Anamnesis vitae</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.anamnesis_vitae" id="anamnesis_vitae" required></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="patient_problems">Anamnesis morbi</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.anamnesis_morbi" id="anamnesis_morbi" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row" v-else>
                                                <div class=" col-md-6 form-group">
                                                    <label for="patient_problems">Anamnesis vitae</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.anamnesis_vitae" id="anamnesis_vitae" disabled></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="patient_problems">Anamnesis morbi</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.anamnesis_morbi" id="anamnesis_morbi" disabled></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <div class=" col-md-6 form-group">
                                                    <label for="visual_inspection">Внешний осмотр</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.visual_inspection" id="visual_inspection" required></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="bite">Прикус</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.bite" id="bite" required></textarea>
                                                </div>

                                            </div>
                                            <div class="row" v-else>
                                                <div class=" col-md-6 form-group">
                                                    <label for="visual_inspection">Внешний осмотр</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.visual_inspection" id="visual_inspection" disabled></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="bite">Прикус</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.bite" id="bite" disabled></textarea>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="row" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <div class=" col-md-6 form-group">
                                                    <label for="objective_data">Объективные данные</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.objective_data" id="objective_data" required></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="xray_data">Рентгенологические исследования
                                                    </label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.xray_data" id="xray_data" required></textarea>
                                                </div>

                                            </div>
                                            <div class="row" v-else>
                                                <div class=" col-md-6 form-group">
                                                    <label for="objective_data">Объективные данные</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.objective_data" id="objective_data" disabled></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="xray_data">Рентгенологические исследования
                                                    </label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.xray_data" id="xray_data" disabled></textarea>
                                                </div>

                                            </div>
                                            <hr>

                                            <div class="row" v-if="selectedEvent.active || selectedEvent.status==='pending'">

                                                <div class=" col-md-6 form-group">
                                                    <label for="diagnosis">Поставленный диагноз</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.diagnosis" id="diagnosis" required></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="treatment_plan">План лечения
                                                    </label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.treatment_plan" id="treatment_plan" required></textarea>
                                                </div>

                                            </div>
                                            <div class="row" v-else>

                                                <div class=" col-md-6 form-group">
                                                    <label for="diagnosis">Поставленный диагноз</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.diagnosis" id="diagnosis" disabled></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="treatment_plan">План лечения
                                                    </label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.treatment_plan" id="treatment_plan" disabled></textarea>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="row" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <div class=" col-md-6 form-group">
                                                    <label for="work_done">Лечение(проделанная работа)</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.work_done" id="work_done" required></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="xray_data">Рекомендации
                                                    </label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.recommendations" id="recommendations" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row" v-else>
                                                <div class=" col-md-6 form-group">
                                                    <label for="work_done">Лечение(проделанная работа)</label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.work_done" id="work_done" disabled></textarea>
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="recommendations">Рекомендации
                                                    </label>
                                                    <textarea class="form-control" rows="5" v-model="selectedEvent.recommendations" id="recommendations" disabled></textarea>
                                                </div>
                                            </div>

                                            <!--<div class="form-group" v-if="selectedEvent.status=='pending' || eventPending">-->
                                                <!--<label for="title">Заголовок</label>-->
                                                <!--<input type="text" class="form-control" v-model="selectedEvent.title" id="title">-->
                                            <!--</div>-->
                                            <!--<div class="form-group" v-else>-->
                                                <!--<label for="title">Заголовок</label>-->
                                                <!--<input type="text" class="form-control" v-model="selectedEvent.title" id="title" disabled>-->
                                            <!--</div>-->

                                            <div class="form-group" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                                                <label for="services">Услуги </label>
                                                <multiselect v-model="selectedEvent.services"
                                                             id="services"
                                                             :options="services"
                                                             :multiple="true"
                                                             :close-on-select="true"
                                                             :clear-on-select="true"
                                                             taggable = "true"
                                                             placeholder="Выбери Услуги"
                                                             label="name" track-by="name" :preselect-first="true"
                                                             selectLabel="Нажмите чтобы выбрать" selectedLabel="Выбрано"
                                                             deselectLabel="Нажмите чтобы убрать">
                                                </multiselect>
                                            </div>
                                            <div class="form-group" v-else>
                                                <label for="services">Услуги </label>
                                                <multiselect v-model="selectedEvent.services"
                                                             id="services"
                                                             disabled = "true"
                                                             :options="services"
                                                             :multiple="true"
                                                             taggable = "true"
                                                             :close-on-select="true"
                                                             :clear-on-select="true"
                                                             placeholder="Выбери Услуги"
                                                             label="name" track-by="name" :preselect-first="true"
                                                             selectLabel="Нажмите чтобы выбрать" selectedLabel="Выбрано"
                                                             deselectLabel="Нажмите чтобы убрать">

                                                </multiselect>
                                            </div>

                                            <div class="form-group mt-2" v-if="selectedEvent.price >= 0">
                                                <hr>
                                                <h5>Счет</h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered table-hover dataTable materialsTables"  role="grid">
                                                            <thead>
                                                            <tr>
                                                                <th>Наименование</th>
                                                                <th>Сумма</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody v-for="service in selectedEvent.services">
                                                                <tr>
                                                                    <td>
                                                                        {{ service.name }}
                                                                    </td>
                                                                    <td>
                                                                        {{service.price}} тг
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <p v-if="selectedEvent.patient.discount > 0"><strong>Скидка: </strong>{{ selectedEvent.patient.discount }}%</p>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <h5 class = "mt-3">Вышло:</h5>
                                                    </li>
                                                    <li class="list-inline-item" >

                                                        <input type="number" class="form-control" v-model="selectedEvent.price" v-if="selectedEvent.status=='pending'  || selectedEvent.active">
                                                        <input type="number" class="form-control" v-model="selectedEvent.price" disabled v-else >
                                                    </li>
                                                    <li class="list-inline-item">тг.</li>
                                                </ul>
                                                <hr>
                                                <h3>
                                                Обший итог: {{selectedEvent.price}} тг.</h3>
                                            </div>
                                            <hr>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" v-if="selectedEvent.active || selectedEvent.status==='pending'">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" @click="updateSelectedAppointment">Сохранить изменения</button>
                        <button type="button" class="btn btn-danger" @click="deleteAppointment">Удалить запись</button>
                    </div>
                    <div class="modal-footer" v-else>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" @click="openEvent">Открыть запись</button>
                        <button type="button" class="btn btn-danger" @click="deleteAppointment">Удалить запись</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
    export default {
        props: {
            editable: {
                type: Boolean,
                required: false,
                default: false
            },

            droppable: {
                type: Boolean,
                required: false,
                default: false
            },

            selectable: {
                type: Boolean,
                required: false,
                default: false
            },
            events: Array,
            newEvent: Object,
            selectedEvent: Object,
            updateAppointment: Function,
            updateSelectedAppointment: Function,
            deleteAppointment: Function,
            setSelectedEvent: Function,
            employees: Array,
            services: Array,
            patients: Array,
            protocols: Array,
            getPatientById: Function,
            eventPending:{
                type: Boolean,
                default: true
            }

        },
        data(){
            var self = this;
            return {
                cal: null,
                filterStatus: "all",
                filterEmployee: "all",
                config: {
                    header: {
                        left: 'agendaDay,agendaWeek',
                        center: 'prev title next today'
                    },
                    nowIndicator:true,
                    locale: 'ru',
                    minTime: '08:00:00',
                    maxTime: '20:00:00',
                    slotDuration:'00:10:00',
                    slotLabelFormat: [
                        'H:mm'        // lower level of text
                    ],
                    buttonText: {
                        today: "Сегодня",
                        month: "Месяц",
                        week: "Неделя",
                        day: "День"
                    },
                    allDaySlot:false,
                    timezone:'local',

                    eventClick: (event) => {
                        self.events.forEach(function(ev){
                            if(event.id == ev.id){
                                self.setSelectedEvent(ev);
                                $('#editAppointmentForm').modal();
                            }
                        });
                    },

                    eventResize:(event)=>{
                        self.events.forEach(function(ev){
                            if(event.id == ev.id){
                                ev.start = event.start;
                                ev.end = event.end;
                                ev.startText = event.start.format('d.m H:mm');
                                ev.endText = event.end.format('d.m H:mm');
                                self.updateAppointment(ev);
                            }
                        });
                    },

                    eventDrop:(event)=>{
                        self.events.forEach(function(ev){
                            if(event.id == ev.id){
                                ev.start = event.start;
                                ev.end = event.end;
                                ev.startText = event.start.format('d.m H:mm');
                                ev.endText = event.end.format('d.m H:mm');
                                self.updateAppointment(ev);
                            }
                        });
                    },

                    select: function(start, end){
                        // this.createEvent(start, end);
                        self.newEvent.start = start;
                        self.newEvent.startText = start.format('d.m H:mm');
                        self.newEvent.end = end;
                        self.newEvent.endText = end.format('d.m H:mm');
                        $('#addAppointmentForm').modal();
                    },

                    eventRender: function eventRender( event, element, view ) {
                        return (self.filterStatus === "all" || self.filterStatus === event.status) &&
                            (self.filterEmployee === "all" || self.filterEmployee === event.employee_id)
                    }
                },
                selected: {},
                slotLabels:[
                    {
                        title:"10 min",
                        duration: '00:10:00'
                    },
                    {
                        title:"20 min",
                        duration:'00:20:00'
                    },
                    {
                        title:"30 min",
                        duration:'00:30:00'
                    },
                    {
                        title:"1 hour",
                        duration:'01:00:00'
                    }
                ]

            }

        },
        methods:{
            patientSelected() {
                this.selectedEvent.patient = this.getPatientById(this.selectedEvent.patient_id);
            },
            toggleEvents() {
                $('#calendar').fullCalendar('rerenderEvents');
            },
            checkEventStatus(){
                if(this.selectedEvent.status==="success"){
                    this.eventPending=false;
                }
            },
            getPatientInfo(){
                location.href="/patients/"+this.selectedEvent.patient_id;
            },
            openEvent(){
                this.selectedEvent.active = true;
                this.selectedEvent.status = "pending";
            },
            protocolSelected(event){
                var myProtocol = null;
                for(var i = 0;i<this.protocols.length;i++){
                    if(this.protocols[i].id==event.target.value){
                        myProtocol = this.protocols[i];
                    }
                }
                this.selectedEvent.patient_problems = myProtocol.patient_problems;
                this.selectedEvent.visual_inspection = myProtocol.visual_inspection;
                this.selectedEvent.bite = myProtocol.bite;
                this.selectedEvent.objective_data = myProtocol.objective_data;
                this.selectedEvent.xray_data = myProtocol.xray_data;
                this.selectedEvent.diagnosis = myProtocol.diagnosis;
                this.selectedEvent.treatment_plan = myProtocol.treatment_plan;
                this.selectedEvent.work_done = myProtocol.work_done;
                this.selectedEvent.recommendations = myProtocol.recommendations;


            }
        },
        mounted() {
            const cal = $(this.$el),
                self = this;
        },
    }

    $(document).ready(function () {
        $('.servicesTable').DataTable({
            "processing": true,
            "responsive": true,
            "paging": false,
            "searching": false,
            "ordering": false,
            "info": false,
        });//capital "D"
    });
</script>
