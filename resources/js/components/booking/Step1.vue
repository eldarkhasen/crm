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

                <select id="provider" class="col-xs-12 col-sm-4 form-control" v-model="appointment.employee_id" name="employee">
                    <option value="">Выберите сотрудника</option>
                    <option v-for="item in employees"
                            :value="item.id">{{ item.name}}</option>
                </select>
            </div>

            <div id="service-description" style="display:none;"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            services: Array,
            employees: Array,
            appointment: Object,
        },
        data() {
            var self = this;
            return {

            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
