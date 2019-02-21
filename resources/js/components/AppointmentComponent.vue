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
            events: Array,
        },
        data(){
            return {
                // TODO: регать данные из контроллера в window и присваивать ниже
                cal: null,
                config: {
                    customButtons: {
                        myCustomButton: {
                            text: 'Добавить запись',
                            click: function() {
                                // alert('clicked the custom button!');
                                $('#addAppointmentForm').modal();
                            }
                        }
                    },
                    header: {
                        left: 'agendaDay,agendaWeek',
                        center: 'prev title next today',
                        right: 'myCustomButton'
                    },
                    locale: 'ru',
                    eventClick: (event) => {
                        this.selected = event;
                        this.eventSelected(event);
                    },
                    eventResize:(event)=>{
                        this.selected = event;
                        this.eventResize(event);
                    },
                    eventDrop:(event)=>{
                        this.selected = event;
                        this.eventDropped(event);
                    },
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

                    // monthNames: ['Январь','Февраль','Март','Апрель','Май','οюнь','οюль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                    // monthNamesShort: ['Янв.','Фев.','Март','Апр.','Май','οюнь','οюль','Авг.','Сент.','Окт.','Ноя.','Дек.'],
                    // dayNames: ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
                    // dayNamesShort: ["ВС","ПН","ВТ","СР","ЧТ","ПТ","СБ"],
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
            addAppointment(){

            },
            eventDropped(event) {
                alert("Dropped "+event.title+" start" +event.start.format()+" end: "+event.end.format());

            },
            eventSelected(event) {
                alert(event.title+" "+event.start.format());

            },
            eventResize(event){
                alert(event.title+" start" +event.start.format()+" end: "+event.end.format());
            }

        },
        mounted() {
            const cal = $(this.$el),
                self = this;

        },
    }
</script>
