@extends('layouts.booking')

@section('content')
    <div id="wizard-frame-1" class="wizard-frame">
        <step1 v-show="step == 1"
                :employees = "employees"
                :services = "services"
                :appointment = "appointment"
                :notify = "notify"
                :isset = "isset">

        </step1>

        <step2 v-show="step == 2"
               :appointment = "appointment"
               :notify = "notify"
                >

        </step2>

        <step3 v-show="step == 3"
               :appointment = "appointment"
               :notify = "notify">

        </step3>

        <step4 v-show="step == 4"
               :appointment = "appointment"
               :notify = "notify"
               :isset = "isset">

        </step4>

        <div class="command-buttons">
            <button type="button"
                    v-if="step > 1"
                    class="btn button-back btn-default"
                    @click="backBtnClicked()">
                <span class="glyphicon glyphicon-backward"></span>
                Назад
            </button>
            <button v-if="step != 4" type="button" v-bind:id="btnIdComputed"
                    class="btn button-next btn-primary"
                    :disabled="!allowNext"
                    @click="nextBtnClicked()">
                Далее
                <span class="glyphicon glyphicon-forward"></span>
            </button>

            <button v-else type="button" id="book-appointment-submit"
                    class="btn btn-success"
                    @click="confirmBtnClicked()"
                    :disabled="confirmBtnDisabled">
                <span class="glyphicon glyphicon-ok"></span>
                <span>Завершить</span>
            </button>
        </div>

        <notifications group="alerts"
                       :position="'bottom center'"/>
    </div>
@endsection
