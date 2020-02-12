require('./bootstrap');
import Vue from 'vue'
const VueInputMask = require('vue-inputmask').default;
const VueValidate = require('vee-validate').default;
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import Multiselect from 'vue-multiselect'

import 'datatables.net'
import  'datatables.net-bs4'

import axios from 'axios'
import VueAxios from 'vue-axios'
import 'toastr'
import 'fullcalendar/dist/fullcalendar.css';
import FullCalendar from 'vue-full-calendar'; //Import Full-calendar
Vue.use(FullCalendar);
import Notifications from 'vue-notification'
Vue.use(Notifications);
import moment from 'moment'

Vue.use(VueAxios, axios);
window.Vue = require('vue');
Vue.use(VueInputMask);
Vue.use(VueValidate);
Vue.use(Toaster, {timeout: 3000});

// register globally
Vue.component('multiselect', Multiselect);
Vue.component('appointment-component', require('./components/AppointmentComponent.vue'));
Vue.component('new-event', require('./components/newEvent.vue'));

class Errors {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.errors = {};
    }


    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        return this.errors.hasOwnProperty(field);
    }


    /**
     * Determine if we have any errors.
     */
    any() {
        return Object.keys(this.errors).length > 0;
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }


    /**
     * Record the new errors.
     *
     * @param {object} errors
     */
    record(errors) {
        this.errors = errors;
    }


    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}


