<template>
    <div class="col-md-12">
        <div class="row mb-2">
        </div>
        <div class="card card-info">
            <div class="card-body">
                <full-calendar :events="events" :editable="true" :config="config" ></full-calendar>
            </div>
        </div>

        <div class="modal fade" id="editAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
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

                                            <div class="form-group">
                                                <label for="title">Заголовок</label>
                                                <input type="text" class="form-control" v-model="selectedEvent.title" id="title">
                                            </div>
                                            <div class="form-group">
                                                <label for="employee">Сотрудник </label>
                                                <select class="form-control" v-model="selectedEvent.employee_id" name="employee" id="employee">
                                                    <option value="">Выберите сотрудника</option>
                                                    <option v-for="item in employees"
                                                            :value="item.id">{{ item.name}}</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="services">Услуги </label>
                                                <!--<select class="form-control" v-model="selectedEvent.service_id" name="service" id="service">-->
                                                    <!--<option value="">Выберите услугу</option>-->
                                                    <!--<option v-for="item in services"-->
                                                            <!--:value="item.id">{{ item.name}}</option>-->
                                                <!--</select>-->
                                                <multiselect v-model="selectedEvent.services"
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

                                            <div class="form-group">
                                                <label for="patient">Пациент</label>
                                                <select class="form-control" v-model="selectedEvent.patient_id" name="patient" id="patient">
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
                        <button type="button" class="btn btn-primary" @click="updateSelectedAppointment">Сохранить изменения</button>
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
        },
        data(){
            var self = this;
            return {
                cal: null,
                config: {
                    customButtons: {
                        myCustomButton: {
                            text: 'Добавить запись',
                        }
                    },
                    header: {
                        left: 'agendaDay,agendaWeek',
                        center: 'prev title next today',
                        right: 'myCustomButton'
                    },
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
                                ev.startText = event.start.format('Do, H:mm');
                                ev.endText = event.end.format('Do, H:mm');
                                self.updateAppointment(ev);
                            }
                        });
                    },

                    eventDrop:(event)=>{
                        self.events.forEach(function(ev){
                            if(event.id == ev.id){
                                ev.start = event.start;
                                ev.end = event.end;
                                ev.startText = event.start.format('Do, H:mm');
                                ev.endText = event.end.format('Do, H:mm');
                                self.updateAppointment(ev);
                            }
                        });
                    },

                    select: function(start, end){
                        // this.createEvent(start, end);
                        self.newEvent.start = start;
                        self.newEvent.startText = start.format('Do, H:mm');
                        self.newEvent.end = end;
                        self.newEvent.endText = end.format('Do, H:mm');
                        $('#addAppointmentForm').modal();
                    },

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
        methods:{},
        mounted() {
            const cal = $(this.$el),
                self = this;

        },
    }
</script>
