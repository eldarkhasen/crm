<template>
    <div class="frame-container">
        <h3 class="frame-title">Выберите сотрудника и услуги</h3>

        <div class="frame-content">
            <div class="form-group">
                <label for="services">
                    <strong>Выберите услуги</strong>
                </label>

                <multiselect v-model="appointment.services"
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
                <label for="provider">
                    <strong>Выберите сотрудника</strong>
                </label>

                <select id="provider" class="col-xs-12 col-sm-4 form-control"
                        v-model="appointment.employee_id" name="employee"
                        @change="employeeChanged()">
                    <option value="">Выберите сотрудника</option>
                    <option v-for="item in employees"
                            :value="item.id">{{ item.name}}</option>
                </select>
            </div>

            <div id="service-description" v-show="isset(appointment.services)">
                <div v-for="service in appointment.services">
                    <strong>{{service.name}}</strong>
                    <br>
                    <span>{{service.description}}</span>
                    <br>
                    <span>Цена <b>{{service.price}} тг.</b></span>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            services: Array,
            employees: Array,
            appointment: Object,
            notify: Function,
            isset: Function
        },
        data() {
            return {}
        },
        methods: {
            employeeChanged(){
                var self = this;
                this.employees.forEach(function(emp){
                    if(emp.id == self.appointment.employee_id){
                        self.appointment.employee_fullname = emp.surname + ' ' + emp.name + ' ' + emp.patronymic;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
