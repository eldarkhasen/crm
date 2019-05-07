@extends('layouts.booking')

@section('content')
    <div id="wizard-frame-1" class="wizard-frame">
        <step1 v-show="step == 1"
                :employees = "employees"
                :services = "services"
                :appointment = "appointment"></step1>

        <step2 v-show="step == 2">

        </step2>

        <step3 v-show="step == 3">

        </step3>

        <step4 v-show="step == 4">

        </step4>

        <div class="command-buttons">
            <button type="button"
                    v-if="step > 1"
                    class="btn button-back btn-default"
                    @click="backBtnClicked()">
                <span class="glyphicon glyphicon-backward"></span>
                Назад
            </button>
            <button v-if="step != 4" type="button" id="button-next-1"
                    class="btn button-next btn-primary"
                    @click="nextBtnClicked()">
                Далее
                <span class="glyphicon glyphicon-forward"></span>
            </button>

            <button v-else type="button" id="button-next-1"
                    class="btn button-next btn-success"
                    @click="confirmBtnClicked()">
                <span>Подтвердить</span>
                <span class="glyphicon glyphicon-ok"></span>
            </button>
        </div>
    </div>

@endsection
