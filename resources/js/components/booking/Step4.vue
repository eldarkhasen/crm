<template>
    <div class="frame-container">
        <h3 class="frame-title">Подтвердите данные записи</h3>
        <div class="frame-content row">
            <div id="appointment-details" class="col-xs-12 col-sm-6"></div>
            <div id="customer-details" class="col-xs-12 col-sm-6"></div>
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
        name: "Step4"
    }
</script>

<style scoped>

</style>
