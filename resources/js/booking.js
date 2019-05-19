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
import moment from 'moment'
import Notifications from 'vue-notification'
Vue.use(Notifications);

Vue.use(VueAxios, axios);
window.Vue = require('vue');
Vue.use(VueInputMask);
Vue.use(VueValidate);
Vue.use(Toaster, {timeout: 3000});

// register globally
Vue.component('multiselect', Multiselect);
Vue.component('step1', require('./components/booking/Step1.vue'));
Vue.component('step2', require('./components/booking/Step2.vue'));
Vue.component('step3', require('./components/booking/Step3.vue'));
Vue.component('step4', require('./components/booking/Step4.vue'));

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
    el: '#booking',
    data: {
        employees: [],
        services: [],
        appointment: {
            date: new Date(),
            time: null,
            patient: {}
        },

        step: 1,
        statusStep: 1,
        confirmBtnDisabled: false,
        finished: false
    },
    methods: {

        getServices: function() {
            var self = this;
            window.axios.get('/getServicesFront').then((response) => {
                self.services = response.data.services;
            }).catch(e => {
                alert("some error while getting services");
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

        checkPatientsInfo(patient){

            return this.isset(patient.name)
                && this.isset(patient.surname)
                && this.isset(patient.phone)
                && this.isset(patient.email);

        },

        stepClicked(step){
            if (this.statusStep >= step){
                this.step = step
            }else{
                this.notify('Сначала заполните все данные')
            }
        },

        nextBtnClicked: function () {
            if(this.step < 4 && this.allowNext){
                this.step++;
                if(this.step > this.statusStep) this.statusStep = this.step
            }else{
                this.notify('Заполните данные')
            }
        },

        backBtnClicked: function () {
            if(this.step > 1) this.step--;
        },

        confirmBtnClicked: function () {
            this.appointment.title = this.appointment.patient.name + " " + this.appointment.patient.surname + " " + this.appointment.patient.phone;

            window.axios.post('/appointments',
                {
                    title: this.appointment.title,
                    employee_id: this.appointment.employee_id,
                    patient: this.appointment.patient,
                    services: this.appointment.services,
                    price: this.appointment.price,
                    status: "pending",
                    status_comment: this.appointment.notes,
                    start: moment(String(this.appointment.date)).format('Y-MM-DD') + 'T' + moment(String(this.appointment.time)).format('HH:mm:ss'),
                    end: moment(String(this.appointment.date)).format('Y-MM-DD') + 'T' + moment(String(this.appointment.time)).add(30, 'm').format('HH:mm:ss')
                }).then((response) => {
                    if(response.data.success){
                        this.notify('Ваш запись успешно создана');
                        this.confirmBtnDisabled = true;
                        this.finished = true;
                    } else {
                        this.notify(response.data.error)
                    }
                })
                .catch(e => {
                    this.notify('Ошибка при создании записи');
                })
        },

        notify(text){
            this.$notify({
                group: 'alerts',
                title: text,
                text: ''
            });
        },

        isset(variable){
            return typeof variable !== 'undefined' && variable != null && variable !== '';
        }
    },
    computed: {
        allowNext() {

            var allow = true;

            switch(this.statusStep) {
                case 1:
                    allow = typeof this.appointment.services !== 'undefined' && typeof this.appointment.employee_id !== 'undefined' && this.appointment.services.length > 0;
                    break;
                case 2:
                    allow = (typeof this.appointment.date !== 'undefined' && this.appointment.time !== null) && this.step <= this.statusStep;
                    break;
                case 3:
                    if ( typeof this.appointment.patient !== 'undefined')
                        allow = this.checkPatientsInfo(this.appointment.patient) && this.step <= this.statusStep;

                    break;

            }

            return allow;
        },
        btnIdComputed(){
            if(this.step > 1)
                return 'button-next-2';
            else
                return 'button-next-1';
        }
    },
    watch: {

    },
    created(){
        this.getEmployees();
        this.getServices();
    }
});

$(document).ready(function() {
    $('.select2').select2();
});
