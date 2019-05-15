<template>
    <div class="frame-container">
        <h3 class="frame-title">Заполните личные данные</h3>

        <div class="frame-content row">
            <div class="col-xs-12 col-sm-6">

                <div class="form-group">
                    <label for="first-name" class="control-label">Имя *</label>
                    <input type="text" id="first-name" class="required form-control" maxlength="100"
                            v-model="appointment.patient.name"/>
                </div>

                <div class="form-group">
                    <label for="last-name" class="control-label">Фамилия *</label>
                    <input type="text" id="last-name" class="required form-control" maxlength="120"
                           v-model="appointment.patient.surname"/>
                </div>

                <div class="form-group">
                    <label for="patronymic" class="control-label">Отчество *</label>
                    <input type="text" id="patronymic" class="form-control" maxlength="120"
                           v-model="appointment.patient.patronymic"/>
                </div>

                <div class="form-group">
                    <label for="phone-number" class="control-label">Телефон *</label>
                    <input type="text" id="phone-number" class="required form-control" maxlength="60"
                           v-model="appointment.patient.phone"
                           v-mask="'+7(999)999 99 99'"/>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" id="email" class="required form-control" maxlength="120"
                           v-model="appointment.patient.email"/>
                </div>

            </div>

            <div class="col-xs-12 col-sm-6">

                <div class="form-group">
                    <label for="birth-date" class="control-label">Дата рождения *</label>
                    <input type="text" id="birth-date" class="required form-control" maxlength="60"
                           v-model="appointment.patient.birthdate"
                           v-mask="'##/##/####'"/>
                </div>

                <div class="form-group">
                    <label for="new-patronymic">Пол *</label>
                    <select class="form-control" id="new-patronymic" type="text" v-model="appointment.patient.gender">
                        <option value="Мужской">Мужской</option>
                        <option value="Женский">Женский</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address" class="control-label">Адрес</label>
                    <input type="text" id="address" class="form-control" maxlength="120"
                           v-model="appointment.patient.address"/>
                </div>

                <div class="form-group">
                    <label for="notes" class="control-label">Комментарии</label>
                    <textarea id="notes" maxlength="500" class="form-control" rows="3"
                                v-model="appointment.notes"></textarea>
                </div>

            </div>
            <br>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            appointment: Object,
            notify: Function
        }
    }
</script>

<style scoped>

</style>