class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }


    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url) {
        return this.submit('post', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('patch', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);

                    reject(error.response.data);
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        alert(data.message); // temporary

        this.reset();
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }
}
const app = new Vue({
    el: '#appointments',
    data: {
        employees: [], // window.Laravel.employees,
        services: [], // window.Laravel.services,
        patients: [], // window.Laravel.patients,
        events: [], // window.Laravel.appointments,
        newEvent: {},
        selectedEvent: {},
        eventPending:true
    },
    methods: {
        getPatientById: function(id) {
            var result = {};
            var BreakException = {};
            try {
                this.patients.forEach(function (patient) {
                    if (patient.id == id) {
                        result = Object.assign({}, patient);
                        throw BreakException;
                    }
                });
            }catch (e) {
                if (e !== BreakException) throw e;
            }

            return result;
        },

        getEvents: function(){
            var self = this;
            window.axios.get('/getAppointments').then((response) => {
                self.events = response.data.appointments;
            }).catch(e => {
                alert("some error while getting appointments");
            })
        },
        checkCashBox:function(){
            var check = "";
            window.axios.get('/checkCashBox').then((response) => {
                if(!response.data.cashBox){
                    alert("У вас нет кассы! Проверьте кассу!");
                    window.location = '/cashBoxes/create';
                }
            }).catch(e => {
                alert("some error while getting cashbox");
            });
            // alert(check);

        },
        getEmployees: function() {
            var self = this;
            window.axios.get('/getEmployees').then((response) => {
                self.employees = response.data.employees;
            }).catch(e => {
                alert("some error while getting employees");
            })
        },

        getServices: function() {
            var self = this;
            window.axios.get('/getServicesFront').then((response) => {
                self.services = response.data.services;
            }).catch(e => {
                alert("some error while getting services");
            })
        },

        getPatients: function() {
            var self = this;
            window.axios.get('/getPatientsFront').then((response) => {
                self.patients = response.data.patients;
            }).catch(e => {
                alert("some error while getting services");
            })
        },

        addEvent: function(){
            this.events.push(this.newEvent);
            $('#addAppointmentForm').modal('hide');
        },

        deleteEvent: function(event_id){
            var self = this;
            var id = null;
            self.events.forEach(function(ev){
                if(event_id === ev.id){
                    id = self.events.indexOf(ev);
                }
            });

            self.events.splice(id, 1);

            $('#editAppointmentForm').modal('hide');

            self.setSelectedEvent({});
        },

        updateEvent: function(event){
            var self = this;
            var id = null;
            self.events.forEach(function(ev, index){
                if(event.id === ev.id){
                    id = index;
                    $('#editAppointmentForm').modal('hide');
                    $('#calendar').fullCalendar('rerenderEvents');
                }
            });

            self.events[id] = Object.assign({}, event);
            self.setSelectedEvent({});

        },

        setDefaultNewEvent: function(){
            this.newEvent = {
                id: "",
                title: null,
                start: null,
                startText: "",
                end: null,
                endText: "",
                employee_id: null,
                services: [],
                patient_id: null,
                color: '#1ABC9C',
                price: 0,
                status: 'pending',
                xray_data: null,
                patient_problems:null,
                diagnosis:null,
                work_done:null,
                recommendations:null,
                bite:null,
                anamnesis_vitae:null,
                anamnesis_morbi:null,
                visual_inspection:null,
                treatment_plan:null,
                mucous_membrane:null,
                patient: {},
                active:true
            };
        },

        addAppointment: function(){
            var self = this;
            this.newEvent.title = this.newEvent.patient.name + " " + this.newEvent.patient.surname + "\n" +
                this.newEvent.patient.phone;

            for(var i = 0;i<this.employees.length;i++){
                if(this.employees[i].id===this.newEvent.employee_id){
                    this.newEvent.title = this.newEvent.title+"\n"+this.employees[i].name+" "+this.employees[i].surname;
                    break;
                }
            }


            window.axios.post('/appointments',
                {
                    title: this.newEvent.title,
                    employee_id: this.newEvent.employee_id,
                    services: this.newEvent.services,
                    patient_id: this.newEvent.patient_id,
                    price: this.newEvent.price,
                    status: this.newEvent.status,
                    xray_data: this.newEvent.xray_data,
                    patient_problems: this.newEvent.patient_problems,
                    diagnosis: this.newEvent.diagnosis,
                    work_done: this.newEvent.work_done,
                    anamnesis_vitae:this.newEvent.anamnesis_vitae,
                    anamnesis_morbi:this.newEvent.anamnesis_morbi,
                    visual_inspection:this.newEvent.visual_inspection,
                    active:true,
                    bite:this.newEvent.bite,
                    recommendations:this.newEvent.recommendations,
                    treatment_plan:this.newEvent.treatment_plan,
                    mucous_membrane:this.newEvent.mucous_membrane,
                    start: this.newEvent.start.format('Y-MM-DD') + ' ' + this.newEvent.start.format('HH:mm:ss'),
                    end: this.newEvent.end.format('Y-MM-DD') + ' ' + this.newEvent.end.format('HH:mm:ss')
                })
                .then((response) => {
                    self.newEvent.id = response.data.id;
                    self.addEvent();
                    self.setDefaultNewEvent();
                    //ДОБАВИТЬ ФУНКЦИЮ ВЫВОДА УВЕДОМЛЕНИЯ ДО ИЛИ ПОСЛЕ ПЕРЕЗАГРУЗКИ СТРАНИЦЫ
                    location.reload();
                    // toastr.success("Запись добавлена");
                    // toastr.options.closeButton = true;
                    // window.location.href = "{{ route('appointments.index')->with('flash_message','Сотрудник успешно добавлен')}}"
                })
                .catch(e => {
                    alert(e.name+":"+e.message+"\n"+e.stack);
                })
        },
        updateAppointment: function(event){
            if(event.status==="success"){
                event.color = "#808080";
                event.active = false;
            }
            if(event.status==="client_miss"){
                event.color = "#FF0000";
                event.active = false;
            }
            window.axios.put('/appointments/update', // + event.id,
                {
                    id: event.id,
                    title: event.title,
                    employee_id: event.employee_id,
                    services: event.services,
                    patient_id: event.patient_id,
                    price: event.price,
                    status: event.status,
                    xray_data: event.xray_data,
                    patient_problems: event.patient_problems,
                    diagnosis: event.diagnosis,
                    work_done:event.work_done,
                    anamnesis_vitae:event.anamnesis_vitae,
                    anamnesis_morbi:event.anamnesis_morbi,
                    visual_inspection:event.visual_inspection,
                    color:event.color,
                    active:event.active,
                    recommendations:event.recommendations,
                    bite:event.bite,
                    treatment_plan:event.treatment_plan,
                    mucous_membrane:event.mucous_membrane,
                    start: event.start.format('Y-MM-DD') + ' ' + event.start.format('HH:mm:ss'),
                    end: event.end.format('Y-MM-DD') + ' ' + event.end.format('HH:mm:ss')
                })
                .then((response) => {
                    toastr.success("Запись\n"+event.title+"\nобновлена");
                    toastr.options.closeButton = true;
                })
                .catch(e => {
                    alert(e);
                })

        },

        updateSelectedAppointment: function(){
            var self = this;

            if(self.selectedEvent.status==="success"){
                self.eventPending=false;
                self.selectedEvent.color = "#808080";
                self.selectedEvent.active = false;
            }
            if(self.selectedEvent.status==="client_miss"){
                self.selectedEvent.color = "#FF0000";
                self.selectedEvent.active = false;
            }
            window.axios.put('/appointments/update',
                {
                    id: self.selectedEvent.id,
                    title: self.selectedEvent.title,
                    employee_id: self.selectedEvent.employee_id,
                    services: self.selectedEvent.services,
                    patient_id: self.selectedEvent.patient_id,
                    price: self.selectedEvent.price,
                    status: self.selectedEvent.status,
                    color:self.selectedEvent.color,
                    xray_data: self.selectedEvent.xray_data,
                    patient_problems: self.selectedEvent.patient_problems,
                    diagnosis: self.selectedEvent.diagnosis,
                    work_done:self.selectedEvent.work_done,
                    anamnesis_vitae:self.selectedEvent.anamnesis_vitae,
                    anamnesis_morbi:self.selectedEvent.anamnesis_morbi,
                    visual_inspection:self.selectedEvent.visual_inspection,
                    recommendations:self.selectedEvent.recommendations,
                    bite:self.selectedEvent.bite,
                    treatment_plan:self.selectedEvent.treatment_plan,
                    mucous_membrane:self.selectedEvent.mucous_membrane,
                    start: self.selectedEvent.start,
                    end: self.selectedEvent.end,
                    active:self.selectedEvent.active,
                })
                .then((response) => {
                    if(response.data.success)
                        self.updateEvent(self.selectedEvent);

                    if(response.data.cashbox_success !== null){
                        if(response.data.cashbox_success){
                            toastr.success("Оплата записи успешно зафиксирована");
                            toastr.options.closeButton = true;
                            location.reload();
                            // window.speechSynthesis.speak(msg);
                        }else{
                            toastr.error("Ошибка фиксации оплаты");
                            toastr.options.closeButton = true;
                        }
                    }else{
                        if(response.data.success){
                            toastr.info("Запись обновлена");
                            toastr.options.closeButton = true;
                            location.reload();
                        }
                    }
                    $('#calendar').fullCalendar('rerenderEvents');
                })
                .catch(e => {
                    alert("some error");
                })
        },

        deleteAppointment: function(){ //event = null){
            var self = this;
            event = Object.assign({}, self.selectedEvent);

            window.axios.delete('/appointments/' + event.id)
                .then((response) => {
                    self.deleteEvent(event.id);
                    toastr.info("Запись "+self.selectedEvent.title+"удалена");
                    toastr.options.closeButton = true;
                })
                .catch(e => {
                    alert("some error");
                })
        },

        setSelectedEvent: function(event){
            this.selectedEvent = Object.assign({}, event);
            this.selectedEvent.startText = moment(this.selectedEvent.start).format('d.m H:mm');
            this.selectedEvent.endText = moment(this.selectedEvent.end).format('d.m H:mm');
        },

        refreshTimetable: function(){
            $('#calendar').render();
        },

        calcEventPrice(event){
            var sum = 0; //parseInt(event.price);

            if(event.services.length > 0){
                event.services.forEach(function (service) {
                   sum+=service.price;
                });
            }

            if(sum > 0 && event.patient.discount > 0){
                sum = sum - parseInt(event.patient.discount) / 100 * sum;
            }

            if(event.status==="success" && event.price!==0){
                sum = event.price;
            }

            return parseInt(sum);
        },

        notify(text){
            this.$notify({
                group: 'alerts',
                title: text,
                text: ''
            });
        },
    },
    computed: {
        editedSelectedEventPatient(){
            return this.selectedEvent.patient;
        },

        editedSelectedEventServices(){
            return this.selectedEvent.services;
        },

        editedNewEventPatient(){
            return this.newEvent.patient;
        },

        editedNewEventServices(){
            return this.newEvent.services;
        }
    },
    watch: {
        editedSelectedEventPatient(){
            console.log("edited selected event patient");
            this.selectedEvent.price = this.calcEventPrice(this.selectedEvent);
        },

        editedSelectedEventServices(){
            console.log("edited selected event services");
            this.selectedEvent.price = this.calcEventPrice(this.selectedEvent);
        },

        editedNewEventPatient(){
            this.newEvent.price = this.calcEventPrice(this.newEvent);
        },

        editedNewEventServices(){
            this.newEvent.price = this.calcEventPrice(this.newEvent);
        }
    },
    created(){
        this.checkCashBox();
        this.getEvents();
        this.getEmployees();
        this.getServices();
        this.getPatients();
        this.setDefaultNewEvent();
    }
});

$(document).ready(function() {
    $('.select2').select2();
});
