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
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class=" col-md-6 form-group" v-if="selectedEvent.status=='pending' || eventPending">
                                                    <label for="employee">Сотрудник </label>
                                                    <select class="form-control" v-model="selectedEvent.employee_id" name="employee" id="employee">
                                                        <option value="">Выберите сотрудника</option>
                                                        <option v-for="item in employees"
                                                                :value="item.id">{{ item.name}} {{ item.surname}}</option>
                                                    </select>
                                                </div>
                                                <div class=" col-md-6 form-group" v-else>
                                                    <label for="employee">Сотрудник </label>
                                                    <select class="form-control" disabled v-model="selectedEvent.employee_id" name="employee" id="employee">
                                                        <option value="">Выберите сотрудника</option>
                                                        <option v-for="item in employees"
                                                                :value="item.id">{{ item.name}}</option>
                                                    </select>
                                                </div>
                                                <div class=" col-md-6 form-group" v-if="selectedEvent.status=='pending' || eventPending">
                                                    <label for="patient">Пациент</label>
                                                    <select class="form-control" v-model="selectedEvent.patient_id" @change="patientSelected()" name="patient" id="patient">
                                                        <option value="">Выберите пациента</option>
                                                        <option v-for="item in patients"
                                                                :value="item.id">{{ item.name}} {{ item.surname}}</option>
                                                    </select>

                                                    <a role="button" class="btn btn-outline-primary btn-sm  mt-3" @click="getPatientInfo()">Посмотреть подробную информацию</a>
                                                </div>
                                                <div class="col-md-6 form-group" v-else>
                                                    <label for="patient">Пациент</label>
                                                    <select disabled class="form-control" v-model="selectedEvent.patient_id" @change="patientSelected()" name="patient" id="patient">
                                                        <option value="">Выберите пациента</option>
                                                        <option v-for="item in patients"
                                                                :value="item.id">{{ item.name}} {{ item.surname}}</option>
                                                    </select>

                                                </div>
                                            </div>


                                            <hr>

                                            <div class="form-group" v-if="selectedEvent.status=='pending' || eventPending">
                                                <label for="status-comment">Комментарии</label>
                                                <textarea class="form-control" v-model="selectedEvent.status_comment" id="status-comment"></textarea>
                                            </div>
                                            <div class="form-group" v-else>
                                                <label for="status-comment">Комментарии</label>
                                                <textarea class="form-control" v-model="selectedEvent.status_comment" id="status-comment" disabled></textarea>
                                            </div>
                                            <!--<div class="form-group" v-if="selectedEvent.status=='pending' || eventPending">-->
                                                <!--<label for="title">Заголовок</label>-->
                                                <!--<input type="text" class="form-control" v-model="selectedEvent.title" id="title">-->
                                            <!--</div>-->
                                            <!--<div class="form-group" v-else>-->
                                                <!--<label for="title">Заголовок</label>-->
                                                <!--<input type="text" class="form-control" v-model="selectedEvent.title" id="title" disabled>-->
                                            <!--</div>-->

                                            <div class="form-group" v-if="selectedEvent.status=='pending' || eventPending">
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
                                            <div class="form-group" v-if="selectedEvent.status=='pending' || eventPending">
                                                <label for="status">Статус</label>
                                                <select class="form-control" v-model="selectedEvent.status" name="status" id="status">
                                                    <option value="pending">В ожидании</option>
                                                    <option value="success">Успешно прошла</option>
                                                    <option value="client_miss">Клиент не пришел</option>
                                                </select>
                                            </div>
                                            <div class="form-group" v-else>
                                                <label for="status">Статус</label>
                                                <select class="form-control" v-model="selectedEvent.status" name="status" id="status" disabled>
                                                    <option value="pending">В ожидании</option>
                                                    <option value="success">Успешно прошла</option>
                                                    <option value="client_miss">Клиент не пришел</option>
                                                </select>
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
                                                                <th>Количество</th>
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
                                                <!--<p v-for="service in selectedEvent.services">-->
                                                    <!--<strong>{{ service.name }}:</strong> {{service.price }} тг.-->
                                                <!--</p>-->
                                                <p v-if="selectedEvent.patient.discount > 0"><strong>Скидка: </strong>{{ selectedEvent.patient.discount }}%</p>

                                                <input type="number" class="form-control" v-model="selectedEvent.price" v-if="selectedEvent.status=='pending'  || eventPending">
                                                <hr>
                                                <h4>
                                                Итого: {{selectedEvent.price}} тг.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" v-if="selectedEvent.status=='pending' || eventPending">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" @click="updateSelectedAppointment">Сохранить изменения</button>
                        <button type="button" class="btn btn-danger" @click="deleteAppointment">Удалить запись</button>
                    </div>
                    <div class="modal-footer" v-else>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
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
            getPatientById: Function,
            eventPending:{
                type: Boolean,
                required: false,
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
                    minTime: '09:00:00',
                    maxTime: '21:00:00',
                    slotDuration:'00:30:00',
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
