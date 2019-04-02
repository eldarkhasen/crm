
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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

Vue.use(VueAxios, axios);
window.Vue = require('vue');
Vue.use(VueInputMask);
Vue.use(VueValidate);
Vue.use(Toaster, {timeout: 3000});

// register globally
Vue.component('multiselect', Multiselect);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('appointment-component', require('./components/AppointmentComponent.vue'));
Vue.component('new-event', require('./components/newEvent.vue'));
// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
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

        // eventSources: [
        //     {
        //         events(callback) {
        //             window.axios.get('/getAppointments').then((response) => {
        //                 callback(response.data.appointments)
        //             })
        //         }
            // }
        // ],
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
                self.events.forEach(function (event) {
                    event.patient = {};
                });
            }).catch(e => {
                alert("some error while getting appointments");
            })
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
                }
            });

            self.events[id] = Object.assign({}, event);
            self.setSelectedEvent({});
            //self.refreshTimetable();
            window.location.href = '/appointments';
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
                service_id: null,
                patient_id: null,
                color: '#1ABC9C',
                patient: {}
            };
        },

        addAppointment: function(){
            var self = this;
            this.newEvent.title = this.newEvent.patient.name + " " + this.newEvent.patient.surname + " " + this.newEvent.patient.phone;
            window.axios.post('/appointments',
                {
                    title: this.newEvent.title,
                    employee_id: this.newEvent.employee_id,
                    service_id: this.newEvent.service_id,
                    patient_id: this.newEvent.patient_id,
                    start: this.newEvent.start.format('Y-MM-DD') + 'T' + this.newEvent.start.format('HH:mm:ss'),
                    end: this.newEvent.end.format('Y-MM-DD') + 'T' + this.newEvent.end.format('HH:mm:ss')
                })
                .then((response) => {
                    self.newEvent.id = response.data.id;
                    self.addEvent();
                    self.setDefaultNewEvent();
                })
                .catch(e => {
                    alert("some error");
                })
        },

        updateAppointment: function(event){
            var self = this;
            window.axios.put('/appointments/update', // + event.id,
                {
                    id: event.id,
                    title: event.title,
                    employee_id: event.employee_id,
                    service_id: event.service_id,
                    patient_id: event.patient_id,
                    start: event.start.format('Y-MM-DD') + 'T' + event.start.format('HH:mm:ss'),
                    end: event.end.format('Y-MM-DD') + 'T' + event.end.format('HH:mm:ss')
                })
                .then((response) => {
                })
                .catch(e => {
                    alert("some error");
                })
        },

        updateSelectedAppointment: function(){
            var self = this;
            window.axios.put('/appointments/update',
                {
                    id: self.selectedEvent.id,
                    title: self.selectedEvent.title,
                    employee_id: self.selectedEvent.employee_id,
                    service_id: self.selectedEvent.service_id,
                    patient_id: self.selectedEvent.patient_id,
                    start: self.selectedEvent.start,
                    end: self.selectedEvent.end,
                })
                .then((response) => {
                    if(response.data.success)
                        self.updateEvent(self.selectedEvent);
                })
                .catch(e => {
                    alert("some error");
                })
        },

        deleteAppointment: function(){ //event = null){
            var self = this;
            // if(event == null){
            event = Object.assign({}, self.selectedEvent);
                // alert(event.id);
            // }

            window.axios.delete('/appointments/' + event.id)
                .then((response) => {
                    self.deleteEvent(event.id);
                })
                .catch(e => {
                    alert("some error");
                })
        },

        setSelectedEvent: function(event){
            this.selectedEvent = Object.assign({}, event);
        },

        refreshTimetable: function(){
            $('#calendar').render(); //fullCalendar('refetchEvents');
            //.fullCalendar('refetchEvents');
            // var self = this;
            // $(self.el).fullCalendar.render();
        }
    },
    watch: {
        // newEvent: function(newVal, oldVal){
        //     if(this.newEvent.patient_id != null && this.newEvent.patient_id != 0){
        //         var self = this;
        //
        //         this.patients.forEach(function (patient){
        //             if(patient.id == self.newEvent.patient_id){
        //                 self.newEvent.title = patient.firstName + " " + patient.lastName + " / " + patient.phone;
        //             }
        //
        //         });
        //     }
        // }
    },
    created(){
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
