<template>
    <div class="frame-container">
        <h3 class="frame-title">Подтвердите данные записи</h3>
        <div class="frame-content row">
            <div id="appointment-details" class="col-xs-12 col-sm-6">
                <h4>{{appointment.employee_fullname}}</h4>
                <p>
                    <strong class="text-primary">
                        {{formattedDate()}}
                        <br>{{getAppointmentOverallPrice()}} Тг
                    </strong>
                </p>
                <hr>
                <div v-for="service in appointment.services">
                    <h5>{{service.name}}</h5>
                    <p>
                        <strong class="text-primary">
                            {{service.price}} Тг
                        </strong>
                    </p>
                </div>
            </div>
            <div id="customer-details" class="col-xs-12 col-sm-6">
                <h4>{{appointment.patient.surname + " " + appointment.patient.name}}</h4>
                <p>Тел: {{appointment.patient.phone}}
                    <br>Email: {{appointment.patient.email}}
                    <br>Адрес: {{appointment.patient.address}}
                    <br>Комментарии: {{appointment.notes}}
                </p>
            </div>
        </div>

        <!--<div class="frame-content row">-->
            <!--<div class="col-xs-12 col-sm-6">-->
                <!--<h4 class="captcha-title">-->
                    <!--CAPTCHA-->
                    <!--<small class="glyphicon glyphicon-refresh"></small>-->
                <!--</h4>-->
                <!--<img class="captcha-image" src="<?= site_url('captcha') ?>">-->
                <!--<input class="captcha-text" type="text" value="" />-->
                <!--<span id="captcha-hint" class="help-block" style="opacity:0">&nbsp;</span>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</template>

<script>
    export default {
        name: "Step4",
        props: {
            appointment: Object,
            notify: Function,
            isset: Function
        },
        methods: {
            getAppointmentOverallPrice(){
                if(this.isset(this.appointment.services)){
                    var sum = 0;

                    if(this.appointment.services.length > 0){
                        this.appointment.services.forEach(function (service) {
                            sum+=service.price;
                        });
                    }

                    this.appointment.price = parseInt(sum);

                    return parseInt(sum);
                }else{
                    return 0;
                }
            },

            formattedDate(){
                if(this.isset(this.appointment.time)){
                    var day = this.appointment.date.getDate();
                    var month = this.appointment.date.getMonth()+1;
                    var year = this.appointment.date.getFullYear();

                    var hour = this.appointment.time.getHours();
                    var minutes = this.appointment.time.getMinutes();

                    return day + '.' + month + '.' + year + ' ' + hour + ":" + minutes;
                }else{
                    return "";
                }
            }
        }
    }
</script>
