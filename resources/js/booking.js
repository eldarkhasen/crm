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
        appointment: {},
        step: 1,
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

        nextBtnClicked: function () {
            if(this.step < 4) this.step++;
        },

        backBtnClicked: function () {
            if(this.step > 1) this.step--;
        },

        confirmBtnClicked: function () {
            alert('confirmed');
        }
    },
    computed: {

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
