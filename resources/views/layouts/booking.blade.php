<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">

    <title> | Booking</title>

    <link rel="stylesheet" type="text/css" href="{{asset('ext_booking/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ext_booking/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ext_booking/jquery-qtip/jquery.qtip.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ext_booking/cookieconsent/cookieconsent.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/booking/frontend.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/booking/general.css')}}">

    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
    {{--<link rel="stylesheet" href="../daterangepicker/daterangepicker-bs3.css">--}}
    {{--<link rel="stylesheet" href="../datepicker/datepicker3.css">--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">--}}

    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrf_token' => csrf_token()
        ]); ?>
    </script>
    <style>
        .book-step {
            cursor: pointer
        }
    </style>
</head>

<body>
<div id="main" class="container">
    <div class="wrapper row" id="booking">
        <div v-if="!finished" id="book-appointment-wizard" class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

            <!-- FRAME TOP BAR -->

            <div id="header">
                <span id="company-name">CRM</span>

                <div id="steps">
                    <div id="step-1"
                         @click="stepClicked(1)"
                         v-bind:class="{'book-step':true, 'active-step':(step === 1)}" title="">
                        <strong>1</strong>
                    </div>

                    <div id="step-2"
                         @click="stepClicked(2)"
                         v-bind:class="{'book-step':true, 'active-step':(step === 2)}" title="">
                        <strong>2</strong>
                    </div>

                    <div id="step-3"
                         @click="stepClicked(3)"
                         v-bind:class="{'book-step':true, 'active-step':(step === 3)}" title="">
                        <strong>3</strong>
                    </div>

                    <div id="step-4"
                         @click="stepClicked(4)"
                         v-bind:class="{'book-step':true, 'active-step':(step === 4)}" title="">
                        <strong>4</strong>
                    </div>
                </div>
            </div>

        @if (false):
            <div id="cancel-appointment-frame" class="booking-header-bar row">
                <div class="col-xs-12 col-sm-10">
                    {{--<p><?= lang('cancel_appointment_hint') ?></p>--}}
                </div>
                <div class="col-xs-12 col-sm-2">
                    {{--<form id="cancel-appointment-form" method="post"--}}
                          {{--action="<?= site_url('appointments/cancel/' . $appointment_data['hash']) ?>">--}}
                        {{--<input type="hidden" name="csrfToken" value="<?= $this->security->get_csrf_hash() ?>" />--}}
                        {{--<textarea name="cancel_reason" style="display:none"></textarea>--}}
                        {{--<button id="cancel-appointment" class="btn btn-default btn-sm"><?= lang('cancel') ?></button>--}}
                    {{--</form>--}}
                </div>
            </div>
            <div class="booking-header-bar row">
                <div class="col-xs-12 col-sm-10">
                    {{--<p><?= lang('delete_personal_information_hint') ?></p>--}}
                </div>
                <div class="col-xs-12 col-sm-2">
                    {{--<button id="delete-personal-information" class="btn btn-danger btn-sm"><?= lang('delete') ?></button>--}}
                </div>
            </div>
        @endif

        @yield('content')

        </div>
        <div v-else id="success-frame" class="frame-container
                    col-xs-12
                    col-sm-offset-1 col-sm-10
                    col-md-offset-2 col-md-8
                    col-lg-offset-2 col-lg-8">

            <div class="col-xs-12 col-sm-2">
                <img id="success-icon" class="pull-right" src="{{asset('img/success.png')}}">
            </div>
            <div class="col-xs-12 col-sm-10">

                <h3>Ваша запись успешно зарегестрирована!</h3>
                <p>В ближайшее время с Вами свяжется сотрудинк для уточнения деталей записи по указанному номеру телефона: @{{appointment.patient.phone}}</p>
                <a href="/booking" class="btn btn-success btn-large" style="margin-right: 10px;">
                    <span class="glyphicon glyphicon-calendar"></span> Создать новую запись
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/booking.js') }}"></script>
@yield('script')
</body>
</html>
