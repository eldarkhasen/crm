<template>
    <div class="frame-container">
        <h3 class="frame-title">Заполните личные данные</h3>

        <div class="frame-content row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="first-name" class="control-label">Имя *</label>
                    <input type="text" id="first-name" class="required form-control" maxlength="100" />
                </div>
                <div class="form-group">
                    <label for="last-name" class="control-label">Фамилия *</label>
                    <input type="text" id="last-name" class="required form-control" maxlength="120" />
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email *</label>
                    <input type="text" id="email" class="required form-control" maxlength="120" />
                </div>
                <div class="form-group">
                    <label for="phone-number" class="control-label">Телефон *</label>
                    <input type="text" id="phone-number" class="required form-control" maxlength="60" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="address" class="control-label">Адрес</label>
                    <input type="text" id="address" class="form-control" maxlength="120" />
                </div>
                <div class="form-group">
                    <label for="city" class="control-label">Город</label>
                    <input type="text" id="city" class="form-control" maxlength="120" />
                </div>
                <div class="form-group">
                    <label for="notes" class="control-label">Комментарии</label>
                    <textarea id="notes" maxlength="500" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <br>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>
