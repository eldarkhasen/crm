<template>
    <div class="frame-container">
        <h3 class="frame-title">Выберите время заказа</h3>

        <div class="frame-content row">
            <div class="col-xs-12 col-sm-6">
                <div id="select-date">
                    <h5>Выберте дату</h5>
                    <datepicker :inline="true"
                                v-model="appointment.date"
                                :disabledDates="disabledDates"
                                :language="ru"
                                @input="dateChanged()"></datepicker>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div id="available-hours">
                    <h5>Выберите время</h5>
                    <timeselector :required="true"
                                  :initialView="true"
                                  v-model="appointment.time"
                                  :interval="{m:30}"
                                :disable="{h:disabledHours}"
                                @selectedDisabled="selectedDisabled()"
                                ></timeselector>
                </div>
            </div>
            <!--<full-calendar :events="appointments" :editable="true" :config="config" ref="calendar"></full-calendar>-->
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import Timeselector from 'vue-timeselector';
    import {ru} from 'vuejs-datepicker/dist/locale'
    export default {
        props: {
            appointment: Object,
            notify: Function
        },
        data(){
            return {
                disabledDates: {
                    to: new Date(Date.now() - 86400000)
                },
                ru: ru,
                disabledHours: []
            }
        },
        methods: {
            dateChanged(){
                this.getBusyHours(this.appointment.employee_id, this.appointment.date)
            },
            getBusyHours(employee_id, date){
                var self = this;
                window.axios.post('/booking/getbusyhours/', {
                    employee_id: employee_id,
                    date: date
                }).then((response) => {
                    self.disabledHours = response.data.busyHours
                }).catch(e => {
                    this.notify("some error in request")
                })

            },
            selectedDisabled(){
                this.notify('Выбранное время занято')
            }
        },
        created() {
            this.getBusyHours(this.appointment.employee_id, this.appointment.date);
        },
        components: {
            Datepicker,
            Timeselector
        }
    }
</script>

<style>
    .vtimeselector__box { height: 19em !important }
    .vtimeselector__box--is-closed {
        display: flex !important;
    }
</style>
