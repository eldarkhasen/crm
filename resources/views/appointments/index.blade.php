@extends('layouts.master')
@section('title', '| График')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>График</h1>
                </div>

            </div>
        </div>
    </section>

    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrf_token' => csrf_token()
        ]); ?>
    </script>

    <section class="content" id="appointments">
        <div class="container-fliud">
            <div class="row">
                <div class="col-md-12">
                    <appointment-component :editable = "true"
                                           :droppable = "true"
                                           :selectable = "true"
                                           :events = "events"
                                           :new-event = "newEvent"
                                           :selected-event = "selectedEvent"
                                           :update-appointment = "updateAppointment"
                                           :update-selected-appointment = "updateSelectedAppointment"
                                           :delete-appointment = "deleteAppointment"
                                           :set-selected-event = "setSelectedEvent"
                                           :employees = "employees"
                                           :services = "services"
                                           :patients = "patients"
                                           :get-patient-by-id = "getPatientById"
                    >
                    </appointment-component>
                    <new-event :employees = "employees"
                               :services = "services"
                               :patients = "patients"
                               :add-appointment = "addAppointment"
                               :get-patient-by-id = "getPatientById"
                               :new-event = "newEvent"
                    ></new-event>
                    <notifications group="alerts"
                                   :position="'bottom center'"/>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/appointments.js') }}"></script>
@endsection


