<template>
    <div class="col-md-12">
        <div class="row mb-2">
        </div>
        <div class="card card-info">
            <div class="card-body">
                <full-calendar :events="events" :editable="true" :config="config" ></full-calendar>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            editable: {
                type: Boolean,
                required: false,
                default: false
            },

            droppable: {
                type: Boolean,
                required: false,
                default: false
            },

            selectable: {
                type: Boolean,
                required: false,
                default: false
            },

            events: Array,
            newEvent: Object,
        },
        data(){
            var self = this;
            return {
                cal: null,
                config: {
                    customButtons: {
                        myCustomButton: {
                            text: 'Добавить запись',
                        }
                    },
                    header: {
                        left: 'agendaDay,agendaWeek',
                        center: 'prev title next today',
                        right: 'myCustomButton'
                    },
                    locale: 'ru',
                    minTime: '09:00:00',
                    maxTime: '21:00:00',
                    slotDuration:'00:30:00',
                    slotLabelFormat: [
                        'H:mm'        // lower level of text
                    ],
                    buttonText: {
                        today: "Сегодня",
                        month: "Месяц",
                        week: "Неделя",
                        day: "День"
                    },
                    allDaySlot:false,
                    timezone:'local',

                    eventClick: (event) => {
                        this.selected = event;
                        this.eventSelected(event);
                    },

                    eventResize:(event)=>{
                        this.selected = event;
                        this.eventResize(event);
                    },

                    eventDrop:(event)=>{
                        // this.selected = event;
                        // this.eventDropped(event);
                        event.start = event.start;
                        event.end = event.end;
                        event.startText = event.start.format('Do, H:mm');
                        event.endText = event.end.format('Do, H:mm');
                    },

                    eventCreated:(event)=>{
                        this.eventSelected(event);
                    },

                    select: function(start, end){
                        // this.createEvent(start, end);
                        self.newEvent.start = start;
                        self.newEvent.startText = start.format('Do, H:mm');
                        self.newEvent.end = end;
                        self.newEvent.endText = end.format('Do, H:mm');
                        $('#addAppointmentForm').modal();
                    },

                },
                selected: {},
                slotLabels:[
                    {
                        title:"10 min",
                        duration: '00:10:00'
                    },
                    {
                        title:"20 min",
                        duration:'00:20:00'
                    },
                    {
                        title:"30 min",
                        duration:'00:30:00'
                    },
                    {
                        title:"1 hour",
                        duration:'01:00:00'
                    }
                ]

            }

        },
        methods:{
            eventDropped(event) {
                // alert("Dropped "+event.title+" start" +event.start.format()+" end: "+event.end.format());
                event.startText = event.start.format('Do, H:mm');
                event.endText = event.end.format('Do, H:mm');
            },

            eventResize(event){
                event.startText = event.start.format('Do, H:mm');
                event.endText = event.end.format('Do, H:mm');
                //alert(event.title+" start" +event.start.format()+" end: "+event.end.format());
            },
        },
        mounted() {
            const cal = $(this.$el),
                self = this;

        },
    }
</script>
